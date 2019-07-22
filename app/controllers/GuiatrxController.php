<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class GuiatrxController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for guiatrx
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Guiatrx', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "txnID";

        $guiatrx = Guiatrx::find($parameters);
        if (count($guiatrx) == 0) {
            $this->flash->notice("The search did not find any guiatrx");

            $this->dispatcher->forward([
                "controller" => "guiatrx",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $guiatrx,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a guiatrx
     *
     * @param string $txnID
     */
    public function editAction($txnID)
    {
        if (!$this->request->isPost()) {

            $guiatrx = Guiatrx::findFirstBytxnID($txnID);
            if (!$guiatrx) {
                $this->flash->error("guiatrx was not found");

                $this->dispatcher->forward([
                    'controller' => "guiatrx",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->txnID = $guiatrx->getTxnid();

            $this->tag->setDefault("txnID", $guiatrx->getTxnid());
            $this->tag->setDefault("timeCreated", $guiatrx->getTimecreated());
            $this->tag->setDefault("timeModified", $guiatrx->getTimemodified());
            $this->tag->setDefault("editSequence", $guiatrx->getEditsequence());
            $this->tag->setDefault("numeroLote", $guiatrx->getNumerolote());
            $this->tag->setDefault("ItemRefListID", $guiatrx->getItemreflistid());
            $this->tag->setDefault("ItemRefFullName", $guiatrx->getItemreffullname());
            $this->tag->setDefault("obsLote", $guiatrx->getObslote());
            $this->tag->setDefault("origenTrx", $guiatrx->getOrigentrx());
            $this->tag->setDefault("destinoTrx", $guiatrx->getDestinotrx());
            $this->tag->setDefault("qty", $guiatrx->getQty());
            $this->tag->setDefault("IDKEY", $guiatrx->getIdkey());
            $this->tag->setDefault("estado", $guiatrx->getEstado());
            
        }
    }

    /**
     * Creates a new guiatrx
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "guiatrx",
                'action' => 'index'
            ]);

            return;
        }

        $guiatrx = new Guiatrx();
        $guiatrx->setTxnid($this->request->getPost("txnID"));
        $guiatrx->setTimecreated($this->request->getPost("timeCreated"));
        $guiatrx->setTimemodified($this->request->getPost("timeModified"));
        $guiatrx->setEditsequence($this->request->getPost("editSequence"));
        $guiatrx->setNumerolote($this->request->getPost("numeroLote"));
        $guiatrx->setItemreflistid($this->request->getPost("ItemRefListID"));
        $guiatrx->setItemreffullname($this->request->getPost("ItemRefFullName"));
        $guiatrx->setObslote($this->request->getPost("obsLote"));
        $guiatrx->setOrigentrx($this->request->getPost("origenTrx"));
        $guiatrx->setDestinotrx($this->request->getPost("destinoTrx"));
        $guiatrx->setQty($this->request->getPost("qty"));
        $guiatrx->setIdkey($this->request->getPost("IDKEY"));
        $guiatrx->setEstado($this->request->getPost("estado"));
        

        if (!$guiatrx->save()) {
            foreach ($guiatrx->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "guiatrx",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("guiatrx was created successfully");

        $this->dispatcher->forward([
            'controller' => "guiatrx",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a guiatrx edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "guiatrx",
                'action' => 'index'
            ]);

            return;
        }

        $txnID = $this->request->getPost("txnID");
        $guiatrx = Guiatrx::findFirstBytxnID($txnID);

        if (!$guiatrx) {
            $this->flash->error("guiatrx does not exist " . $txnID);

            $this->dispatcher->forward([
                'controller' => "guiatrx",
                'action' => 'index'
            ]);

            return;
        }

        $guiatrx->setTxnid($this->request->getPost("txnID"));
        $guiatrx->setTimecreated($this->request->getPost("timeCreated"));
        $guiatrx->setTimemodified($this->request->getPost("timeModified"));
        $guiatrx->setEditsequence($this->request->getPost("editSequence"));
        $guiatrx->setNumerolote($this->request->getPost("numeroLote"));
        $guiatrx->setItemreflistid($this->request->getPost("ItemRefListID"));
        $guiatrx->setItemreffullname($this->request->getPost("ItemRefFullName"));
        $guiatrx->setObslote($this->request->getPost("obsLote"));
        $guiatrx->setOrigentrx($this->request->getPost("origenTrx"));
        $guiatrx->setDestinotrx($this->request->getPost("destinoTrx"));
        $guiatrx->setQty($this->request->getPost("qty"));
        $guiatrx->setIdkey($this->request->getPost("IDKEY"));
        $guiatrx->setEstado($this->request->getPost("estado"));
        

        if (!$guiatrx->save()) {

            foreach ($guiatrx->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "guiatrx",
                'action' => 'edit',
                'params' => [$guiatrx->getTxnid()]
            ]);

            return;
        }

        $this->flash->success("guiatrx was updated successfully");

        $this->dispatcher->forward([
            'controller' => "guiatrx",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a guiatrx
     *
     * @param string $txnID
     */
    public function deleteAction($txnID)
    {
        $guiatrx = Guiatrx::findFirstBytxnID($txnID);
        if (!$guiatrx) {
            $this->flash->error("guiatrx was not found");

            $this->dispatcher->forward([
                'controller' => "guiatrx",
                'action' => 'index'
            ]);

            return;
        }

        if (!$guiatrx->delete()) {

            foreach ($guiatrx->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "guiatrx",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("guiatrx was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "guiatrx",
            'action' => "index"
        ]);
    }

}
