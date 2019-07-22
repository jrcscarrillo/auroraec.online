<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class FacturasController extends ControllerBase {

    protected $ambiente;
    protected $txt_ambiente;
    protected $firmado;

    public function initialize() {
        $this->tag->setTitle('FacturasQB');
        parent::initialize();
    }

    public function indexAction() {
        $this->session->conditions = null;
        $this->view->form = new InvoiceForm;
    }

    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Invoice', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }
        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "RefNumber";
        $miscodigos = Invoice::find($parameters);
        if (count($miscodigos) == 0) {
            $this->flash->notice("El resultado de la busqueda no arrojo ninguna factura sincronizada desde el QB");
            $this->dispatcher->forward([
                "controller" => "invoice",
                "action" => "index"
            ]);
            return;
        }
        $paginator = new Paginator([
            'data' => $miscodigos,
            'limit' => 100,
            'page' => $numberPage
        ]);
        $this->view->page = $paginator->getPaginate();
    }

    public function sincronizarAction($TxnID) {
        $contribuyente = $this->session->get('contribuyente');
        if (!$this->request->isPost()) {

            $invoice = Invoice::findFirstByTxnID($TxnID);
            if (!$invoice) {
                $this->flash->error("Factura " . $TxnID . " no se ha encontrado");

                $this->dispatcher->forward([
                    'controller' => "facturas",
                    'action' => 'index'
                ]);
            }

            if ($invoice->Status === 'FACTURADO') {
                $this->flash->notice("La factura " . $invoice->TxnID . "ya esta ingresada al Quickbooks con este numero secreto " . $invoice->CustomField6);
            } else {

                $invoice->setStatus('PASADO');
                if (!$invoice->save()) {
                    foreach ($reg->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                    $this->flash->error('Esta Factura ' . $invoice->TxnID . ' no puede irse a la cola del Quickbooks ');
                    $this->dispatcher->forward([
                        'controller' => "facturas",
                        'action' => 'search'
                    ]);
                }

                $cola = new QuickbooksQueue();
                $cola->setqbusername('jrcscarrillo');
                $cola->setqbaction('InvoiceAdd');
                $cola->setident($TxnID);
                $cola->setpriority(100);
                $cola->setqbstatus('q');
                $fecha = date('Y-m-d H:i:s');
                $cola->setenqueuedatetime($fecha);
                if (!$cola->save()) {
                    foreach ($cola->getMessages() as $message) {
                        $this->flash->error($message);
                    }

                    $this->dispatcher->forward([
                        'controller' => "home",
                        'action' => 'index'
                    ]);
                }
                $this->flash->notice('La Factura ' . $invoice->TxnID . 'se ha ingresado a la cola del Quickbooks con este numero ');
            }
        }
        $productos = $invoice->invoicelinedetail;
        $ListID = $invoice->getCustomerRefListID();
        $cliente = Customer::findFirstByListID($ListID);

        $this->view->invoice = $invoice;
        $this->view->contribuyente = $contribuyente;
        $this->view->cliente = $cliente;
        $this->view->productos = $productos;
    }

}
