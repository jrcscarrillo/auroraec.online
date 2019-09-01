<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class RetenciondbController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Retencion');
        parent::initialize();
    }

    public function indexAction() {
        $this->session->conditions = null;
        $this->view->form = new RetencionForm;
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
            $this->flash->notice("La busqueda no produjo registros de retenciones con los parametros");

            $this->dispatcher->forward([
               "controller" => "retenciondb",
               "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
           'data' => $vendorcredit,
           'limit' => 10,
           'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    public function newAction() {
        $form = new RetencionNewForm();
        $this->view->form = $form;
    }
}

