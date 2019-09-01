<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class RetenciondbController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Retencion');
        parent::initialize();
    }

    public function indexAction() {
        /**
         *      controlacceso revisa que este un usuario logeado, que el contribuyente este seleccionado
         *      que tenga una licencia valida
         *      @var session $pendiente
         */
        $estado = $this->claves->controlacceso();
        if ($estado === 'OK') {
            
        } else {

            return $this->dispatcher->forward([
                        "controller" => "index",
                        "action" => "index"
            ]);
        }

        $ruc = $this->session->get('contribuyente');

        $parameters = array('conditions' => '[Status] = :estado:', 'bind' => array('estado' => "PENDIENTE"));
        $retencion = new Vendorcredit();
        $retencion = Vendorcredit::findFirst($parameters);
        $fecha = date('Y-m-d');
        if ($retencion) {

            if (!$this->request->isPost()) {

                $fecha = date('Y-m-d', strtotime($retencion->getTxnDate()));
                $this->tag->setDefault("numeroretencion", $retencion->TxnID);
                $this->tag->setDefault("numerofactura", $retencion->CustomField4);

                $this->tag->setDefault("notaproveedor", $retencion->CustomField2);
                $this->tag->setDefault("condiciones", $retencion->CustomField3);
                $this->tag->setDefault("referencia", $retencion->Memo);
            }
        } else {
            $tipocod = 'NUM' . $ruc['estab'] . $ruc['punto'];
            $calificado = 'RETENCION';
            $numnota = $this->claves->numeroenserie($tipocod, $calificado);
            $numerocr = $ruc['estab'] . '-' . $ruc['punto'] . '-' . $numnota;
            $this->tag->setDefault("numeroretencion", $numerocr);
        }
        $this->tag->setDefault("fechaemision", $fecha);

        $parameters = array('order' => 'TimeModified DESC', 'limit' => 1);

        $compra = Vendorcredit::find($parameters);
        $form = new NuevaRetencionForm;

        if ($this->request->isPost()) {

            if ($form->isValid($this->request->getPost())) {
                $estado = $this->factura_to_retencion();
                if ($estado) {
                    return $this->dispatcher->forward([
                                "action" => "productos",
                                'params' => [$this->request->getPost('numerofactura'), $this->request->getPost('numeroretencion')]
                    ]);
                } else {
                    $this->flash->error('DESASTRE !!! llamar urgentemente al administrador');
                    return $this->dispatcher->forward([
                                "controller" => "home",
                                "action" => "index"
                    ]);
                }
            }
        }

        $this->view->form = $form;
        $this->view->ruc = $ruc;
        $this->view->retencion = $compra;
    }

    private function factura_to_retencion() {

        $factura = $this->request->getPost('numerofactura');
        $ruc = $this->session->get('contribuyente');
        $compra = new Bill();
        $compra = Bill::findFirstByRefNumber($factura);
        $retencion = new Vendorcredit();
        $retencion = Vendorcredit::findFirstByTxnID($this->request->getPost('numeroretencion'));
        if (!$retencion) {
            $retencion = new Vendorcredit();
        }
        $tipocod = 'NUM' . $ruc['estab'] . $ruc['punto'];
        $calificado = 'TICKET';
        $numero = $this->claves->numeroenserie($tipocod, $calificado);
        $fecha = date('Y-m-d H:m:s');
        $retencion->setTxnID($this->request->getPost('numeroretencion'));
        $val = rand(10000, 10000000);
        $retencion->setEditSequence($val);

        $retencion->setTxnNumber($numero);
        $retencion->setVendorRefListID($compra->getVendorRefListID());
        $retencion->setVendorRefFullName($compra->getVendorRefFullName());
        $retencion->setAPAccountRefListID($compra->getAPAccountRefListID());
        $retencion->setAPAccountRefFullName($compra->getAPAccountRefFullName());
        $retencion->setCurrencyRefListID($compra->getCurrencyRefListID());
        $retencion->setCurrencyRefFullName($compra->getCurrencyRefFullName());
        $retencion->setTxnDate(date('Y-m-d H:m:s', strtotime($this->request->getPost('fechaemision'))));
        $retencion->setRefNumber($this->request->getPost('numeroretencion'));
        $val = 0;
        $retencion->setCreditAmount($val);
        $retencion->setCreditAmountInHomeCurrency($val);
        $retencion->setOpenAmount($val);
        $retencion->setMemo($this->request->getPost('referencia'));
        $retencion->setCustomField2($this->request->getPost('notaproveedor'));
        $retencion->setCustomField3($this->request->getPost('condiciones'));
        $retencion->setCustomField4($this->request->getPost('numerofactura'));
        $retencion->setCustomField5($compra->getTxnDate());
        $retencion->setCustomField6($compra->vendor->getVendorAddress_Addr1());
        $string = 'SIN IMPRIMIR';
        $retencion->setCustomField10($string);
        $string = 'SIN FIRMAR';
        $retencion->setCustomField15($string);
        $string = 'PENDIENTE';
        $retencion->setStatus($string);


        if (!$retencion->save()) {
            $messages = $retencion->getMessages();
            foreach ($messages as $message) {
                $this->flash->error((string) $message);
            }
            return false;
        }
        return true;
    }

    public function productosAction($factura, $refNumber) {

        $this->flash->clear();
        $compra = Bill::findFirstByRefNumber($factura);

        if (!$compra) {
            $this->flash->warning("no se ha encontrado la factura de compra origen" . $factura);

            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }
        $retencion = Vendorcredit::findFirstByTxnID($refNumber);

        if (!$retencion) {
            $this->flash->warning("no se ha encontrado la retencion" . $factura);

            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }

        $ruc = $this->session->get('contribuyente');

        if (!$valores) {
            $valores = array();
        }

        $valores['factura'] = $compra->getRefNumber();
        $valores['refnumber'] = $retencion->getRefNumber();
        $valores['baseimponible'] = 0;
        $valores['subtotal'] = 0;

        $TxnID = $retencion->getTxnID();
        $form = new RetencionProductoForm;
        $parameters = array('conditions' => '[IDKEY] = :clave:', 'bind' => array('clave' => $TxnID));
        $retencionline = Txnitemlinedetail::find($parameters);

        foreach ($retencionline as $producto) {
            $valores['baseimponible'] = $valores['baseimponible'] + $producto->getQuantity();
            $valores['subtotal'] = $valores['subtotal'] + $producto->getAmount();
        }

        $this->session->set('valores', $valores);
        $this->view->compra = $compra;
        $this->view->retencion = $retencion;
        $this->view->form = $form;
        $this->view->ruc = $ruc;
        $this->view->ftipo = $destipo;
        $this->view->retencionline = $retencionline;
        $this->tag->setDefault('baseimponible', '');
    }

    public function masproductosAction($refNumber) {

        $valores = $this->session->get('valores');

        if (!$this->request->isPost()) {

            return $this->dispatcher->forward([
                        'controller' => "retenciondb",
                        'action' => 'productos',
                        'params' => [$refNumber]
            ]);
        }

        $form = new RetencionProductoForm;
        $retencionline = new Txnitemlinedetail();
        $retencion = Vendorcredit::findFirstByTxnID($refNumber);
        $parameters = $this->request->getPost('ItemRefListID');
        $item = Sricodes::findFirstByListID($parameters);

        if (!$item) {

            $this->flash->error('TREMENDO ERROR llame urgentemente al Administrador');
        }


        $data = $this->request->getPost();

        if (!$form->isValid($data)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                        "action" => "productos",
                        "params" => [$valores['factura'], $refNumber]
            ]);
        }

        /**
         * @tutorial procesar linea de producto
         * @param string $item->type    El tipo de factura proviene del Quickbooks (inventarios, producto terminado, servicios ..)
         * @param string $retencionline->Qty Cuando es por servicios o otros cargos se puede facturar solo por valor por lo que la cantidad es 1
         */
        $clave = $refNumber . $this->request->getPost("ItemRefListID");
        $fecha = date('Y-m-d H:m:s');
        $retencionline->setTxnLineID($clave);
        $retencionline->setItemRefListID($item->ItemRef_ListID);
        $retencionline->setItemRefFullName($item->ItemRef_FullName);
        if($item->getCodeType() === 'RENTA') {
            $w_cod = '1';
        }
        if($item->getCodeType() === 'IVA') {
            $w_cod = '2';
        }
        if($item->getCodeType() === 'ISD') {
            $w_cod = '6';
        }

        $retencionline->setQuantity($this->request->getPost("base"));
        $retencionline->setCost($item->getPercentaje());
        $retencionline->setCustomField1($item->getCodeType());
        $retencionline->setCustomField2($item->getValueCode());
        $retencionline->setCustomField3($item->getFullName());
        $retencionline->setCustomField4($w_cod);
        $retencionline->setCost($item->getPercentaje());
        $retencionline->setAmount($item->getPercentaje() * $this->request->get('base') / 100);

        $retencionline->setIDKEY($retencion->TxnID);

        $valores['refnumber'] = $refNumber;
        $valores['subtotal'] = $valores['subtotal'] + $this->request->get('base');
        $valores['total'] = $valores['total'] + $item->getPercentaje() * $this->request->get('base') / 100;
        $this->session->set('valores', $valores);

        if (!$retencionline->save()) {

            foreach ($retencionline->getMessages() as $message) {

                $this->flash->error($message . " codigo " . $this->request->getPost('ItemRefListID') . " Producto " . $item->ItemRef_FullName);
            }
            return $this->dispatcher->forward([
                        'action' => 'productos',
                        'params' => [$valores['factura'], $refNumber]
            ]);
        }

        return $this->dispatcher->forward([
                    'action' => 'productos',
                    'params' => [$valores['factura'], $refNumber]
        ]);
    }

    public function delproductoAction($TxnLineID) {
        $retencionline = Txnitemlinedetail::findFirstByTxnLineID($TxnLineID);
        $retencionline->delete();
        $valores = $this->session->get('valores');
        $refNumber = $valores['refnumber'];
        return $this->dispatcher->forward([
                    'action' => 'productos',
                    'params' => [$valores['factura'], $refNumber]
        ]);
    }

    public function facturarAction($RefNumber) {

        $valores = $this->session->get('valores');
        $contribuyente = $this->session->get('contribuyente');
        $retencion = new Vendorcredit();
        $retencion = Vendorcredit::findFirstByTxnID($valores['refnumber']);
        if (!$retencion) {
            $this->flash->error('Que esta pasando con ' . $valores['refnumber'] . ' o sera ' . $RefNumber);
            $this->dispatcher->forward([
                'controller' => "index",
                'action' => 'index'
            ]);

            return;
        }

        $productos = new Txnitemlinedetail();
        $parameters = array('conditions' => '[IDKEY] = :clave:', 'bind' => array('clave' => $retencion->getTxnID()));
        $productos = Txnitemlinedetail::find($parameters);

        $proveedor = new Vendor();
        $proveedor = Vendor::findFirstByListID($retencion->getVendorRefListID());

        if (!$proveedor) {
            $this->flash->error('No hay proveedor? ' . $retencion->getVendorRefFullName());
            return $this->dispatcher->forward([
                        'controller' => "home",
                        'action' => 'index'
            ]);
        }

        $this->session->set('vinode', 'Proceso Ventas');
        $this->view->contribuyente = $contribuyente;
        $this->view->proveedor = $proveedor;
        $this->view->retencion = $retencion;
        $this->view->productos = $productos;
    }

}
