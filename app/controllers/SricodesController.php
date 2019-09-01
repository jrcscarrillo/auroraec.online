<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class SricodesController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Conceptos SRI');
        parent::initialize();
    }

    public function indexAction() {
        $this->session->conditions = null;
        $this->view->form = new ConceptoSRISearchForm();
    }

    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Sricodes', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "ListID";

        $sricodes = Sricodes::find($parameters);
        if (count($sricodes) == 0) {
            $this->flash->notice("No se ha encontrado los conceptos de retencion del SRI");

            $this->dispatcher->forward([
                "controller" => "sricodes",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $sricodes,
            'limit' => 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        $form = new ConceptoRetencionForm();
        $this->view->form = $form;
    }

    /**
     * Edits a sricode
     *
     * @param string $ListID
     */
    public function editAction($ListID) {
        if (!$this->request->isPost()) {

            $sricode = Sricodes::findFirstByListID($ListID);
            if (!$sricode) {
                $this->flash->error("sricode was not found");

                $this->dispatcher->forward([
                    'controller' => "sricodes",
                    'action' => 'index'
                ]);

                return;
            }

            $form = new ConceptoRetencionForm();

            $this->tag->setDefault("ListID", $sricode->getListid());

            $this->tag->setDefault("NombreConcepto", $sricode->getFullname());
            $this->tag->setDefault("ItemRef", $sricode->getItemrefListid());
            $this->tag->setDefault("CodigoConcepto", $sricode->getValuecode());
            $this->tag->setDefault("tipoconcepto", $sricode->getCodetype());
            $this->tag->setDefault("Percentaje", $sricode->getPercentaje());
        }

        $this->view->form = $form;
    }

    /**
     * Creates a new sricode
     */
    public function createAction() {

//        print_r($this->request->getPost());

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "sricodes",
                'action' => 'index'
            ]);

            return;
        }

        $form = new ConceptoRetencionForm();
        $data = $this->request->getPost();
        if (!$form->isValid($data)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            return $this->dispatcher->forward(
                            [
                                "controller" => "sricodes",
                                "action" => "new",
                            ]
            );
        }
        $sricode = new Sricodes();
        $estado = 'GRABADO';
        $retenciones = Items::findFirst([
                    "conditions" => "quickbooks_listid = ?1",
                    "bind" => [1 => $this->request->getPost('ItemRef')]
        ]);
        if ($retenciones) {
            $sricode->setitemRefFullName($retenciones->getdescripcion());
        } else {
            $sricode->setitemRefFullName($this->request->getPost('ItemRef'));
        }

        $tipoconcepto = array("1" => "RENTA", "2" => "IVA", "6" => "ISD");
        $tipocpto = $tipoconcepto[$this->request->getPost('tipoconcepto')];

        $listID = $this->request->getPost('tipoconcepto') . '-' . $this->request->getpost('CodigoConcepto');
        $sricode->setlistID($listID);
        $sricode->setfullName($this->request->getPost("NombreConcepto"));
        $sricode->setitemRefListID($this->request->getPost("ItemRef"));

        $sricode->setvalueCode($this->request->getPost("CodigoConcepto"));
        $sricode->setcodeType($tipocpto);
        $sricode->setpercentaje($this->request->getPost("Percentaje"));
        $sricode->setestado($estado);


        if (!$sricode->save()) {
            foreach ($sricode->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "sricodes",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Se ha adicionado un nuevo concepto de retencion");

        $this->dispatcher->forward([
            'controller' => "sricodes",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a sricode edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "sricodes",
                'action' => 'index'
            ]);

            return;
        }

        $ListID = $this->request->getPost("ListID");
        $sricode = Sricodes::findFirstByListID($ListID);

        if (!$sricode) {
            $this->flash->error("sricode does not exist " . $ListID);

            $this->dispatcher->forward([
                'controller' => "sricodes",
                'action' => 'index'
            ]);

            return;
        }

        $fecha = date('Y-m-d H:m:s');
        $sricode->settimeModified($fecha);

        $estado = 'ACTUALIZADO';
        $retenciones = Items::findFirst([
                    "conditions" => "quickbooks_listid = ?1",
                    "bind" => [1 => $this->request->getPost('ItemRef')]
        ]);
        if ($retenciones) {
            $sricode->setitemRefFullName($retenciones->getdescripcion());
        } else {
            $sricode->setitemRefFullName($this->request->getPost('ItemRef'));
        }

        $tipoconcepto = array("1" => "RENTA", "2" => "IVA", "6" => "ISD");
        $tipocpto = $tipoconcepto[$this->request->getPost('tipoconcepto')];

        $sricode->setfullName($this->request->getPost("NombreConcepto"));
        $sricode->setitemRefListID($this->request->getPost("ItemRef"));
        $sricode->setvalueCode($this->request->getPost("CodigoConcepto"));
        $sricode->setpercentaje($this->request->getPost("Percentaje"));
        $sricode->setcodeType($tipocpto);

        if (!$sricode->save()) {

            foreach ($sricode->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "sricodes",
                'action' => 'edit',
                'params' => [$sricode->getListid()]
            ]);

            return;
        }

        $this->flash->success("sricode was updated successfully");

        $this->dispatcher->forward([
            'controller' => "sricodes",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a sricode
     *
     * @param string $ListID
     */
    public function deleteAction($ListID) {
        $sricode = Sricodes::findFirstByListID($ListID);
        if (!$sricode) {
            $this->flash->error("Ese concepto de retencion no ha sido encontrado");

            $this->dispatcher->forward([
                'controller' => "sricodes",
                'action' => 'index'
            ]);

            return;
        }

        if (!$sricode->delete()) {

            foreach ($sricode->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "sricodes",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("Concepto de retencion eliminado");

        $this->dispatcher->forward([
            'controller' => "sricodes",
            'action' => "index"
        ]);
    }

}
