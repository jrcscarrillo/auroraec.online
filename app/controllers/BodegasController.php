<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class BodegasController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Clase/Bodega');
        parent::initialize();
    }

    public function indexAction() {
        $this->session->conditions = null;
        $this->view->form = new BodegasForm;
    }

    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Bodegas', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "FullName";

        $bodegas = Bodegas::find($parameters);
        if (count($bodegas) == 0) {
            $this->flash->notice("Los parametros de busqueda no han seleccionado clase/bodega alguna");

            $this->dispatcher->forward([
                "controller" => "bodegas",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $bodegas,
            'limit' => 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    public function sinmovAction($ListID) {

        $bodega = Bodegas::findFirstByListID($ListID);
        if (!$bodega) {
            $this->flash->error("bodega was not found");
            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }
        $bodega->setStatus("SIN-MOV");
        if (!$bodega->save()) {
            foreach ($bodega->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }

        $this->flash->success("La bodega no acepta movimientos");

        return $this->dispatcher->forward([
                    'action' => 'index'
        ]);
    }

    public function conmovAction($ListID) {

        $bodega = Bodegas::findFirstByListID($ListID);
        if (!$bodega) {
            $this->flash->error("bodega was not found");
            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }
        $bodega->setStatus("CON-MOV");
        if (!$bodega->save()) {
            foreach ($bodega->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }

        $this->flash->success("La bodega acepta movimientos");

        return $this->dispatcher->forward([
                    'action' => 'index'
        ]);
    }

    public function editAction($ListID) {
        if (!$this->request->isPost()) {

            $bodega = Bodegas::findFirstByListID($ListID);
            if (!$bodega) {
                $this->flash->error("Esta bodega no existe " . $ListID);

                $this->dispatcher->forward([
                    'controller' => "bodegas",
                    'action' => 'index'
                ]);

                return;
            }

            $this->tag->setDefault("ListID", $bodega->getListID());
            $this->tag->setDefault("Name", $bodega->getName());
            $this->tag->setDefault("FullName", $bodega->getFullname());
            $this->tag->setDefault("BodegaAddress", $bodega->getBodegaAddress());
            $this->tag->setDefault("TipoID", $bodega->getTipoID());
            $this->tag->setDefault("NumeroID", $bodega->getNumeroID());
            $this->tag->setDefault("Establecimiento", $bodega->getEstablecimiento());
            $this->tag->setDefault("PuntoEmision", $bodega->getPuntoEmision());
            $this->tag->setDefault("Email", $bodega->getEmail());
            $this->tag->setDefault("Contacto", $bodega->getContacto());
        }
    }

    /**
     * Creates a new bodega
     */
    public function createAction() {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "bodegas",
                'action' => 'index'
            ]);

            return;
        }

        $bodega = new Bodegas();
        $bodega->setlistID($this->request->getPost("ListID"));
        $bodega->settimeCreated($this->request->getPost("TimeCreated"));
        $bodega->settimeModified($this->request->getPost("TimeModified"));
        $bodega->seteditSequence($this->request->getPost("EditSequence"));
        $bodega->setname($this->request->getPost("Name"));
        $bodega->setfullName($this->request->getPost("FullName"));
        $bodega->setisActive($this->request->getPost("IsActive"));
        $bodega->setparentRefListID($this->request->getPost("ParentRef_ListID"));
        $bodega->setparentRefFullName($this->request->getPost("ParentRef_FullName"));
        $bodega->setsublevel($this->request->getPost("Sublevel"));
        $bodega->setbodegaAddress($this->request->getPost("BodegaAddress"));
        $bodega->settipoID($this->request->getPost("TipoID"));
        $bodega->setnumeroID($this->request->getPost("NumeroID"));
        $bodega->setemail($this->request->getPost("Email"));
        $bodega->setcontacto($this->request->getPost("Contacto"));
        $bodega->setstatus($this->request->getPost("Status"));
        $bodega->setestado($this->request->getPost("Estado"));


        if (!$bodega->save()) {
            foreach ($bodega->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "bodegas",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("bodega was created successfully");

        $this->dispatcher->forward([
            'controller' => "bodegas",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a bodega edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "bodegas",
                'action' => 'index'
            ]);

            return;
        }
        $ListID = $this->request->getPost("ListID");
        $bodega = Bodegas::findFirstByListID($ListID);

        if (!$bodega) {
            $this->flash->error("Esta bodega no existe " . $ListID);

            $this->dispatcher->forward([
                'controller' => "bodegas",
                'action' => 'index'
            ]);

            return;
        }

        $bodega->setName($this->request->getPost("Name"));
        $bodega->setFullName($this->request->getPost("FullName"));
        $bodega->setBodegaAddress($this->request->getPost("BodegaAddress"));
        $bodega->setTipoID($this->request->getPost("TipoID"));
        $bodega->setNumeroID($this->request->getPost("NumeroID"));
        $bodega->setEstablecimiento($this->request->getPost("Establecimiento"));
        $bodega->setPuntoEmision($this->request->getPost("PuntoEmision"));
        $bodega->setEmail($this->request->getPost("Email"));
        $bodega->setContacto($this->request->getPost("Contacto"));


        if (!$bodega->save()) {

            foreach ($bodega->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "bodegas",
                'action' => 'edit',
                'params' => [$bodega->getListID()]
            ]);

            return;
        }

        $this->flash->success("Los valores de la bodega fueron actualizados");

        $this->dispatcher->forward([
            'controller' => "bodegas",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a bodega
     *
     * @param string $ListID
     */
    public function deleteAction($ListID) {
        $bodega = Bodegas::findFirstByListID($ListID);
        if (!$bodega) {
            $this->flash->error("bodega was not found");

            $this->dispatcher->forward([
                'controller' => "bodegas",
                'action' => 'index'
            ]);

            return;
        }

        if (!$bodega->delete()) {

            foreach ($bodega->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "bodegas",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("bodega was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "bodegas",
            'action' => "index"
        ]);
    }

}
