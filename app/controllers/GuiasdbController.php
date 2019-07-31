<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class GuiasdbController extends ControllerBase {

    protected $ambiente;
    protected $txt_ambiente;
    protected $firmado;
    protected $nombres;

    public function initialize() {
        $this->tag->setTitle('Guias');
        parent::initialize();
    }

    public function indexAction() {
        $this->session->conditions = null;
        $form = new GuiaInvoiceForm;

        $nada = 'n/a';
        $this->tag->setDefault("CustomField7", $nada);
        $nada = '0';
        $this->tag->setDefault("CustomField8", $nada);

        $this->view->form = $form;
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

        $invoice = Invoice::find($parameters);
        if (count($invoice) == 0) {
            $this->flash->notice("No se encontraron facturas que cumplan con los parametros de busqueda");

            $this->dispatcher->forward([
                "controller" => "guiasdb",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $invoice,
            'limit' => 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    public function cabeceraAction($TxnID) {
        $ruc = $this->session->get('contribuyente');

        $form = new GuiaNuevaForm;

        $invoice = Invoice::findFirstByTxnID($TxnID);

        if (!$this->request->isPost()) {

            if ($invoice) {
                $doc = $this->claves->generaDoc($invoice->getCustomField8());
                $refNumber = $doc['estab'] . '-' . $doc['punto'] . '-' . $doc['documento'];
                $this->tag->setDefault("refNumber", $refNumber);
                $this->tag->setDefault("destinoId", $invoice->getCustomerRefFullName());
            }
        }

        if ($this->request->isPost()) {
            if ($form->isValid($this->request->getPost()) != false) {
                $guia = new Guiacab();
                $origen = $this->request->getPost('origenId');
                $destino = $invoice->getCustomerRefListID();
                $chofer = $this->request->getPost('driverId');
                $ruta = $this->request->getPost('routeId');
                $carro = $this->request->getPost('vehicleId');
                $this->nombres = $this->sacaNombres($origen, $destino, $chofer, $ruta, $carro);
                $fecha = date('Y-m-d');
                $doc = $this->claves->generaDoc($this->request->getPost('refNumber'));
                $refNumber = $doc['estab'] . '-' . $doc['punto'] . '-' . $doc['documento'];
                $guia->settxnID($refNumber);
                $guia->setrefNumber($refNumber);
                $guia->settimeCreated(date('Y-m-d H:m:s', strtotime($fecha)));
                $guia->settimeModified(date('Y-m-d H:m:s', strtotime($fecha)));
                $guia->seteditSequence(rand(10000, 1000000));
                $guia->settxnDate(date('Y-m-d H:m:s', strtotime($this->request->getPost('txnDate'))));
                $guia->setdateBegin(date('Y-m-d H:m:s', strtotime($this->request->getPost('dateBegin'))));
                $guia->setdateEnd(date('Y-m-d H:m:s', strtotime($this->request->getPost('dateEnd'))));
                $guia->setCustomField15('SIN FIRMAR');
                $guia->setdestinoId($invoice->getCustomerRefListID());
                $guia->setorigenId($this->request->getPost('origenId'));
                $guia->setorigenName($this->nombres['origen']);
                $guia->setdestinoName($invoice->getCustomerRefFullName());
                $guia->setdriverId($this->request->getPost('driverId'));
                $guia->setdriverName($this->nombres['chofer']);
                $guia->setrouteId($this->request->getPost('routeId'));
                $guia->setrouteName($this->nombres['ruta']);
                $guia->setvehicleId($this->request->getPost('vehicleId'));
                $guia->setvehicleName($this->nombres['carro']);
                $guia->setmotive($this->request->getPost('motive'));
                $guia->setstatus('GRABADO');
                $guia->settipoDestino('CLIENTE');
                if ($guia->save()) {
                    $this->productos($invoice, $refNumber);
                    return $this->dispatcher->forward([
                                'action' => 'facturar',
                                'params' => [$refNumber]
                    ]);
                } else {
                    $messages = $guia->getMessages();
                    foreach ($messages as $message) {
                        $this->flash->error((string) $message);
                    }
                }
            }
        }
        $this->view->form = $form;
        $this->view->ruc = $ruc;
    }

    public function productos($invoice, $refNumber) {

        $i = 0;
        foreach ($invoice->invoicelinedetail as $producto) {
            $guiatrx = new Guiatrx();
            $i++;
            $fecha = date('Y-m-d H:m:s');
            $guiatrx->settxnID($refNumber . $i);
            $guiatrx->settimeCreated($fecha);
            $guiatrx->settimeModified($fecha);
            $guiatrx->seteditSequence(rand(2000, 200000));
            $guiatrx->setNumeroLote($producto->LotNumber);
            $guiatrx->setItemRefListID($producto->ItemRef_ListID);
            $guiatrx->setItemRefFullName($producto->ItemRef_FullName);
            $guiatrx->setOrigenTrx($this->nombres['origenId']);
            $guiatrx->setDestinoTrx($this->nombres['destinoId']);
            $guiatrx->setQty($producto->Quantity);
            $guiatrx->setIDKEY($refNumber);
            $guiatrx->setEstado('ACTIVO');


            if (!$guiatrx->save()) {
                foreach ($guiatrx->getMessages() as $message) {
                    $this->flash->error($message);
                }

                return $this->dispatcher->forward([
                            'action' => 'index'
                ]);
            }
        }
    }

    public function sacaNombres($origen, $destino, $chofer, $ruta, $carro) {

        $this->nombres = array('origen' => 'origen', 'destino' => 'destino', 'chofer' => 'chofer', 'ruta' => 'ruta');

        $a_origen = Bodegas::findFirstByListID($origen);
        $this->nombres['origenId'] = $origen;
        $this->nombres['origen'] = $a_origen->Name;
        $this->nombres['origenaddress'] = $a_origen->BodegaAddress;
        $this->nombres['origentipoid'] = $a_origen->TipoID;
        $this->nombres['origennumeroid'] = $a_origen->NumeroID;
        $this->nombres['origenemail'] = $a_origen->Email;

        $a_destino = Customer::findFirstByListID($destino);
        $this->nombres['destinoId'] = $destino;
        $this->nombres['destino'] = $a_destino->Name;
        $this->nombres['destinoaddress'] = $a_destino->BillAddress_Addr1;
        if ($a_destino->CustomerTypeRef_FullName === 'RUC') {
            $tipo_aux = '04';
        } elseif ($a_destino->CustomerTypeRef_FullName === 'CEDULA') {
            $tipo_aux = '05';
        } elseif ($a_destino->CustomerTypeRef_FullName === 'PASAPORTE') {
            $tipo_aux = '06';
        } elseif ($a_destino->CustomerTypeRef_FullName === 'EXTRANJERO') {
            $tipo_aux = '07';
        }
        $this->nombres['destinotipoid'] = $tipo_aux;
        $this->nombres['destinonumeroid'] = $a_destino->AccountNumber;
        $this->nombres['destinoemail'] = $a_destino->Email;

        $a_chofer = Driver::findFirstBylistID($chofer);
        $this->nombres['chofer'] = $a_chofer->name;
        $this->nombres['choferId'] = $chofer;
        $this->nombres['choferaddress'] = $a_chofer->address;
        $this->nombres['chofertipoId'] = $a_chofer->tipoId;
        $this->nombres['chofernumeroId'] = $a_chofer->numeroId;

        $a_ruta = Route::findFirstBylistID($ruta);
        $this->nombres['rutaId'] = $ruta;
        $this->nombres['ruta'] = $a_ruta->description;

        $a_carro = Vehicle::findFirstBylistID($carro);
        $this->nombres['carroId'] = $carro;
        $this->nombres['carro'] = $a_carro->description;
        $this->nombres['carroplaca'] = $a_carro->name;
        return $this->nombres;
    }

    public function facturarAction($RefNumber) {

        $contribuyente = $this->session->get('contribuyente');
        $guia = new Guiacab();
        $guia = Guiacab::findFirstBytxnID($RefNumber);
        $parameters = array('conditions' => 'IDKEY = :clave:', 'bind' => array('clave' => $guia->gettxnID()));
        $productos = Guiatrx::find($parameters);
        $cliente = Customer::findFirstByListID($guia->getdestinoId());
        $this->session->set('vinode', 'Proceso Ventas');
        $this->session->remove('pendiente');
        $this->view->guia = $guia;
        $this->view->contribuyente = $contribuyente;
        $this->view->cliente = $cliente;
        $this->view->nombres = $this->nombres;
        $this->view->productos = $productos;
    }

}
