<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class VendorcreditController extends ControllerBase {

    protected $ambiente;
    protected $txt_ambiente;
    protected $firmado;
    protected $docSustento;
    protected $fecSustento;

    public function initialize() {
        $this->tag->setTitle('RetenQB');
        parent::initialize();
    }

    public function indexAction() {
        $this->session->conditions = null;
        $this->view->form = new VendorcreditForm;
    }

    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Vendorcredit', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "RefNumber";

        $vendorcredit = Vendorcredit::find($parameters);
        if (count($vendorcredit) == 0) {
            $this->flash->notice("Esos parametros de busqueda no produjeron resultado alguno, vuelva a intentarlo");

            $this->dispatcher->forward([
                "controller" => "vendorcredit",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $vendorcredit,
            'limit' => 100,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    public function firmarAction($TxnID) {

        /**
         *  En la variable vinode de la $_SESSION se indica que la retencion vino desde el ingreso de datos y no es sincronizada desde el QB
         */
        $vinode = $this->session->get('vinode');
        $parameters = array('conditions' => '[TxnID] = :txnid:', 'bind' => array('txnid' => $TxnID));
        $credito = Vendorcredit::findFirst($parameters);
        if ($credito == false) {
            $this->flash->error("Esta retencion no existe");
            return $this->dispatcher->forward(
                            [
                                "controller" => "creditmemo",
                                "action" => "index",
                            ]
            );
        }

        $this->_registraCredito($credito);

        $recibida = $this->firmaCredito($credito);
        if ($recibida === 'OK') {
            $autorizada = $this->soloautorizar($TxnID);
        }
        if ($recibida != 'OK' && $autorizada != 'OK') {
            return $this->dispatcher->forward(
                            [
                                "controller" => "vendorcredit",
                                "action" => "index",
                            ]
            );
        }
        /**
         *      Si vinode es desde AURORA se retorna al menu principal, caso contrario esta procesando una lista de retenciones y regresa al menu de busqueda de retenciones
         */
        
        if ($vinode) {
            $this->session->remove('vinode');
            return $this->dispatcher->forward(
                            [
                                "controller" => "home",
                                "action" => "index",
                            ]
            );
        } else {
            return $this->dispatcher->forward(
                            [
                                "controller" => "vendorcredit",
                                "action" => "index",
                            ]
            );
        }
    }

    private function soloautorizar($TxnID) {
        $this->_cargarRetencion($TxnID);
        $mensaje = $this->claves->respuestaSRI($this->firmado, $this->ambiente);
        if ($mensaje['mensaje'] === "AUTORIZADO") {
            $this->retencionAutorizada($mensaje);
            return 'OK';
        } else {
            $this->flash->error('EN ' . $this->txt_ambiente . $mensaje['mensaje']);
            return 'ERROR';
        }
    }

    public function _cargarRetencion($TxnID) {
        $parameters = array('conditions' => '[TxnID] = :txnid:', 'bind' => array('txnid' => $TxnID));
        $credito = Vendorcredit::findFirst($parameters);
        if ($credito == false) {
            $this->flash->error("Esta retencion no existe");
            return $this->dispatcher->forward(
                            [
                                "controller" => "vendorcredit",
                                "action" => "index",
                            ]
            );
        }

        $this->_registraCredito($credito);
    }

    public function autorizarAction($TxnID) {

        $this->_cargarRetencion($TxnID);
        $this->flash->success('Retencion del QB Seleccionada || ' . $credito->RefNumber);
        $mensaje = $this->claves->respuestaSRI($this->firmado, $this->ambiente);
        if ($mensaje['mensaje'] === "AUTORIZADO") {
            $this->retencionAutorizada($mensaje);
        } else {
            $this->flash->error('EN ' . $this->txt_ambiente . $mensaje['mensaje']);
        }
        return $this->dispatcher->forward(
                        [
                            "controller" => "vendorcredit",
                            "action" => "search",
                        ]
        );
    }

    public function impresionAction($TxnID) {
        $parameters = array('conditions' => '[TxnID] = :txnid:', 'bind' => array('txnid' => $TxnID));
        $credito = Vendorcredit::findFirst($parameters);
        if ($credito == false) {
            $this->flash->error("Esta retencion no existe");
            return $this->dispatcher->forward(
                            [
                                "controller" => "vendorcredit",
                                "action" => "index",
                            ]
            );
        }

        $this->_registraCredito($credito);

        $this->flash->success('Retencion del QB Seleccionada || ' . $credito->RefNumber);
        $this->respuestaSRI(1);
        $credito->setCustomField10('IMPRESO');
        if (!$credito->save()) {

            foreach ($credito->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "vendorcredit",
                'action' => 'index',
            ]);

            return;
        }
        return $this->dispatcher->forward(
                        [
                            "controller" => "vendorcredit",
                            "action" => "search",
                        ]
        );
    }

    private function respuestaSRI() {
        $w_cabecera = $this->session->get('cabecera');
        $a = $this->session->get('archivos');
        $firmado = $a['firmado'];
        $doc = new DOMDocument();
        $doc->load($firmado);
        $claveAcceso = $doc->getElementsByTagName('claveAcceso')->item(0)->nodeValue;
        $this->session->set('claveAcceso', $claveAcceso);
        $this->topdfrete->llenaRete();
        $this->topdfrete->creaRete(1);
        if ($w_cabecera['CustomField15'] === "AUTORIZADO") {
            $estado = $this->enviarEmail();
        }
    }

    private function enviarEmail() {
        $w_cab = $this->session->get('cabecera');
        $a = $this->session->get('archivos');
        $w_con = $this->session->get('contribuyente');
        $w_aut = $this->session->get('auth');

        $part = '<div><p><strong>FACTURACION ELECTRONICA LOS COQUEIROS</strong></p><br>
           <p>Estimado(a) </p><br><p><strong>' .
                $w_cab['razonSocialComprador'] .
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
        $paraemail['bccemail']['email'] = $w_cab['CustomField12'];
        $paraemail['bccemail']['nombre'] = $w_cab['razonSocialProveedor'];
        $exp = $this->sendmail->enviaEmail($paraemail);
        return $exp;
    }

    function retencionAutorizada($param) {
        $w_cabecera = $this->session->get('cabecera');
        $TxnID = $w_cabecera["TxnID"];
        $credit = Vendorcredit::findFirstByTxnID($TxnID);

        if (!$credit) {
            $this->flash->error("Retencion no existe " . $TxnID);

            $this->dispatcher->forward([
                'controller' => "vendorcredit",
                'action' => 'index'
            ]);
            return;
        }
        $credit->vendor->Email === NULL ? $email = "Sin Email" : $email = $credit->vendor->Email;
        $credit->vendor->Phone === NULL ? $phone = "Sin Email" : $phone = $credit->vendor->Phone;
        $credit->vendor->CompanyName === NULL ? $CompanyName = "" : $CompanyName = $credit->vendor->CompanyName;

        $credit->setCustomField9($CompanyName);
        $credit->setCustomField11($phone);
        $credit->setCustomField12($email);
        if ($param['mensaje'] === "AUTORIZADO") {
            $nroAut = $param['numeroAutorizacion'];
            $fecAut = $param['fechaAutorizacion'];
            $credit->setCustomField14($nroAut);
            $credit->setCustomField13($fecAut);
        }
        $credit->setCustomField15($param['mensaje']);
        if (!$credit->save()) {
            foreach ($credit->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                'controller' => "vendorcredit",
                'action' => 'index',
            ]);

            return;
        }
        $this->_cargarRetencion($TxnID);
        if ($param['mensaje'] === "AUTORIZADO") {
            $this->topdfrete->llenaRete();
            $this->topdfrete->creaRete(2);
        }
        $this->flash->success("la retencion Nro.  " . $TxnID . "  ahora esta  " . $param['mensaje']);
    }

    private function firmaCredito($credito) {
        $this->session->set('stringDetalles', '<impuestos>');

        foreach ($credito->txnitemlinedetail as $producto) {
            if ($producto->ItemRef_ListID <> " ") {
                $stringItem = $this->procesaItem($producto);
            }
        }

        $this->totalCredito($credito);
        $mensaje = $this->claves->sriCliente($this->firmado, $this->ambiente);
        if ($mensaje == "RECIBIDA") {
            $param['mensaje'] = 'RECIBIDA';
            $this->retencionAutorizada($param);
            return 'OK';
        } else {
            $this->flash->error('EN ' . $this->txt_ambiente . $mensaje);
            return 'ERROR';
        }
    }

    function procesaItem($producto) {

        $w_cab = $this->session->get('cabecera');
        $w_string = $this->session->get('stringDetalles');

        $por_reten = $producto->Cost * 100;

        $out_Base = number_format($producto->Quantity, '2', '.', '');
        $out_val = number_format($producto->Amount, '2', '.', '');
        $out_cost = number_format($producto->Cost, '0', '', '');
        $stringDate = strtotime($w_cab['fecSustento']);
        $dateString = date('d/m/Y', $stringDate);
        $stringImpuesto = '<impuesto><codigo>' . $producto->CustomField4 . '</codigo><codigoRetencion>' . $producto->CustomField2 . '</codigoRetencion>';
        $stringImpuesto .= '<baseImponible>' . $out_Base . '</baseImponible>' . '<porcentajeRetener>' . $out_cost . '</porcentajeRetener>';
        $stringImpuesto .= '<valorRetenido>' . $out_val . '</valorRetenido>' . '<codDocSustento>' . '01' . '</codDocSustento>';
        $stringImpuesto .= '<numDocSustento>' . $w_cab['docSustento'] . '</numDocSustento><fechaEmisionDocSustento>' . $dateString . '</fechaEmisionDocSustento>';
        $stringImpuesto .= '</impuesto>';
        $w_string .= $stringImpuesto;
        $this->session->set('stringDetalles', $w_string);
        return true;
    }

    function totalCredito($credito) {

        $a = $this->session->get('archivos');
        $w_cabecera = $this->session->get('cabecera');
        $w_ruc = $this->session->get('contribuyente');
        $salida = $a['generado'];
        $firmado = $a['firmado'];
        $this->firmado = $firmado;
        $pasaXML = $a['creado'];
        $regresaXML = $a['pasado'];
        $paramClave['rucProveedor'] = $credito->vendor->AccountNumber;
        $paramClave['fechaDocumento'] = $w_cabecera['fechaDocumento'];
        $paramClave['numeroDocumento'] = $w_cabecera['numeroDocumento'];
        $paramClave['tipoDocumento'] = '07';
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

        $stringDate = strtotime($w_cabecera['fechaDocumento']);
        $dateString = date('d/m/Y', $stringDate);
        $out_Total = number_format($w_credito['valorTotal'], '2', '.', '');
        $raz = explode(':', $w_cabecera['razonSocialProveedor']);
        $regresaName = $this->claves->limpiaString($raz[0]);
        $regresaDireccion = $this->claves->limpiaString($w_cabecera['direccionProveedor']);

        $stringTributaria = '<infoTributaria><ambiente>' . $w_ruc['ambiente'] . '</ambiente>';
        $stringTributaria .= '<tipoEmision>' . $w_ruc['emision'] . '</tipoEmision><razonSocial>' . $w_ruc['razon'] . '</razonSocial>';
        $stringTributaria .= '<nombreComercial>' . $w_ruc['NombreComercial'] . '</nombreComercial>';
        $stringTributaria .= '<ruc>' . $w_ruc['ruc'] . '</ruc><claveAcceso>' . implode($creaClave['claveAcceso']) . '</claveAcceso><codDoc>07</codDoc>';
        $stringTributaria .= '<estab>' . $w_ruc['estab'] . '</estab><ptoEmi>' . $w_ruc['punto'] . '</ptoEmi><secuencial>' . $creaClave['numeroDocumentoLleno'] . '</secuencial>';
        $stringTributaria .= '<dirMatriz>' . $w_ruc['DirMatriz'] . '</dirMatriz></infoTributaria>';
        $stringDate = strtotime($w_cabecera['fechaDocumento']);
        $dateString = date('d/m/Y', $stringDate);
        $wk_fiscal = date('m/Y', $stringDate);
        $wtipo = '04';
        if (strlen($paramClave['rucProveedor']) < 13) {
            $wtipo = '05';
        }
        $stringCab = '<infoCompRetencion><fechaEmision>' . $dateString
                . '</fechaEmision><dirEstablecimiento>' . $regresaDireccion
                . '</dirEstablecimiento>';
        $stringCab .= '<tipoIdentificacionSujetoRetenido>' . $wtipo . '</tipoIdentificacionSujetoRetenido>';
        $stringCab .= '<razonSocialSujetoRetenido>' . $regresaName . '</razonSocialSujetoRetenido>';
        $stringCab .= '<identificacionSujetoRetenido>' . $paramClave['rucProveedor'] . '</identificacionSujetoRetenido>';
        $stringCab .= '<periodoFiscal>' . $wk_fiscal . '</periodoFiscal></infoCompRetencion>';

        $stringFactura = '<comprobanteRetencion id="comprobante" version="1.0.0">' . $stringTributaria . $stringCab . $this->session->get('stringDetalles') . '</impuestos></comprobanteRetencion>';


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
//        $string_shell = '/bin/bash/ /home/online/public_html/ComprobantesSRI/ecuador/arranca.sh';
//        $ret = shell_exec($string_shell);
//        $ret = shell_exec('/home/online/public_html/public/arranca.sh');
        $docregresa = new DOMDocument();
        $docregresa->load($regresaXML);
        $docregresa->save($firmado);
    }

    private function _registraCredito($arreglo) {

        $doc = $this->claves->generaDoc($arreglo->RefNumber);                   // convertir 1-1-1 a 001-001-000000001
        $aFact = $this->claves->generaDoc($arreglo->CustomField4);
        $numFact = $aFact['estab'] . $aFact['punto'] . $aFact['documento'];
        $this->session->set('cabecera', ['TxnID' => $arreglo->TxnID,
            'TimeCreated' => $arreglo->TimeCreated,
            'TimeModified' => $arreglo->TimeModified,
            'EditSequence' => $arreglo->EditSequence,
            'numeroTransaccion' => $arreglo->TxnNumber,
            'VendorRef_ListID' => $arreglo->VendorRef_ListID,
            'razonSocialProveedor' => $arreglo->VendorRef_FullName,
            'direccionProveedor' => $arreglo->CustomField6,
            'fechaDocumento' => $arreglo->TxnDate,
            'docSustento' => $numFact,
            'fecSustento' => $arreglo->CustomField5,
            'numeroDocumento' => $doc['documento'],
            'CreditAmount' => $arreglo->CreditAmount,
            'CustomField1' => $arreglo->CustomField1,
            'CustomField2' => $arreglo->CustomField2,
            'CustomField3' => $arreglo->CustomField3,
            'CustomField4' => $arreglo->CustomField4,
            'CustomField5' => $arreglo->CustomField5,
            'CustomField9' => $arreglo->CustomField9,
            'CustomField11' => $arreglo->CustomField11,
            'CustomField12' => $arreglo->CustomField12,
            'CustomField13' => $arreglo->CustomField13,
            'CustomField14' => $arreglo->CustomField14,
            'CustomField15' => $arreglo->CustomField15
        ]);
        $parameters = array('conditions' => '[CodEmisor] = :estab: AND [Punto] = :punto:', 'bind' => array('estab' => $doc['estab'], 'punto' => $doc['punto']));
        $contribuyente = Contribuyente::findFirst($parameters);
        if ($contribuyente == false) {
            $this->flash->error("Este contribuyente no existe");
            return $this->dispatcher->forward(
                            [
                                "controller" => "creditmemo",
                                "action" => "search",
                            ]
            );
        }
        $rucPasa = $this->claves->registraContribuyente($contribuyente);
        $this->session->set('contribuyente', $rucPasa);
        $archivos = $this->claves->registraArchivos($rucPasa['estab'], $rucPasa['punto'], $doc['documento'], 'ret', 'retenciones');
        $this->session->set('archivos', $archivos);
        $c = $this->session->get('contribuyente');
        $a = $this->session->get('archivos');
        $this->ambiente = $c['ambiente'];
        $this->firmado = $a['firmado'];
    }

}
