<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class GuiacabController extends ControllerBase {

    protected $ambiente;
    protected $txt_ambiente;
    protected $firmado;

    public function initialize() {
        $this->tag->setTitle('Guias');
        parent::initialize();
    }

    public function indexAction() {
        $this->session->conditions = null;
        $this->view->form = new GuiaForm;
    }

    public function aprobarAction($refNumber) {
        
        $guia = new Guiacab();
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

        if ($guia->CustomField15 <> 'GRABADO' && $guia->CustomField15 <> 'SIN FIRMAR') {
            $this->flash->error("Esta guia de remision no esta GRABADA " . $refNumber);
            return $this->dispatcher->forward(
                            [
                                "action" => "index",
                            ]
            );
        }

        $guia->setCustomField15("SIN FIRMAR");
        if (!$guia->save()) {
            foreach ($guia->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }
        $transferencia = 'TRANSFERENCIA';
        $contribuyente = $this->session->get('contribuyente');
        $parameters = array('conditions' => 'IDKEY = :clave:', 'bind' => array('clave' => $guia->gettxnID()));
        $productos = Guiatrx::find($parameters);
        $nombres = $this->sacaNombres($guia->getorigenId(), $transferencia, $guia->getdestinoId(), $guia->getdriverId(), $guia->getrouteId(), $guia->getvehicleId());

        $this->session->set('vinode', 'Itinerantes');
        $this->session->remove('pendiente');
        $this->view->guia = $guia;
        $this->view->contribuyente = $contribuyente;
        $this->view->cliente = $cliente;
        $this->view->nombres = $nombres;
        $this->view->productos = $productos;
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
                "controller" => "guiacab",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $guiacab,
            'limit' => 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    public function newAction() {
        $ruc = $this->session->get('contribuyente');
        $this->view->form = new GuiaNewForm;
        $this->view->ruc = $ruc;
    }

    public function editAction($refNumber) {
        if (!$this->request->isPost()) {

            $guiacab = Guiacab::findFirstByrefNumber($refNumber);
            if (!$guiacab) {
                $this->flash->error("Esta guia no existe");
                return $this->dispatcher->forward([
                            'action' => 'index'
                ]);
            }
            if ($guiacab->CustomField15 <> 'GRABADO' && $guiacab->CustomField15 <> 'SIN FIRMAR') {
                $this->flash->error("Esta guia no puede ser modificada tiene estado de " . $guiacab->CustomField15);
                return $this->dispatcher->forward([
                            'action' => 'index'
                ]);
            }
            $ruc = $this->session->get('contribuyente');
            $this->view->form = new GuiaNewForm;
            $this->view->ruc = $ruc;
            $this->tag->setDefault("txnDate", $guiacab->txnDate);
            $this->tag->setDefault("refNumber", $guiacab->refNumber);
            $this->tag->setDefault("origenId", $guiacab->origenId);
            $this->tag->setDefault("destinoId", $guiacab->destinoId);
            $this->tag->setDefault("driverId", $guiacab->driverId);
            $this->tag->setDefault("routeId", $guiacab->routeId);
            $this->tag->setDefault("vehicleId", $guiacab->vehicleId);
            $this->tag->setDefault("dateBegin", $guiacab->dateBegin);
            $this->tag->setDefault("dateEnd", $guiacab->dateEnd);
            $this->tag->setDefault("motive", $guiacab->motive);
        }
    }

    public function createAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "guiacab",
                'action' => 'index'
            ]);

            return;
        }

        $form = new GuiaNewForm;
        $guiacab = new Guiacab();

        $data = $this->request->getPost();
        if (!$form->isValid($data)) {
            foreach ($form->getMessages() as $message) {
//                $this->flash->error($message);
            }

            return $this->dispatcher->forward(
                            [
                                "action" => "new",
                            ]
            );
        }
//        var_dump($this->request->getPost());
        $fecha = date('Y-m-d H:m:s');
        $transferencia = 'TRANSFERENCIA';
        $guiacab->settxnID($this->request->getPost("refNumber"));
        $guiacab->settimeCreated($fecha);
        $guiacab->settimeModified($fecha);
        $guiacab->seteditSequence(rand(2000, 200000));
        $guiacab->setrefNumber($this->request->getPost("refNumber"));
        $guiacab->settxnDate($this->request->getPost("txnDate"));
        $guiacab->setorigenId($this->request->getPost("origenId"));
        $guiacab->settipoDestino($transferencia);
        $guiacab->setdestinoId($this->request->getPost("destinoId"));
        $guiacab->setdriverId($this->request->getPost("driverId"));
        $guiacab->setrouteId($this->request->getPost("routeId"));
        $guiacab->setvehicleId($this->request->getPost("vehicleId"));
        $guiacab->setdateBegin($this->request->getPost("dateBegin"));
        $guiacab->setdateEnd($this->request->getPost("dateEnd"));
        $guiacab->setmotive($this->request->getPost("motive"));
        $guiacab->setstatus('GRABADO');
        $guiacab->setestado('ACTIVO');
        $guiacab->setCustomField15('GRABADO');

        $nombres = $this->sacaNombres($this->request->getPost("origenId"), $transferencia, $this->request->getPost("destinoId"), $this->request->getPost("driverId"), $this->request->getPost("routeId"), $this->request->getPost("vehicleId"));
        $guiacab->setorigenName($nombres['origen']);
        $guiacab->setdestinoName($nombres['destino']);
        $guiacab->setdriverName($nombres['chofer']);
        $guiacab->setrouteName($nombres['ruta']);
        $guiacab->setvehicleName($nombres['carro']);  // placa

        if (!$guiacab->save()) {
            foreach ($guiacab->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "guiacab",
                'action' => 'new'
            ]);

            return;
        }

//        $this->flash->success("Se ha generado la guia de remision nro " . $this->request->getPost('refNumber'));

        $this->dispatcher->forward([
            'controller' => "guiacab",
            'action' => 'productos',
            'params' => [$this->request->getPost('refNumber')]
        ]);
    }

    public function sacaNombres($origen, $tipo, $destino, $chofer, $ruta, $carro) {
        $nombres = array();
        $a_origen = Bodegas::findFirstByListID($origen);
        $nombres['origenId'] = $origen;
        $nombres['origen'] = $a_origen->Name;
        $nombres['origenaddress'] = $a_origen->BodegaAddress;
        $nombres['origentipoid'] = $a_origen->TipoID;
        $nombres['origennumeroid'] = $a_origen->NumeroID;
        $nombres['origenemail'] = $a_origen->Email;

        if ($tipo === 'CLIENTE') {
            $a_destino = Customer::findFirstByListID($destino);
            $nombres['destinoId'] = $destino;
            $nombres['destino'] = $a_destino->Name;
            $nombres['destinoaddress'] = $a_destino->BillAddress_Addr1;
            if ($a_destino->CustomerTypeRef_FullName === 'RUC') {
                $tipo_aux = '04';
            } elseif ($a_destino->CustomerTypeRef_FullName === 'CEDULA') {
                $tipo_aux = '05';
            } elseif ($a_destino->CustomerTypeRef_FullName === 'PASAPORTE') {
                $tipo_aux = '06';
            } elseif ($a_destino->CustomerTypeRef_FullName === 'EXTRANJERO') {
                $tipo_aux = '07';
            }
            $nombres['destinotipoid'] = $tipo_aux;
            $nombres['destinonumeroid'] = $a_destino->AccountNumber;
            $nombres['destinoemail'] = $a_destino->Email;
        } else {
            $a_destino = Bodegas::findFirstByListID($destino);
            $nombres['destinoId'] = $destino;
            $nombres['destino'] = $a_destino->Name;
            $nombres['destinoaddress'] = $a_destino->BodegaAddress;
            $nombres['destinotipoid'] = $a_destino->TipoID;
            $nombres['destinonumeroid'] = $a_destino->NumeroID;
            $nombres['destinoemail'] = $a_destino->Email;
        }

        $a_chofer = Driver::findFirstBylistID($chofer);
        $nombres['choferId'] = $chofer;
        $nombres['chofer'] = $a_chofer->name;
        $nombres['choferaddress'] = $a_chofer->address;
        $nombres['chofertipoId'] = $a_chofer->tipoId;
        $nombres['chofernumeroId'] = $a_chofer->numeroId;

        $a_ruta = Route::findFirstBylistID($ruta);
        $nombres['rutaId'] = $ruta;
        $nombres['ruta'] = $a_ruta->description;

        $a_carro = Vehicle::findFirstBylistID($carro);
        $nombres['carroId'] = $carro;
        $nombres['carro'] = $a_carro->description;
        $nombres['carroplaca'] = $a_carro->name;
        return $nombres;
    }

    public function productosAction($refNumber) {

        $ruc = $this->session->get('contribuyente');
        $guiacab = Guiacab::findFirstByrefNumber($refNumber);
        if (!$guiacab) {
            $this->flash->warning("no se ha encontrado la guia de remision " . $refNumber);

            $this->dispatcher->forward([
                'controller' => "guiacab",
                'action' => 'productos',
                'params' => [$refNumber]
            ]);
        }
        $TxnID = $guiacab->txnID;
        $form = new GuiaProductoForm;
        $parameters = array('conditions' => '[IDKEY] = :clave:', 'bind' => array('clave' => $TxnID));
        $guiatrx = Guiatrx::find($parameters);
        $this->view->guiacab = $guiacab;
        $this->view->form = $form;
        $this->view->ruc = $ruc;
        $this->view->guiatrx = $guiatrx;
    }

    public function masproductosAction($refNumber) {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward([
                        'controller' => "guiacab",
                        'action' => 'productos',
                        'params' => [$refNumber]
            ]);
        }

        $form = new GuiaProductoForm;
        $guiatrx = new Guiatrx();
        $guiacab = Guiacab::findFirstByrefNumber($refNumber);
        $parameters = array('conditions' => '[quickbooks_listid] = :codigoprod:', 'bind' => array('codigoprod' => $this->request->getPost('ItemRefListID')));
        $producto = Items::findFirst($parameters);
        if(!$producto){
            $this->flash->notice('Codigo de producto ' . $this->request->getPost('ItemRefListID'));
        } else {
            $this->flash->notice('Codigo de producto ' . $this->request->getPost('ItemRefListID') . ' con ' . $producto->getsales_desc());
        }
        $data = $this->request->getPost();
        if (!$form->isValid($data)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                        "action" => "productos",
                        "params" => [$refNumber]
            ]);
        }

//        var_dump($this->request->getPost());
        $clave = $guiacab->txnID . $this->request->getPost("ItemRefListID");
        $fecha = date('Y-m-d H:m:s');
        $guiatrx->settxnID($clave);
        $guiatrx->settimeCreated($fecha);
        $guiatrx->settimeModified($fecha);
        $guiatrx->seteditSequence(rand(2000, 200000));
        $guiatrx->setNumeroLote($this->request->getPost("numeroLote"));
        $guiatrx->setItemRefListID($this->request->getPost("ItemRefListID"));
        $guiatrx->setItemRefFullName($producto->getsales_desc());
        $guiatrx->setOrigenTrx($guiacab->origenId);
        $guiatrx->setDestinoTrx($guiacab->destinoId);
        $guiatrx->setQty($this->request->getPost("qty"));
        $guiatrx->setIDKEY($guiacab->txnID);
        $guiatrx->setEstado('ACTIVO');


        if (!$guiatrx->save()) {
            foreach ($guiacab->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                        'action' => 'productos',
                        'params' => [$refNumber]
            ]);
        }

//        $this->flash->success("Se ha adicionado un nuevo producto" . $this->request->getPost('ItemRefListID'));

        return $this->dispatcher->forward([
                    'controller' => "guiacab",
                    'action' => 'productos',
                    'params' => [$refNumber]
        ]);
    }

    public function saveAction() {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'action' => 'index'
            ]);

            return;
        }

        $refNumber = $this->request->getPost("refNumber");
        $guiacab = Guiacab::findFirstByrefNumber($refNumber);

        if (!$guiacab) {
            $this->flash->error("No se puede actualizar esta guia " . $refNumber);

            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }

        $fecha = date('Y-m-d H:m:s');
        $transferencia = 'TRANSFERENCIA';
        $guiacab->settimeModified($fecha);
        $guiacab->setrefNumber($this->request->getPost("refNumber"));
        $guiacab->settxnDate($this->request->getPost("txnDate"));
        $guiacab->setorigenId($this->request->getPost("origenId"));
        $guiacab->settipoDestino($transferencia);
        $guiacab->setdestinoId($this->request->getPost("destinoId"));
        $guiacab->setdriverId($this->request->getPost("driverId"));
        $guiacab->setrouteId($this->request->getPost("routeId"));
        $guiacab->setvehicleId($this->request->getPost("vehicleId"));
        $guiacab->setdateBegin($this->request->getPost("dateBegin"));
        $guiacab->setdateEnd($this->request->getPost("dateEnd"));
        $guiacab->setmotive($this->request->getPost("motive"));
        $nombres = $this->sacaNombres($this->request->getPost("origenId"), $transferencia, $this->request->getPost("destinoId"), $this->request->getPost("driverId"), $this->request->getPost("routeId"), $this->request->getPost("vehicleId"));
        $guiacab->setorigenName($nombres['origen']);
        $guiacab->setdestinoName($nombres['destino']);
        $guiacab->setdriverName($nombres['chofer']);
        $guiacab->setrouteName($nombres['ruta']);
        $guiacab->setvehicleName($nombres['carro']);  // placa

        if (!$guiacab->save()) {

            foreach ($guiacab->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                        'action' => 'edit',
                        'params' => [$guiacab->refNumber]
            ]);
        }

        $this->dispatcher->forward([
            'controller' => "guiacab",
            'action' => 'productos',
            'params' => [$guiacab->refNumber]
        ]);
    }

    public function deleteAction($refNumber) {
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

        $clave = $guiacab->txnID;
        $params = array('conditions' => '[IDKEY] = :numero:', 'bind' => array('numero' => $clave));
        $guiatrx = Guiatrx::find($params);
        if (!$guiatrx->delete()) {
            foreach ($guiatrx->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }
        if (!$guiacab->delete()) {
            foreach ($guiacab->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }

        $this->flash->success("Guia de remision eliminada " . $refNumber);

        $this->dispatcher->forward([
            'action' => "search"
        ]);
    }

    public function delproductoAction($txnID, $refNumber) {
        $guiatrx = Guiatrx::findFirstBytxnID($txnID);
        if (!$guiatrx) {
            $this->flash->error("Producto no existe");

            return $this->dispatcher->forward([
                        'action' => 'index'
            ]);
        }

        if (!$guiatrx->delete()) {

            foreach ($guiatrx->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward([
                        'action' => 'productos',
                        'params' => [$refNumber]
            ]);
        }

        $this->dispatcher->forward([
            'action' => "productos",
            'params' => [$refNumber]
        ]);
    }

}
