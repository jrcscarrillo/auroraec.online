<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class GuiaController extends ControllerBase {

    protected $ambiente;
    protected $txt_ambiente;
    protected $firmado;
    protected $nombres;

    public function initialize() {
        $this->tag->setTitle('Guias');
        parent::initialize();
    }

    public function indexAction() {
        $this->session->conditions = null;
        $this->view->form = new GuiaForm;
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
                "controller" => "guia",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $guiacab,
            'limit' => 100,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    public function firmarAction($refNumber) {


        $parameters = array('conditions' => '[refNumber] = :numero:', 'bind' => array('numero' => $refNumber));
        $guia = Guiacab::findFirst($parameters);
        if ($guia == false) {
            $this->flash->error("Esta guia de remision no existe");
            return $this->dispatcher->forward(
                            [
                                "action" => "index",
                            ]
            );
        }

        $this->_registerGuia($guia);
        $dedonde = $this->session->get('vinode');

        $transferencia = 'TRANSFERENCIA';
        $contribuyente = $this->session->get('contribuyente');
        $parameters = array('conditions' => 'IDKEY = :clave:', 'bind' => array('clave' => $guia->gettxnID()));
        $productos = Guiatrx::find($parameters);
        $this->sacaNombres($guia->getorigenId(), $transferencia, $guia->getdestinoId(), $guia->getdriverId(), $guia->getrouteId(), $guia->getvehicleId());

        $estado = $this->firmaGuia($guia);

        $this->view->guia = $guia;
        $this->view->contribuyente = $contribuyente;
        $this->view->cliente = $cliente;
        $this->view->nombres = $this->nombres;
        $this->view->productos = $productos;

        if ($estado === 'RECIBIDA') {
            return $this->dispatcher->forward([
                        'action' => 'autorizar',
                        'params' => [$refNumber]
            ]);
        }
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

        $this->sacaNombres($origen, $tipo, $destino, $chofer, $ruta, $carro);
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
            'origenaddress' => $this->nombres['origenaddress'],
            'origennumeroid' => $this->nombres['origennumeroid'],
            'origentipoid' => $this->nombres['origentipoid'],
            'carroplaca' => $this->nombres['carroplaca'],
            'destinoaddress' => $this->nombres['destinoaddress'],
            'ruta' => $this->nombres['ruta'],
            'destinonumeroid' => $this->nombres['destinonumeroid'],
            'destinotipoid' => $this->nombres['destinotipoid'],
            'chofernumeroId' => $this->nombres['chofernumeroId'],
            'chofertipoId' => $this->nombres['chofertipoId'],
            'chofer' => $this->nombres['chofer'],
            'destino' => $this->nombres['destino'],
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
        $this->nombres['recibida'] = $mensaje;
        if ($mensaje == "RECIBIDA") {
            $this->nombres['errorrecepcion'] = 'EN ' . $this->txt_ambiente . $mensaje . ' la guia remision esta => ' . $mensaje;
            $param['mensaje'] = 'RECIBIDA';
            $this->guiaAutorizada($param);
        }

        return $param['mensaje'];
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
            $this->nombres['autorizado'] = "AUTORIZADO";
            $this->nombres['errorautorizado'] = $param['mensaje'];
            $this->nombres['numeroautorizacion'] = $nroAut;
            $this->nombres['fechaautorizacion'] = $fecAut;
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

        $dedonde = $this->session->get('vinode');

        $parameters = array('conditions' => '[refNumber] = :numero:', 'bind' => array('numero' => $refNumber));
        $guia = Guiacab::findFirst($parameters);
        if ($guia == false) {
            $this->flash->error("Esta guia de remision no existe");
            return $this->dispatcher->forward(
                            [
                                "action" => "index",
                            ]
            );
        }

        if (!$dedonde) {
            $this->sacaNombres($guia->getorigenId(), $transferencia, $guia->getdestinoId(), $guia->getdriverId(), $guia->getrouteId(), $guia->getvehicleId());
        }

        $this->_cargarGuia($refNumber);
        $this->nombres['errorautorizado'] = 'Guia de Retencion Seleccionada || ' . $refNumber;
        $mensaje = $this->claves->respuestaSRI($this->firmado, $this->ambiente);
        $this->nombres['autorizado'] = $mensaje['mensaje'];
        if ($mensaje['mensaje'] === "AUTORIZADO") {
            $this->guiaAutorizada($mensaje);
        } else {
            $this->nombres['errorautorizado'] = 'EN ' . $this->txt_ambiente . $mensaje['mensaje'];
        }



        $transferencia = 'TRANSFERENCIA';
        $contribuyente = $this->session->get('contribuyente');
        $parameters = array('conditions' => 'IDKEY = :clave:', 'bind' => array('clave' => $guia->gettxnID()));
        $productos = Guiatrx::find($parameters);

        $this->view->guia = $guia;
        $this->view->contribuyente = $contribuyente;
        $this->view->cliente = $cliente;
        $this->view->nombres = $this->nombres;
        $this->view->productos = $productos;

        $this->session->remove('vinode');
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

    public function sacaNombres($origen, $tipo, $destino, $chofer, $ruta, $carro) {
        $this->nombres = array();
        $a_origen = Bodegas::findFirstByListID($origen);
        $this->nombres['origenId'] = $origen;
        $this->nombres['origen'] = $a_origen->Name;
        $this->nombres['origenaddress'] = $a_origen->BodegaAddress;
        $this->nombres['origentipoid'] = $a_origen->TipoID;
        $this->nombres['origennumeroid'] = $a_origen->NumeroID;
        $this->nombres['origenemail'] = $a_origen->Email;

        if ($tipo === 'CLIENTE') {
            $a_destino = Customer::findFirstByListID($destino);
            $this->nombres['destinoId'] = $destino;
            $this->nombres['destino'] = $a_destino->Name;
            $this->nombres['destinoaddress'] = $a_destino->BillAddress_Addr1;
            if ($a_destino->CustomerTypeRef_FullName === 'RUC') {
                $tipo_aux = '04';
            } elseif ($a_destino->CustomerTypeRef_FullName === 'CEDULA') {
                $tipo_aux = '05';
            } elseif ($a_destino->CustomerTypeRef_FullName === 'PASAPORTE') {
                $tipo_aux = '06';
            } elseif ($a_destino->CustomerTypeRef_FullName === 'EXTRANJERO') {
                $tipo_aux = '07';
            }
            $this->nombres['destinotipoid'] = $tipo_aux;
            $this->nombres['destinonumeroid'] = $a_destino->AccountNumber;
            $this->nombres['destinoemail'] = $a_destino->Email;
        } else {
            $a_destino = Bodegas::findFirstByListID($destino);
            $this->nombres['destinoId'] = $destino;
            $this->nombres['destino'] = $a_destino->Name;
            $this->nombres['destinoaddress'] = $a_destino->BodegaAddress;
            $this->nombres['destinotipoid'] = $a_destino->TipoID;
            $this->nombres['destinonumeroid'] = $a_destino->NumeroID;
            $this->nombres['destinoemail'] = $a_destino->Email;
        }

        $a_chofer = Driver::findFirstBylistID($chofer);
        $this->nombres['choferId'] = $chofer;
        $this->nombres['chofer'] = $a_chofer->name;
        $this->nombres['choferaddress'] = $a_chofer->address;
        $this->nombres['chofertipoId'] = $a_chofer->tipoId;
        $this->nombres['chofernumeroId'] = $a_chofer->numeroId;

        $a_ruta = Route::findFirstBylistID($ruta);
        $this->nombres['rutaId'] = $ruta;
        $this->nombres['ruta'] = $a_ruta->description;

        $a_carro = Vehicle::findFirstBylistID($carro);
        $this->nombres['carroId'] = $carro;
        $this->nombres['carro'] = $a_carro->description;
        $this->nombres['carroplaca'] = $a_carro->name;

        $this->nombres['recibida'] = 'no filling';
        $this->nombres['autorizado'] = 'no filling';
        $this->nombres['errorautorizado'] = 'no filling';
        $this->nombres['errorrecepcion'] = 'no filling';
        $this->nombres['fechaautorizacion'] = 'no filling';
        $this->nombres['numeroautorizacion'] = 'no filling';
    }

}
