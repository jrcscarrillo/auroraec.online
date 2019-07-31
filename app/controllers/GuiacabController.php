<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class GuiacabController extends ControllerBase {

    protected $ambiente;
    protected $txt_ambiente;
    protected $firmado;

    public function initialize() {
        $this->tag->setTitle('Guias');
        parent::initialize();
    }

    public function indexAction() {
        $this->session->conditions = null;
        $this->view->form = new GuiaForm;
    }

    public function aprobarAction($refNumber) {
        $parameters = array('conditions' => '[refNumber] = :numero:', 'bind' => array('numero' => $refNumber));
        $guiacab = Guiacab::findFirst($parameters);
        if ($guiacab == false) {
            $this->flash->error("Esta guia de remision no existe");
            return $this->dispatcher->forward(
                            [
                                "action" => "index",
                            ]
            );
        }

        if ($guiacab->CustomField15 <> 'GRABADO' && $guiacab->CustomField15 <> 'SIN FIRMAR') {
            $this->flash->error("Esta guia de remision no esta GRABADA " . $refNumber);
            return $this->dispatcher->forward(
                            [
                                "action" => "index",
                            ]
            );
        }

        $guiacab->setCustomField15("SIN FIRMAR");
        if (!$guiacab->save()) {
            foreach ($guiacab->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }

        $this->flash->success("Guia de remision aprobada " . $refNumber);

        $this->dispatcher->forward([
            'action' => "search"
        ]);
    }

    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Guiacab', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "txnID";

        $guiacab = Guiacab::find($parameters);
        if (count($guiacab) == 0) {
            $this->flash->notice("No se encontraron guias de remision que cumplan con los parametros de busqueda");

            $this->dispatcher->forward([
                "controller" => "guiacab",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $guiacab,
            'limit' => 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    public function newAction() {
        $ruc = $this->session->get('contribuyente');
        $this->view->form = new GuiaNewForm;
        $this->view->ruc = $ruc;
    }

    public function firmarAction($refNumber) {
        $parameters = array('conditions' => '[refNumber] = :numero:', 'bind' => array('numero' => $refNumber));
        $guiacab = Guiacab::findFirst($parameters);
        if ($guiacab == false) {
            $this->flash->error("Esta guia de remision no existe");
            return $this->dispatcher->forward(
                            [
                                "action" => "index",
                            ]
            );
        }

        $this->_registerGuia($guiacab);
        $this->flash->success('Guia de Remision Seleccionada || ' . $guiacab->getrefNumber());
        $this->firmaGuia($guiacab);
        return $this->dispatcher->forward(
                        [
                            "controller" => "guiacab",
                            "action" => "index"
                        ]
        );
    }

    public function impresionAction($refNumber) {
        $parameters = array('conditions' => '[refNumber] = :numero:', 'bind' => array('numero' => $refNumber));
        $guiacab = Guiacab::findFirst($parameters);
        if ($guiacab == false) {
            $this->flash->error("Esta guia de remision no existe");
            return $this->dispatcher->forward(
                            [
                                "action" => "index",
                            ]
            );
        }

        $this->_registerGuia($guiacab);

        $this->flash->success('Guia de retencion Seleccionada || ' . $guiacab->refNumber);
        $this->respuestaSRI(1);
        if (!$guiacab->save()) {

            foreach ($guiacab->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                        'action' => 'index',
            ]);
        }
        return $this->dispatcher->forward(
                        [
                            "action" => "search",
                        ]
        );
    }

    private function respuestaSRI($opcion) {
        $w_cabecera = $this->session->get('guiacab');
        $a = $this->session->get('archivos');
        $firmado = $a['firmado'];
        $doc = new DOMDocument();
        $doc->load($firmado);
        $claveAcceso = $doc->getElementsByTagName('claveAcceso')->item(0)->nodeValue;
        $this->session->set('claveAcceso', $claveAcceso);
        $this->topdfguia->llenaGuia();
        $this->topdfguia->creaGuia(1);
        if ($w_cabecera['CustomField15'] === "AUTORIZADO") {
            $estado = $this->enviarEmail();
        }
    }

    private function enviarEmail() {
        $w_cab = $this->session->get('guiacab');
        $a = $this->session->get('archivos');
        $w_con = $this->session->get('contribuyente');
        $w_aut = $this->session->get('auth');

        $part = '<div><p><strong>FACTURACION ELECTRONICA LOS COQUEIROS</strong></p><br>
           <p>Estimado(a) </p><br><p><strong> Jefe de Bodega' .
                '</strong></p><br><p>Heladerías Cofrunat Cia. Ltda.,  le informa que se ha generado su comprobante electrónico,</p><br><p><strong>' .
                $w_con['estab'] . '-' . $w_con['punto'] . '-' . $w_cab['numeroDocumento'] . '</strong></p><br> ' .
                '<p>que adjuntamos en formato XML de acuerdo a los requerimientos del SRI.</p><br>
         <p>Podrá revisar este y todos sus documentos electrónicos en </p><br>
         <p>https://declaraciones.sri.gob.ec/comprobantes-electronicos-internet/\r\npublico/validezComprobantes.jsf?pathMPT=Facturaci%F3n%20Electr%F3nica&actualMPT=Validez%20de%20comprobantes\r\n

</p><br><br><p>Atentamente,</p><br><br>

<p>Heladerías Cofrunat Cia. Ltda. </p>';



        $paraemail['part'] = $part;
        $paraemail['body'] = $part;
        $param = $a['firmado'];
        $param1 = $a['elpdf'];
        $paraemail['attach'] = $param;
        $paraemail['attach1'] = $param1;
        $paraemail['subject'] = 'LOS COQUEIROS - Retencion Autorizada';
        $paraemail['fromemail']['email'] = 'xavierbustos@loscoqueiros.com';
        $paraemail['fromemail']['nombre'] = 'Heladerias Cofrunat Cia. Ltda.';
        $paraemail['toemail']['email'] = $w_aut['email'];
        $paraemail['toemail']['nombre'] = $w_aut['name'];
        $exp = $this->sendmail->enviaEmail($paraemail);
        return $exp;
    }

    private function _registerGuia($arreglo) {
        $origen = $arreglo->origenId;
        $destino = $arreglo->destinoId;
        $tipo = $arreglo->tipoDestino;
        $chofer = $arreglo->driverId;
        $ruta = $arreglo->routeId;
        $carro = $arreglo->vehicleId;

        $nombres = $this->sacaNombres($origen, $tipo, $destino, $chofer, $ruta, $carro);
        $doc = $this->claves->generaDoc($arreglo->refNumber);
        $this->session->set('guiacab', array(
            'TxnID' => $arreglo->txnID,
            'TimeCreated' => $arreglo->timeCreated,
            'TimeModified' => $arreglo->timeModified,
            'EditSequence' => $arreglo->editSequence,
            'numeroTransaccion' => $doc['documento'] + 10000000,
            'fechaDocumento' => $arreglo->txnDate,
            'dateBegin' => $arreglo->dateBegin,
            'dateEnd' => $arreglo->dateEnd,
            'numeroDocumento' => $doc['documento'],
            'CustomField13' => $arreglo->CustomField13,
            'CustomField14' => $arreglo->CustomField14,
            'CustomField15' => $arreglo->CustomField15,
            'origenaddress' => $nombres['origenaddress'],
            'origennumeroid' => $nombres['origennumeroid'],
            'origentipoid' => $nombres['origentipoid'],
            'carroplaca' => $nombres['carroplaca'],
            'destinoaddress' => $nombres['destinoaddress'],
            'ruta' => $nombres['ruta'],
            'destinonumeroid' => $nombres['destinonumeroid'],
            'destinotipoid' => $nombres['destinotipoid'],
            'chofernumeroId' => $nombres['chofernumeroId'],
            'chofertipoId' => $nombres['chofertipoId'],
            'chofer' => $nombres['chofer'],
            'destino' => $nombres['destino'],
            'motive' => $arreglo->motive,
        ));
        $parameters = array('conditions' => '[CodEmisor] = :estab: AND [Punto] = :punto:', 'bind' => array('estab' => $doc['estab'], 'punto' => $doc['punto']));
        $contribuyente = Contribuyente::findFirst($parameters);
        if ($contribuyente == false) {
            $this->flash->error("Este contribuyente no existe");
            return $this->dispatcher->forward(
                            [
                                "action" => "search",
                            ]
            );
        }
        $rucPasa = $this->claves->registraContribuyente($contribuyente);
        $this->session->set('contribuyente', $rucPasa);
        $archivos = $this->claves->registraArchivos($rucPasa['estab'], $rucPasa['punto'], $doc['documento'], 'guia', 'guias');
        $this->session->set('archivos', $archivos);
        $c = $this->session->get('contribuyente');
        $a = $this->session->get('archivos');
        $this->ambiente = $c['ambiente'];
        $this->firmado = $a['firmado'];
    }

    private function firmaGuia($guiacab) {
        $this->session->set('stringDetalles', '<detalles>');

        foreach ($guiacab->guiatrx as $producto) {
            if ($producto->ItemRefListID <> " ") {
                $stringItem = $this->procesaItem($producto);
            }
        }

        $this->totalGuia($guiacab);
        $mensaje = $this->claves->sriCliente($this->firmado, $this->ambiente);
        if ($mensaje == "RECIBIDA") {
            $this->flash->success('EN ' . $this->txt_ambiente . $mensaje . ' la guia remision esta => ' . $mensaje);
            $param['mensaje'] = 'RECIBIDA';
            $this->guiaAutorizada($param);
        } else {
            $this->flash->error('EN ' . $this->txt_ambiente . $mensaje);
        }
    }

    function guiaAutorizada($param) {
//        var_dump($this->session->get('guiacab'));
        $w_cabecera = $this->session->get('guiacab');
        $TxnID = $w_cabecera["TxnID"];
        $guiacab = Guiacab::findFirstBytxnID($TxnID);

        if (!$guiacab) {
            $this->flash->error("Guia de Remision no existe " . $TxnID);

            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }

        if ($param['mensaje'] === "AUTORIZADO") {
            $nroAut = $param['numeroAutorizacion'];
            $fecAut = $param['fechaAutorizacion'];
            $guiacab->setCustomField14($nroAut);
            $guiacab->setCustomField13($fecAut);
            $this->topdfguia->llenaGuia();
            $this->topdfguia->creaGuia(2);
        }
        $guiacab->setCustomField15($param['mensaje']);
        if (!$guiacab->save()) {

            foreach ($guiacab->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                        'action' => 'index',
            ]);
        }
        $this->flash->success("la guia de remision ahora esta " . $param['mensaje']);
    }

    public function _cargarGuia($refNumber) {
        $parameters = array('conditions' => '[refNumber] = :numero:', 'bind' => array('numero' => $refNumber));
        $guiacab = Guiacab::findFirst($parameters);
        if ($guiacab == false) {
            $this->flash->error("Esta retencion no existe");
            return $this->dispatcher->forward(
                            [
                                "action" => "index",
                            ]
            );
        }

        $this->_registerGuia($guiacab);
    }

    public function autorizarAction($refNumber) {

        $this->_cargarGuia($refNumber);
        $this->flash->success('Guia de Retencion Seleccionada || ' . $refNumber);
        $mensaje = $this->claves->respuestaSRI($this->firmado, $this->ambiente);
        if ($mensaje['mensaje'] === "AUTORIZADO") {
            $this->guiaAutorizada($mensaje);
        } else {
            $this->flash->error('EN ' . $this->txt_ambiente . $mensaje['mensaje']);
        }
        return $this->dispatcher->forward(
                        [
                            "action" => "search",
                        ]
        );
    }

    function totalGuia($guiacab) {

        $a = $this->session->get('archivos');
        $w_cabecera = $this->session->get('guiacab');
        $w_ruc = $this->session->get('contribuyente');
        $salida = $a['generado'];
        $firmado = $a['firmado'];
        $this->firmado = $firmado;
        $pasaXML = $a['creado'];
        $regresaXML = $a['pasado'];

        $paramClave['fechaDocumento'] = $w_cabecera['fechaDocumento'];
        $paramClave['numeroDocumento'] = $w_cabecera['numeroDocumento'];
        $paramClave['tipoDocumento'] = '06';
        $paramClave['numeroTransaccion'] = $w_cabecera['numeroTransaccion'];
        $paramClave['ruc'] = $w_ruc['ruc'];
        $paramClave['ambiente'] = $w_ruc['ambiente'];
        $this->ambiente = $w_ruc['ambiente'];
        if ($this->ambiente == 1) {
            $this->txt_ambiente = "Pruebas";
        } else {
            $this->txt_ambiente = "Produccion";
        }
        $paramClave['emision'] = $w_ruc['emision'];
        $paramClave['punto'] = $w_ruc['punto'];
        $paramClave['estab'] = $w_ruc['estab'];
        $creaClave = $this->claves->crea_clave($paramClave);
        $this->session->set('claves', $creaClave);
        $this->session->set('paramclave', $paramClave);

        $stringTributaria = '<infoTributaria><ambiente>' . $w_ruc['ambiente'] . '</ambiente>';
        $stringTributaria .= '<tipoEmision>' . $w_ruc['emision'] . '</tipoEmision><razonSocial>' . $w_ruc['razon'] . '</razonSocial>';
        $stringTributaria .= '<nombreComercial>' . $w_ruc['NombreComercial'] . '</nombreComercial>';
        $stringTributaria .= '<ruc>' . $w_ruc['ruc'] . '</ruc><claveAcceso>' . implode($creaClave['claveAcceso']) . '</claveAcceso><codDoc>06</codDoc>';
        $stringTributaria .= '<estab>' . $w_ruc['estab'] . '</estab><ptoEmi>' . $w_ruc['punto'] . '</ptoEmi><secuencial>' . $creaClave['numeroDocumentoLleno'] . '</secuencial>';
        $stringTributaria .= '<dirMatriz>' . $w_ruc['DirMatriz'] . '</dirMatriz></infoTributaria>';
        $stringInfo = '<infoGuiaRemision><dirEstablecimiento>' . $w_ruc['DirMatriz'] . '</dirEstablecimiento>';
        $stringInfo .= '<dirPartida>' . $w_cabecera['origenaddress'] . '</dirPartida>';
        $stringInfo .= '<razonSocialTransportista>' . $w_cabecera['chofer'] . '</razonSocialTransportista>';
        $stringInfo .= '<tipoIdentificacionTransportista>' . $w_cabecera['chofertipoId'] . '</tipoIdentificacionTransportista> ';
        $stringInfo .= '<rucTransportista>' . $w_cabecera['chofernumeroId'] . '</rucTransportista>';
        $stringInfo .= '<obligadoContabilidad>SI</obligadoContabilidad> ';
        $stringDate = strtotime($w_cabecera['dateBegin']);
        $dateString = date('d/m/Y', $stringDate);
        $stringInfo .= '<fechaIniTransporte>' . $dateString . '</fechaIniTransporte>';
        $stringDate = strtotime($w_cabecera['dateEnd']);
        $dateString = date('d/m/Y', $stringDate);
        $stringInfo .= '<fechaFinTransporte>' . $dateString . '</fechaFinTransporte>';
        $stringInfo .= '<placa>' . $w_cabecera['carroplaca'] . '</placa>';

        $stringInfo .= '</infoGuiaRemision>';
        $stringInfo .= '<destinatarios>';
        $stringInfo .= '<destinatario>';
        $stringInfo .= '<identificacionDestinatario>' . $w_cabecera['destinonumeroid'] . '</identificacionDestinatario>';
        $stringInfo .= '<razonSocialDestinatario>' . $w_cabecera['destino'] . '</razonSocialDestinatario>';
        $stringInfo .= '<dirDestinatario>' . $w_cabecera['destinoaddress'] . '</dirDestinatario>';
        $stringInfo .= '<motivoTraslado>Traslado por Emisor Itinerante</motivoTraslado>';
        $stringInfo .= '<ruta>' . $w_cabecera['ruta'] . '</ruta> ';

        $stringFactura = '<guiaRemision id="comprobante" version="1.1.0">' . $stringTributaria . $stringInfo . $this->session->get('stringDetalles');
        $stringFactura .= '</detalles></destinatario></destinatarios></guiaRemision>';


        $stringDoc = '<?xml version="1.0" encoding="UTF-8" ?>';
        $stringDoc .= $stringFactura;
        $doc = new DOMDocument();
        $doc->loadXML($stringDoc);
        $doc->saveXML();
        file_put_contents($pasaXML, $stringDoc);
        $this->session->set('documentoXML', $pasaXML);
        $ret = exec('c:\wamp64\www\ComprobantesSRI\ecuador\corre.bat', $out, $return);
        $docpasa = new DOMDocument();
        $docpasa->load($pasaXML);
        $docpasa->save($salida);
//        $ret = shell_exec('/home/online/public_html/public/arranca.sh');
        $docregresa = new DOMDocument();
        $docregresa->load($regresaXML);
        $docregresa->save($firmado);
    }

    function procesaItem($producto) {

        $w_string = $this->session->get('stringDetalles');
        $item = $producto->items;
        $regresaDescripcion = $this->claves->limpiaString($item->descripcion);
        $stringItem = '<detalle><codigoInterno>' . $item->nombre . '</codigoInterno>';
        $stringItem .= '<codigoAdicional>' . $producto->ItemRefListID . '</codigoAdicional>';
        $stringItem .= '<descripcion>' . $regresaDescripcion . '</descripcion><cantidad>' . $producto->qty . '</cantidad>';
        if (strlen($producto->numeroLote) > 0) {
            $stringItem .= '<detallesAdicionales><detAdicional nombre="Lotes" valor="' . $producto->numeroLote . '"/>';
            $stringItem .= '</detallesAdicionales></detalle>';
        } else {
            $stringItem .= '</detalle>';
        }

        $w_string .= $stringItem;
        $this->session->set('stringDetalles', $w_string);
        return true;
    }

    public function editAction($refNumber) {
        if (!$this->request->isPost()) {

            $guiacab = Guiacab::findFirstByrefNumber($refNumber);
            if (!$guiacab) {
                $this->flash->error("Esta guia no existe");
                return $this->dispatcher->forward([
                            'action' => 'index'
                ]);
            }
            if ($guiacab->CustomField15 <> 'GRABADO' && $guiacab->CustomField15 <> 'SIN FIRMAR') {
                $this->flash->error("Esta guia no puede ser modificada tiene estado de " . $guiacab->CustomField15);
                return $this->dispatcher->forward([
                            'action' => 'index'
                ]);
            }
            $this->view->form = new GuiaNewForm;
            $this->tag->setDefault("txnDate", $guiacab->txnDate);
            $this->tag->setDefault("refNumber", $guiacab->refNumber);
            $this->tag->setDefault("origenId", $guiacab->origenId);
            $this->tag->setDefault("destinoId", $guiacab->destinoId);
            $this->tag->setDefault("driverId", $guiacab->driverId);
            $this->tag->setDefault("routeId", $guiacab->routeId);
            $this->tag->setDefault("vehicleId", $guiacab->vehicleId);
            $this->tag->setDefault("dateBegin", $guiacab->dateBegin);
            $this->tag->setDefault("dateEnd", $guiacab->dateEnd);
            $this->tag->setDefault("motive", $guiacab->motive);
        }
    }

    public function createAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "guiacab",
                'action' => 'index'
            ]);

            return;
        }

        $form = new GuiaNewForm;
        $guiacab = new Guiacab();

        $data = $this->request->getPost();
        if (!$form->isValid($data)) {
            foreach ($form->getMessages() as $message) {
//                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                            [
                                "action" => "new",
                            ]
            );
        }
//        var_dump($this->request->getPost());
        $clave = $this->claves->guid();
        $fecha = date('Y-m-d H:m:s');
        $transferencia = 'TRANSFERENCIA';
        $guiacab->settxnID($clave);
        $guiacab->settimeCreated($fecha);
        $guiacab->settimeModified($fecha);
        $guiacab->seteditSequence(rand(2000, 200000));
        $guiacab->setrefNumber($this->request->getPost("refNumber"));
        $guiacab->settxnDate($this->request->getPost("txnDate"));
        $guiacab->setorigenId($this->request->getPost("origenId"));
        $guiacab->settipoDestino($transferencia);
        $guiacab->setdestinoId($this->request->getPost("destinoId"));
        $guiacab->setdriverId($this->request->getPost("driverId"));
        $guiacab->setrouteId($this->request->getPost("routeId"));
        $guiacab->setvehicleId($this->request->getPost("vehicleId"));
        $guiacab->setdateBegin($this->request->getPost("dateBegin"));
        $guiacab->setdateEnd($this->request->getPost("dateEnd"));
        $guiacab->setmotive($this->request->getPost("motive"));
        $guiacab->setstatus('GRABADO');
        $guiacab->setestado('ACTIVO');
        $guiacab->setCustomField15('GRABADO');

        $nombres = $this->sacaNombres($this->request->getPost("origenId"), $transferencia, $this->request->getPost("destinoId"), $this->request->getPost("driverId"), $this->request->getPost("routeId"), $this->request->getPost("vehicleId"));
        $guiacab->setorigenName($nombres['origen']);
        $guiacab->setdestinoName($nombres['destino']);
        $guiacab->setdriverName($nombres['chofer']);
        $guiacab->setrouteName($nombres['ruta']);
        $guiacab->setvehicleName($nombres['carro']);  // placa

        if (!$guiacab->save()) {
            foreach ($guiacab->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "guiacab",
                'action' => 'new'
            ]);

            return;
        }

//        $this->flash->success("Se ha generado la guia de remision nro " . $this->request->getPost('refNumber'));

        $this->dispatcher->forward([
            'controller' => "guiacab",
            'action' => 'productos',
            'params' => [$this->request->getPost('refNumber')]
        ]);
    }

    public function sacaNombres($origen, $tipo, $destino, $chofer, $ruta, $carro) {
        $nombres = array();
        $a_origen = Bodegas::findFirstByListID($origen);
        $nombres['origenId'] = $origen;
        $nombres['origen'] = $a_origen->Name;
        $nombres['origenaddress'] = $a_origen->BodegaAddress;
        $nombres['origentipoid'] = $a_origen->TipoID;
        $nombres['origennumeroid'] = $a_origen->NumeroID;
        $nombres['origenemail'] = $a_origen->Email;

        if ($tipo === 'CLIENTE') {
            $a_destino = Customer::findFirstByListID($destino);
            $nombres['destinoId'] = $destino;
            $nombres['destino'] = $a_destino->Name;
            $nombres['destinoaddress'] = $a_destino->BillAddress_Addr1;
            if ($a_destino->CustomerTypeRef_FullName === 'RUC') {
                $tipo_aux = '04';
            } elseif ($a_destino->CustomerTypeRef_FullName === 'CEDULA') {
                $tipo_aux = '05';
            } elseif ($a_destino->CustomerTypeRef_FullName === 'PASAPORTE') {
                $tipo_aux = '06';
            } elseif ($a_destino->CustomerTypeRef_FullName === 'EXTRANJERO') {
                $tipo_aux = '07';
            }
            $nombres['destinotipoid'] = $tipo_aux;
            $nombres['destinonumeroid'] = $a_destino->AccountNumber;
            $nombres['destinoemail'] = $a_destino->Email;
        } else {
            $a_destino = Bodegas::findFirstByListID($destino);
            $nombres['destinoId'] = $destino;
            $nombres['destino'] = $a_destino->Name;
            $nombres['destinoaddress'] = $a_destino->BodegaAddress;
            $nombres['destinotipoid'] = $a_destino->TipoID;
            $nombres['destinonumeroid'] = $a_destino->NumeroID;
            $nombres['destinoemail'] = $a_destino->Email;
        }

        $a_chofer = Driver::findFirstBylistID($chofer);
        $nombres['choferId'] = $chofer;
        $nombres['chofer'] = $a_chofer->name;
        $nombres['choferaddress'] = $a_chofer->address;
        $nombres['chofertipoId'] = $a_chofer->tipoId;
        $nombres['chofernumeroId'] = $a_chofer->numeroId;

        $a_ruta = Route::findFirstBylistID($ruta);
        $nombres['rutaId'] = $ruta;
        $nombres['ruta'] = $a_ruta->description;

        $a_carro = Vehicle::findFirstBylistID($carro);
        $nombres['carroId'] = $carro;
        $nombres['carro'] = $a_carro->description;
        $nombres['carroplaca'] = $a_carro->name;
        return $nombres;
    }

    public function productosAction($refNumber) {

        $ruc = $this->session->get('contribuyente');
        $guiacab = Guiacab::findFirstByrefNumber($refNumber);
        if (!$guiacab) {
            $this->flash->warning("no se ha encontrado la guia de remision " . $refNumber);

            $this->dispatcher->forward([
                'controller' => "guiacab",
                'action' => 'productos',
                'params' => [$refNumber]
            ]);
        }
        $TxnID = $guiacab->txnID;
        $form = new GuiaProductoForm;
        $parameters = array('conditions' => '[IDKEY] = :clave:', 'bind' => array('clave' => $TxnID));
        $guiatrx = Guiatrx::find($parameters);
        $this->view->guiacab = $guiacab;
        $this->view->form = $form;
        $this->view->ruc = $ruc;
        $this->view->guiatrx = $guiatrx;
    }

    public function masproductosAction($refNumber) {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward([
                        'controller' => "guiacab",
                        'action' => 'productos',
                        'params' => [$refNumber]
            ]);
        }

        $form = new GuiaProductoForm;
        $guiatrx = new Guiatrx();
        $guiacab = Guiacab::findFirstByrefNumber($refNumber);
        $parameters = array('conditions' => '[quickbooks_listid] = :codigoprod:', 'bind' => array('codigoprod' => $this->request->getPost('ItemRefListID')));
        $item = Items::findFirst($parameters);
        $data = $this->request->getPost();
        if (!$form->isValid($data)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                        "action" => "productos",
                        "params" => [$refNumber]
            ]);
        }

//        var_dump($this->request->getPost());
        $clave = $this->claves->guid();
        $fecha = date('Y-m-d H:m:s');
        $guiatrx->settxnID($clave);
        $guiatrx->settimeCreated($fecha);
        $guiatrx->settimeModified($fecha);
        $guiatrx->seteditSequence(rand(2000, 200000));
        $guiatrx->setNumeroLote($this->request->getPost("numeroLote"));
        $guiatrx->setItemRefListID($this->request->getPost("ItemRefListID"));
        $guiatrx->setItemRefFullName($item->sales_desc);
        $guiatrx->setOrigenTrx($guiacab->origenId);
        $guiatrx->setDestinoTrx($guiacab->destinoId);
        $guiatrx->setQty($this->request->getPost("qty"));
        $guiatrx->setIDKEY($guiacab->txnID);
        $guiatrx->setEstado('ACTIVO');


        if (!$guiatrx->save()) {
            foreach ($guiacab->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                        'action' => 'productos',
                        'params' => [$refNumber]
            ]);
        }

//        $this->flash->success("Se ha adicionado un nuevo producto" . $this->request->getPost('ItemRefListID'));

        return $this->dispatcher->forward([
                    'controller' => "guiacab",
                    'action' => 'productos',
                    'params' => [$refNumber]
        ]);
    }

    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'action' => 'index'
            ]);

            return;
        }

        $refNumber = $this->request->getPost("refNumber");
        $guiacab = Guiacab::findFirstByrefNumber($refNumber);

        if (!$guiacab) {
            $this->flash->error("No se puede actualizar esta guia " . $refNumber);

            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }

        $fecha = date('Y-m-d H:m:s');
        $transferencia = 'TRANSFERENCIA';
        $guiacab->settimeModified($fecha);
        $guiacab->setrefNumber($this->request->getPost("refNumber"));
        $guiacab->settxnDate($this->request->getPost("txnDate"));
        $guiacab->setorigenId($this->request->getPost("origenId"));
        $guiacab->settipoDestino($transferencia);
        $guiacab->setdestinoId($this->request->getPost("destinoId"));
        $guiacab->setdriverId($this->request->getPost("driverId"));
        $guiacab->setrouteId($this->request->getPost("routeId"));
        $guiacab->setvehicleId($this->request->getPost("vehicleId"));
        $guiacab->setdateBegin($this->request->getPost("dateBegin"));
        $guiacab->setdateEnd($this->request->getPost("dateEnd"));
        $guiacab->setmotive($this->request->getPost("motive"));
        $nombres = $this->sacaNombres($this->request->getPost("origenId"), $transferencia, $this->request->getPost("destinoId"), $this->request->getPost("driverId"), $this->request->getPost("routeId"), $this->request->getPost("vehicleId"));
        $guiacab->setorigenName($nombres['origen']);
        $guiacab->setdestinoName($nombres['destino']);
        $guiacab->setdriverName($nombres['chofer']);
        $guiacab->setrouteName($nombres['ruta']);
        $guiacab->setvehicleName($nombres['carro']);  // placa

        if (!$guiacab->save()) {

            foreach ($guiacab->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                        'action' => 'edit',
                        'params' => [$guiacab->refNumber]
            ]);
        }

        $this->dispatcher->forward([
            'controller' => "guiacab",
            'action' => 'productos',
            'params' => [$guiacab->refNumber]
        ]);
    }

    public function deleteAction($refNumber) {
        $parameters = array('conditions' => '[refNumber] = :numero:', 'bind' => array('numero' => $refNumber));
        $guiacab = Guiacab::findFirst($parameters);
        if ($guiacab == false) {
            $this->flash->error("Esta guia de remision no existe");
            return $this->dispatcher->forward(
                            [
                                "action" => "index",
                            ]
            );
        }

        $clave = $guiacab->txnID;
        $params = array('conditions' => '[IDKEY] = :numero:', 'bind' => array('numero' => $clave));
        $guiatrx = Guiatrx::find($params);
        if (!$guiatrx->delete()) {
            foreach ($guiatrx->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }
        if (!$guiacab->delete()) {
            foreach ($guiacab->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }

        $this->flash->success("Guia de remision eliminada " . $refNumber);

        $this->dispatcher->forward([
            'action' => "search"
        ]);
    }

    public function delproductoAction($txnID, $refNumber) {
        $guiatrx = Guiatrx::findFirstBytxnID($txnID);
        if (!$guiatrx) {
            $this->flash->error("Producto no existe");

            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }

        if (!$guiatrx->delete()) {

            foreach ($guiatrx->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                        'action' => 'productos',
                        'params' => [$refNumber]
            ]);
        }

        $this->dispatcher->forward([
            'action' => "productos",
            'params' => [$refNumber]
        ]);
    }

}
