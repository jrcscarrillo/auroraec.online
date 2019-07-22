<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class NotacreditoController extends ControllerBase {

    public $ambiente;
    public $txt_ambiente;
    public $firmado;

    public function initialize() {
        $this->tag->setTitle('NotasQB');
        parent::initialize();
    }

    public function indexAction() {
        $this->session->conditions = null;
        $this->view->form = new CreditmemoForm;
    }

    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Creditmemo', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "RefNumber";

        $creditmemo = Creditmemo::find($parameters);
        if (count($creditmemo) == 0) {
            $this->flash->notice("No existen notas de credito bajo esos parametros");

            $this->dispatcher->forward([
                "controller" => "creditmemo",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $creditmemo,
            'limit' => 100,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    public function sincronizarAction($TxnID) {
        $contribuyente = $this->session->get('contribuyente');
        if (!$this->request->isPost()) {

            $credito = Creditmemo::findFirstByTxnID($TxnID);
            if (!$credito) {
                $this->flash->error("Nota de Credito " . $TxnID . " no se ha encontrado");

                $this->dispatcher->forward([
                    'controller' => "notacredito",
                    'action' => 'index'
                ]);
            }

            if ($credito->Status === 'FACTURADO') {
                $this->flash->notice("La nota de credito " . $credito->TxnID . "ya esta ingresada al Quickbooks con este numero secreto " . $credito->CustomField6);
            } else {

                $credito->setStatus('PASADO');
                if (!$credito->save()) {
                    foreach ($reg->getMessages() as $message) {
                        $this->flash->error($message);
                    }
                    $this->flash->error('Esta Nota de Credito ' . $credito->TxnID . ' no puede irse a la cola del Quickbooks ');
                    $this->dispatcher->forward([
                        'controller' => "notacredito",
                        'action' => 'search'
                    ]);
                }

                $cola = new QuickbooksQueue();
                $cola->setqbusername('jrcscarrillo');
                $cola->setqbaction('CreditMemoAdd');
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
                $this->flash->notice('La Nota de Credito ' . $credito->TxnID . 'se ha ingresado a la cola del Quickbooks con este numero ');
            }
        }
        $productos = $credito->creditmemolinedetail;
        $ListID = $credito->getCustomerRefListID();
        $cliente = Customer::findFirstByListID($ListID);

        $this->view->credito = $credito;
        $this->view->contribuyente = $contribuyente;
        $this->view->cliente = $cliente;
        $this->view->productos = $productos;

    }

}
