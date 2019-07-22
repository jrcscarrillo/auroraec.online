<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CreditodbController extends ControllerBase {

    public $ambiente;
    public $txt_ambiente;
    public $firmado;

    public function initialize() {
        $this->tag->setTitle('Notas de CR');
        parent::initialize();
    }

    public function productosAction($numerofactura, $numeronotacr) {
        /**
         * 
         * @return true if everything is OK
         * @documentation create a session array with the invoice items plus the variables of quantity and price to use in the credit memo document
         * 
         */
        $valor = 0;
        $l = $this->generaTmp($numerofactura, $numeronotacr);
        for ($index = 0; $index < $l; $index++) {

            $campo1 = 'cantidad' . $index;
            $this->tag->setDefault($campo1, $valor);
            $campo2 = 'preciounitario' . $index;
            $this->tag->setDefault($campo2, $valor);
            $campo3 = 'preciototal' . $index;
            $this->tag->setDefault($campo3, $valor);
        }
        $form = new ProductosCRForm;
        $paraforma = $this->session->get('paraforma');
        $this->view->form = $form;
        $this->view->paraforma = $paraforma;
    }

    public function descuentosAction($numerofactura, $numeronotacr) {
        /**
         * 
         * @return true if everything is OK
         * @documentation create a session array with the invoice items plus the variables of quantity and price to use in the credit memo document
         * 
         */
        $valor = 0;
        $l = $this->generaTmp($numerofactura, $numeronotacr);
        for ($index = 0; $index < $l; $index++) {

            $campo1 = 'cantidad' . $index;
            $this->tag->setDefault($campo1, $valor);
            $campo2 = 'preciounitario' . $index;
            $this->tag->setDefault($campo2, $valor);
            $campo3 = 'preciototal' . $index;
            $this->tag->setDefault($campo3, $valor);
        }
        $form = new ProductosCRForm;
        $paraforma = $this->session->get('paraforma');
        $this->view->form = $form;
        $this->view->paraforma = $paraforma;
    }

    public function generaTmp($numerofactura, $numeronotacr) {

        $invoice = new Invoice();
        $invoice = Invoice::findFirstByTxnID($numerofactura);
        $parameters = array('conditions' => 'IDKEY = :clave:', 'bind' => array('clave' => $numerofactura));
        $productos = Invoicelinedetail::find($parameters);
        $creditmemo = new Creditmemo();
        $creditmemo = Creditmemo::findFirstByTxnID($numeronotacr);

        $i = 1;
        $valor = 0.00;
        $paraforma = array();
        $paraforma['numerofactura'] = $invoice->getTxnID();
        $paraforma['tipoitem'] = $invoice->getOther();
        $paraforma['numeronotacr'] = $creditmemo->getTxnID();
        $paraforma['referencia'] = $creditmemo->getMemo();
        $paraforma['notas'] = $creditmemo->getCustomField2();
        $paraforma['condiciones'] = $creditmemo->getCustomField3();
        $paraforma['tiponotacr'] = $creditmemo->getCustomField4();
        $paraforma['fechanotacr'] = $creditmemo->getTxnDate();
        $paraforma['txnnumber'] = $creditmemo->getTxnNumber();
        foreach ($productos as $item) {
            $paraforma['items'][$i]['TxnLineID'] = $item->getTxnLineID();
            $paraforma['items'][$i]['ItemRefListID'] = $item->getItemRefListID();
            $paraforma['items'][$i]['ItemRefFullName'] = $item->getItemRefFullName();
            $paraforma['items'][$i]['Rate'] = $item->getRate();
            $paraforma['items'][$i]['TaxRate'] = $item->getTaxRate();
            $paraforma['items'][$i]['Quantity'] = $item->getQuantity();
            $paraforma['items'][$i]['Amount'] = $item->getAmount();
            $campo1 = 'cantidad' . $i;
            $campo2 = 'preciounitario' . $i;
            $campo3 = 'preciototal' . $i;
            $paraforma['items'][$i][$campo1] = $valor;
            $paraforma['items'][$i][$campo2] = $valor;
            $paraforma['items'][$i][$campo3] = $valor;
            $i++;
        }

        $this->session->set('paraforma', $paraforma);
        return $i;
    }

    private function factura_to_notaCR() {

        $factura = $this->request->getPost('numerofactura');
        $ruc = $this->session->get('contribuyente');
        $invoice = new Invoice();
        $invoice = Invoice::findFirstByTxnID($factura);
        $credito = new Creditmemo();
        $tipocod = 'NUM' . $ruc['estab'] . $ruc['punto'];
        $calificado = 'TICKET';
        $numero = $this->claves->numeroenserie($tipocod, $calificado);
        $fecha = date('Y-m-d H:m:s');
        $credito->TxnID = $this->request->getPost('numeronotacr');
        $credito->EditSequence = rand(10000, 10000000);
        $credito->TxnNumber = $numero;
        $credito->CustomerRef_ListID = $invoice->getCustomerRefListID();
        $credito->CustomerRef_FullName = $invoice->getCustomerRefFullName();
        $credito->ClassRef_ListID = $invoice->getClassRefListID();
        $credito->ClassRef_FullName = $invoice->getClassRefFullName();
        $credito->TxnDate = date('Y-m-d H:m:s', strtotime($this->request->getPost('fechaemision')));
        $credito->RefNumber = $this->request->getPost('numeronotacr');
        $credito->BillAddress_Addr1 = $invoice->getBillAddressAddr1();
        $credito->BillAddress_City = $invoice->getBillAddressCity();
        $credito->BillAddress_State = $invoice->getBillAddressState();
        $credito->BillAddress_PostalCode = $invoice->getBillAddressPostalCode();
        $credito->BillAddress_Country = $invoice->getBillAddressCountry();
        $credito->IsPending = 'false';
        $credito->DueDate = $fecha;
        $credito->SalesRepRef_ListID = $invoice->getSalesRepRefListID();
        $credito->SalesRepRef_FullName = $invoice->getSalesRepRefFullName();
        $credito->FOB = ' ';
        $credito->ShipDate = $fecha;
        $credito->Subtotal = 0;
        $credito->SalesTaxPercentage = 0;
        $credito->SalesTaxTotal = 0;
        $credito->TotalAmount = 0;
        $credito->CreditRemaining = 0;
        $credito->Memo = $this->request->getPost('referencia');
        $credito->CustomField2 = $this->request->getPost('notacomprador');
        $credito->CustomField3 = $this->request->getPost('condiciones');
        $credito->CustomField4 = $this->request->getPost('tiponotacr');
        $credito->CustomField5 = $this->request->getPost('aplica');
        $credito->Other = $this->request->getPost('numerofactura');
        $credito->CustomField10 = 'SIN IMPRIMIR';
        $credito->CustomField15 = 'SIN FIRMAR';
        $credito->Status = 'PENDIENTE';


        if (!$credito->save()) {
            $messages = $credito->getMessages();
            foreach ($messages as $message) {
                $this->flash->error((string) $message);
            }
            return false;
        }
        return true;
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
        $creditmemo = new Creditmemo();
        $credito = Creditmemo::findFirst($parameters);
        if ($credito) {

            if (!$this->request->isPost()) {

                $this->tag->setDefault("numeronotacr", $credito->TxnID);
                $this->tag->setDefault("numerofactura", $credito->Other);
                $this->tag->setDefault("fechaemision", $credito->TxnDate);
                $this->tag->setDefault("tiponotacr", $credito->CustomField4);
                $this->tag->setDefault("aplica", $credito->CustomField5);
                $this->tag->setDefault("notacomprador", $credito->CustomField2);
                $this->tag->setDefault("condiciones", $credito->CustomField3);
                $this->tag->setDefault("referencia", $credito->Memo);
            }
        } else {
            $tipocod = 'NUM' . $ruc['estab'] . $ruc['punto'];
            $calificado = 'NOTACR';
            $numnota = $this->claves->numeroenserie($tipocod, $calificado);
            $numerocr = $ruc['estab'] . '-' . $ruc['punto'] . '-' . $numnota;
            $this->tag->setDefault("numeronotacr", $numerocr);
        }


        $parameters = array('order' => 'TimeModified DESC', 'limit' => 1);

        $creditmemo = Creditmemo::find($parameters);
        $form = new NuevaNCRForm;

        if ($this->request->isPost()) {

            if ($form->isValid($this->request->getPost())) {
                $estado = $this->factura_to_notaCR();
                if ($estado) {
                    switch ($this->request->getPost('tiponotacr')) {
                        case 29:
                            return $this->dispatcher->forward([
                                        "action" => "valores",
                                        'params' => [$this->request->getPost('numerofactura'), $this->request->getPost('numeronotacr')]
                            ]);

                            break;

                        case 30:
                            return $this->dispatcher->forward([
                                        "action" => "productos",
                                        'params' => [$this->request->getPost('numerofactura'), $this->request->getPost('numeronotacr')]
                            ]);

                            break;

                        case 31:
                            return $this->dispatcher->forward([
                                        'action' => 'descuentos',
                                        'params' => [$this->request->getPost('numerofactura'), $this->request->getPost('numeronotacr')]
                            ]);

                            break;

                        default:
                            return $this->dispatcher->forward([
                                        'action' => 'productos',
                                        'params' => [$this->request->getPost('numerofactura'), $this->request->getPost('numeronotacr')]
                            ]);
                            break;
                    }
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
        $this->view->credito = $creditmemo;
    }

    public function revisarAction() {
        $paraforma = $this->session->get('paraforma');

        if ($paraforma['tiponotacr'] == 29) {
            $this->paravalores();
        } elseif ($paraforma['tiponotacr'] == 30) {
            $this->paraproductos();
        } elseif ($paraforma['tiponotacr'] == 31) {
            $this->paradescuentos();
        }
    }

    public function paravalores() {
        /**
         * 
         * @return no return
         * Para la nota de credito solo por valores
         * @param decimal $valor1
         * @param decimal 
         * @param decimal 
         */
        $paraforma = $this->session->get('paraforma');

        $errCR = false;
        $erroresNCR = array();

        $productos = $paraforma['items'];
        $subtotal = 0;
        $total = 0;
        $iva = 0;
            $campo1 = 'cantidad1';
            $campo2 = 'preciounitario1';
            $campo3 = 'preciototal1';
            $paraforma['items'][$index][$campo1] = 1;
            $paraforma['items'][$index][$campo2] = $this->request->getPost($campo2);
            if ($paraforma['items'][$index]['Rate'] < $this->request->getPost($campo2)) {
                $errCR = true;
                $erroresNCR[$index]['ItemRefFullName'] = $paraforma['items'][$index]['ItemRefFullName'];
            } else {
                $paraforma['items'][$index][$campo3] = $paraforma['items'][$index]['Quantity'] * floatval($this->request->getPost($campo2));
            }
        $this->session->remove('paraforma');
        $this->session->set('paraforma', $paraforma);
        if ($errCR) {
            $this->session->set('erroresNCR', $erroresNCR);
            return $this->dispatcher->forward([
                        "action" => "descuentos",
                        "params" => [$paraforma['numerofactura'], $paraforma['numeronotacr']]
            ]);
        } else {
            $this->session->remove('erroresNCR');
            return $this->dispatcher->forward([
                        "action" => "acreditar"
            ]);
        }
    }

    public function paradescuentos() {
        /**
         * 
         * @return no return
         * Para los descuentos en precio por producto se acepta el valor del descuento en el campo identificado
         * @param entero $campo2 tiene el input como preciounitario$index
         * @param decimal $campo3 tiene el input como preciototal$index y es la multiplicacion de $campo2 * $campo1
         * @param decimal $campo1 tiene el input como cantidad$index pero el valor es tomado de la factura->Quantity
         */
        $paraforma = $this->session->get('paraforma');

        $errCR = false;
        $erroresNCR = array();

        $productos = $paraforma['items'];
        $subtotal = 0;
        $total = 0;
        $iva = 0;
        $l = count($productos) + 1;
        for ($index = 1; $index < $l; $index++) {
            $campo1 = 'cantidad' . $index;
            $campo2 = 'preciounitario' . $index;
            $campo3 = 'preciototal' . $index;
            $paraforma['items'][$index][$campo1] = $paraforma['items'][$index]['Quantity']; 
            $paraforma['items'][$index][$campo2] = $this->request->getPost($campo2);
            if ($paraforma['items'][$index]['Rate'] < $this->request->getPost($campo2)) {
                $errCR = true;
                $erroresNCR[$index]['ItemRefFullName'] = $paraforma['items'][$index]['ItemRefFullName'];
            } else {
                $paraforma['items'][$index][$campo3] = $paraforma['items'][$index]['Quantity'] * floatval($this->request->getPost($campo2));
            }
        }
        $this->session->remove('paraforma');
        $this->session->set('paraforma', $paraforma);
        if ($errCR) {
            $this->session->set('erroresNCR', $erroresNCR);
            return $this->dispatcher->forward([
                        "action" => "descuentos",
                        "params" => [$paraforma['numerofactura'], $paraforma['numeronotacr']]
            ]);
        } else {
            $this->session->remove('erroresNCR');
            return $this->dispatcher->forward([
                        "action" => "acreditar"
            ]);
        }
    }

    public function paraproductos() {

        $paraforma = $this->session->get('paraforma');

        $errCR = false;
        $erroresNCR = array();

        $productos = $paraforma['items'];
        $subtotal = 0;
        $total = 0;
        $iva = 0;
        $l = count($productos) + 1;
        for ($index = 1; $index < $l; $index++) {
            $campo1 = 'cantidad' . $index;
            $campo2 = 'preciounitario' . $index;
            $campo3 = 'preciototal' . $index;
            $paraforma['items'][$index][$campo1] = $this->request->getPost($campo1);
            $paraforma['items'][$index][$campo2] = $paraforma['items'][$index]['Rate']; 
            if ($paraforma['items'][$index]['Quantity'] < $this->request->getPost($campo1)) {
                $errCR = true;
                $erroresNCR[$index]['ItemRefFullName'] = $paraforma['items'][$index]['ItemRefFullName'];
            } else {
                $paraforma['items'][$index][$campo3] = $paraforma['items'][$index][$campo2] * floatval($this->request->getPost($campo1));
            }
        }
        $this->session->remove('paraforma');
        $this->session->set('paraforma', $paraforma);
        if ($errCR) {
            $this->session->set('erroresNCR', $erroresNCR);
            return $this->dispatcher->forward([
                        "action" => "productos",
                        "params" => [$paraforma['numerofactura'], $paraforma['numeronotacr']]
            ]);
        } else {
            $this->session->remove('erroresNCR');
            return $this->dispatcher->forward([
                        "action" => "acreditar"
            ]);
        }
    }

    public function verificarAction() {
        $paraforma = $this->session->get('paraforma');
        $this->view->paraforma = $paraforma;
    }

    public function acreditarAction() {

        $this->session->remove('erroresNCR');
        $paraforma = $this->session->get('paraforma');
        $ruc = $this->session->get('contribuyente');
        $numeronotacr = $paraforma['numeronotacr'];
        $creditmemo = new Creditmemo();
        $creditmemo = Creditmemo::findFirstByTxnID($numeronotacr);

        $iva = 0;
        $totaliva = 0;
        $subtotal = 0;
        
        $l = count($paraforma['items']) + 1;
        for ($index = 1; $index < $l; $index++) {
            $campo1 = 'cantidad' . $index;
            $campo2 = 'preciounitario' . $index;
            $campo3 = 'preciototal' . $index;
            $creditmemodetail = new Creditmemolinedetail();
            $creditmemodetail->setAmount($paraforma['items'][$index][$campo2] * $paraforma['items'][$index][$campo1]);
            $creditmemodetail->setItemRefListID($paraforma['items'][$index]['ItemRefListID']);
            $creditmemodetail->setItemRefFullName($paraforma['items'][$index]['ItemRefFullName']);
            $creditmemodetail->setQuantity($paraforma['items'][$index][$campo1]);
            $creditmemodetail->setRate($paraforma['items'][$index][$campo2]);
            $creditmemodetail->setTaxRate($paraforma['items'][$index]['TaxRate']);
            $creditmemodetail->setTxnLineID($paraforma['numeronotacr'] . '-' . $index);
            $creditmemodetail->setIDKEY($paraforma['numeronotacr']);
            
            $iva = ($paraforma['items'][$index][$campo2] * $paraforma['items'][$index][$campo1] ) * ($paraforma['items'][$index]['TaxRate'] / 100);
            $totaliva = ($iva + $totaliva);
            $subtotal = $subtotal + ($paraforma['items'][$index][$campo2] * $paraforma['items'][$index][$campo1]);
            
            $erroresNCR = array();
            if (!$creditmemodetail->save()) {
                foreach ($creditmemodetail->getMessages() as $message) {
                    $erroresNCR[$index]['ItemRefFullName'] = $paraforma['items'][$index]['ItemRefFullName'] . ' grabando ' . $message;
                }
                $this->session->set('erroresNCR', $erroresNCR);
                return $this->dispatcher->forward([
                            "action" => "productos",
                            "params" => [$paraforma['numerofactura'], $paraforma['numeronotacr']]
                ]);
            }
        }
        $creditmemo->setSubtotal($subtotal);
        $creditmemo->setSalesTaxTotal($totaliva);
        $creditmemo->setTotalAmount($subtotal + $totaliva);
        $creditmemo->setStatus('GRABADO');
        if (!$creditmemo->save()) {
            $this->flash->error("No se ha podido actualizar nota de credito " . $numeronotacr);
            foreach ($creditmemo->getMessages() as $message) {
                $erroresNCR[$index]['ItemRefFullName'] = $paraforma['numeronotacr'] . ' actualizando cabecera ' . $message;
            }
        }
        $this->session->set('vinode', 'Proceso Ventas');
        $this->view->paraforma = $paraforma;
        $this->view->ruc = $ruc;
    }

}
