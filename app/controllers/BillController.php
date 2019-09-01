<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class BillController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for bill
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Bill', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "TxnID";

        $bill = Bill::find($parameters);
        if (count($bill) == 0) {
            $this->flash->notice("The search did not find any bill");

            $this->dispatcher->forward([
                "controller" => "bill",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $bill,
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
     * Edits a bill
     *
     * @param string $TxnID
     */
    public function editAction($TxnID)
    {
        if (!$this->request->isPost()) {

            $bill = Bill::findFirstByTxnID($TxnID);
            if (!$bill) {
                $this->flash->error("bill was not found");

                $this->dispatcher->forward([
                    'controller' => "bill",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->TxnID = $bill->getTxnid();

            $this->tag->setDefault("TxnID", $bill->getTxnid());
            $this->tag->setDefault("TimeCreated", $bill->getTimecreated());
            $this->tag->setDefault("TimeModified", $bill->getTimemodified());
            $this->tag->setDefault("EditSequence", $bill->getEditsequence());
            $this->tag->setDefault("TxnNumber", $bill->getTxnnumber());
            $this->tag->setDefault("VendorRef_ListID", $bill->getVendorrefListid());
            $this->tag->setDefault("VendorRef_FullName", $bill->getVendorrefFullname());
            $this->tag->setDefault("VendorAddress_Addr1", $bill->getVendoraddressAddr1());
            $this->tag->setDefault("VendorAddress_Addr2", $bill->getVendoraddressAddr2());
            $this->tag->setDefault("VendorAddress_Addr3", $bill->getVendoraddressAddr3());
            $this->tag->setDefault("VendorAddress_Addr4", $bill->getVendoraddressAddr4());
            $this->tag->setDefault("VendorAddress_Addr5", $bill->getVendoraddressAddr5());
            $this->tag->setDefault("VendorAddress_City", $bill->getVendoraddressCity());
            $this->tag->setDefault("VendorAddress_State", $bill->getVendoraddressState());
            $this->tag->setDefault("VendorAddress_PostalCode", $bill->getVendoraddressPostalcode());
            $this->tag->setDefault("VendorAddress_Country", $bill->getVendoraddressCountry());
            $this->tag->setDefault("VendorAddress_Note", $bill->getVendoraddressNote());
            $this->tag->setDefault("APAccountRef_ListID", $bill->getApaccountrefListid());
            $this->tag->setDefault("APAccountRef_FullName", $bill->getApaccountrefFullname());
            $this->tag->setDefault("TxnDate", $bill->getTxndate());
            $this->tag->setDefault("DueDate", $bill->getDuedate());
            $this->tag->setDefault("AmountDue", $bill->getAmountdue());
            $this->tag->setDefault("CurrencyRef_ListID", $bill->getCurrencyrefListid());
            $this->tag->setDefault("CurrencyRef_FullName", $bill->getCurrencyrefFullname());
            $this->tag->setDefault("ExchangeRate", $bill->getExchangerate());
            $this->tag->setDefault("AmountDueInHomeCurrency", $bill->getAmountdueinhomecurrency());
            $this->tag->setDefault("RefNumber", $bill->getRefnumber());
            $this->tag->setDefault("TermsRef_ListID", $bill->getTermsrefListid());
            $this->tag->setDefault("TermsRef_FullName", $bill->getTermsrefFullname());
            $this->tag->setDefault("Memo", $bill->getMemo());
            $this->tag->setDefault("IsTaxIncluded", $bill->getIstaxincluded());
            $this->tag->setDefault("SalesTaxCodeRef_ListID", $bill->getSalestaxcoderefListid());
            $this->tag->setDefault("SalesTaxCodeRef_FullName", $bill->getSalestaxcoderefFullname());
            $this->tag->setDefault("IsPaID", $bill->getIspaid());
            $this->tag->setDefault("OpenAmount", $bill->getOpenamount());
            $this->tag->setDefault("CustomField1", $bill->getCustomfield1());
            $this->tag->setDefault("CustomField2", $bill->getCustomfield2());
            $this->tag->setDefault("CustomField3", $bill->getCustomfield3());
            $this->tag->setDefault("Status", $bill->getStatus());
            
        }
    }

    /**
     * Creates a new bill
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "bill",
                'action' => 'index'
            ]);

            return;
        }

        $bill = new Bill();
        $bill->settxnID($this->request->getPost("TxnID"));
        $bill->settimeCreated($this->request->getPost("TimeCreated"));
        $bill->settimeModified($this->request->getPost("TimeModified"));
        $bill->seteditSequence($this->request->getPost("EditSequence"));
        $bill->settxnNumber($this->request->getPost("TxnNumber"));
        $bill->setvendorRefListID($this->request->getPost("VendorRef_ListID"));
        $bill->setvendorRefFullName($this->request->getPost("VendorRef_FullName"));
        $bill->setvendorAddressAddr1($this->request->getPost("VendorAddress_Addr1"));
        $bill->setvendorAddressAddr2($this->request->getPost("VendorAddress_Addr2"));
        $bill->setvendorAddressAddr3($this->request->getPost("VendorAddress_Addr3"));
        $bill->setvendorAddressAddr4($this->request->getPost("VendorAddress_Addr4"));
        $bill->setvendorAddressAddr5($this->request->getPost("VendorAddress_Addr5"));
        $bill->setvendorAddressCity($this->request->getPost("VendorAddress_City"));
        $bill->setvendorAddressState($this->request->getPost("VendorAddress_State"));
        $bill->setvendorAddressPostalCode($this->request->getPost("VendorAddress_PostalCode"));
        $bill->setvendorAddressCountry($this->request->getPost("VendorAddress_Country"));
        $bill->setvendorAddressNote($this->request->getPost("VendorAddress_Note"));
        $bill->setaPAccountRefListID($this->request->getPost("APAccountRef_ListID"));
        $bill->setaPAccountRefFullName($this->request->getPost("APAccountRef_FullName"));
        $bill->settxnDate($this->request->getPost("TxnDate"));
        $bill->setdueDate($this->request->getPost("DueDate"));
        $bill->setamountDue($this->request->getPost("AmountDue"));
        $bill->setcurrencyRefListID($this->request->getPost("CurrencyRef_ListID"));
        $bill->setcurrencyRefFullName($this->request->getPost("CurrencyRef_FullName"));
        $bill->setexchangeRate($this->request->getPost("ExchangeRate"));
        $bill->setamountDueInHomeCurrency($this->request->getPost("AmountDueInHomeCurrency"));
        $bill->setrefNumber($this->request->getPost("RefNumber"));
        $bill->settermsRefListID($this->request->getPost("TermsRef_ListID"));
        $bill->settermsRefFullName($this->request->getPost("TermsRef_FullName"));
        $bill->setmemo($this->request->getPost("Memo"));
        $bill->setisTaxIncluded($this->request->getPost("IsTaxIncluded"));
        $bill->setsalesTaxCodeRefListID($this->request->getPost("SalesTaxCodeRef_ListID"));
        $bill->setsalesTaxCodeRefFullName($this->request->getPost("SalesTaxCodeRef_FullName"));
        $bill->setisPaID($this->request->getPost("IsPaID"));
        $bill->setopenAmount($this->request->getPost("OpenAmount"));
        $bill->setcustomField1($this->request->getPost("CustomField1"));
        $bill->setcustomField2($this->request->getPost("CustomField2"));
        $bill->setcustomField3($this->request->getPost("CustomField3"));
        $bill->setstatus($this->request->getPost("Status"));
        

        if (!$bill->save()) {
            foreach ($bill->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "bill",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("bill was created successfully");

        $this->dispatcher->forward([
            'controller' => "bill",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a bill edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "bill",
                'action' => 'index'
            ]);

            return;
        }

        $TxnID = $this->request->getPost("TxnID");
        $bill = Bill::findFirstByTxnID($TxnID);

        if (!$bill) {
            $this->flash->error("bill does not exist " . $TxnID);

            $this->dispatcher->forward([
                'controller' => "bill",
                'action' => 'index'
            ]);

            return;
        }

        $bill->settxnID($this->request->getPost("TxnID"));
        $bill->settimeCreated($this->request->getPost("TimeCreated"));
        $bill->settimeModified($this->request->getPost("TimeModified"));
        $bill->seteditSequence($this->request->getPost("EditSequence"));
        $bill->settxnNumber($this->request->getPost("TxnNumber"));
        $bill->setvendorRefListID($this->request->getPost("VendorRef_ListID"));
        $bill->setvendorRefFullName($this->request->getPost("VendorRef_FullName"));
        $bill->setvendorAddressAddr1($this->request->getPost("VendorAddress_Addr1"));
        $bill->setvendorAddressAddr2($this->request->getPost("VendorAddress_Addr2"));
        $bill->setvendorAddressAddr3($this->request->getPost("VendorAddress_Addr3"));
        $bill->setvendorAddressAddr4($this->request->getPost("VendorAddress_Addr4"));
        $bill->setvendorAddressAddr5($this->request->getPost("VendorAddress_Addr5"));
        $bill->setvendorAddressCity($this->request->getPost("VendorAddress_City"));
        $bill->setvendorAddressState($this->request->getPost("VendorAddress_State"));
        $bill->setvendorAddressPostalCode($this->request->getPost("VendorAddress_PostalCode"));
        $bill->setvendorAddressCountry($this->request->getPost("VendorAddress_Country"));
        $bill->setvendorAddressNote($this->request->getPost("VendorAddress_Note"));
        $bill->setaPAccountRefListID($this->request->getPost("APAccountRef_ListID"));
        $bill->setaPAccountRefFullName($this->request->getPost("APAccountRef_FullName"));
        $bill->settxnDate($this->request->getPost("TxnDate"));
        $bill->setdueDate($this->request->getPost("DueDate"));
        $bill->setamountDue($this->request->getPost("AmountDue"));
        $bill->setcurrencyRefListID($this->request->getPost("CurrencyRef_ListID"));
        $bill->setcurrencyRefFullName($this->request->getPost("CurrencyRef_FullName"));
        $bill->setexchangeRate($this->request->getPost("ExchangeRate"));
        $bill->setamountDueInHomeCurrency($this->request->getPost("AmountDueInHomeCurrency"));
        $bill->setrefNumber($this->request->getPost("RefNumber"));
        $bill->settermsRefListID($this->request->getPost("TermsRef_ListID"));
        $bill->settermsRefFullName($this->request->getPost("TermsRef_FullName"));
        $bill->setmemo($this->request->getPost("Memo"));
        $bill->setisTaxIncluded($this->request->getPost("IsTaxIncluded"));
        $bill->setsalesTaxCodeRefListID($this->request->getPost("SalesTaxCodeRef_ListID"));
        $bill->setsalesTaxCodeRefFullName($this->request->getPost("SalesTaxCodeRef_FullName"));
        $bill->setisPaID($this->request->getPost("IsPaID"));
        $bill->setopenAmount($this->request->getPost("OpenAmount"));
        $bill->setcustomField1($this->request->getPost("CustomField1"));
        $bill->setcustomField2($this->request->getPost("CustomField2"));
        $bill->setcustomField3($this->request->getPost("CustomField3"));
        $bill->setstatus($this->request->getPost("Status"));
        

        if (!$bill->save()) {

            foreach ($bill->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "bill",
                'action' => 'edit',
                'params' => [$bill->getTxnid()]
            ]);

            return;
        }

        $this->flash->success("bill was updated successfully");

        $this->dispatcher->forward([
            'controller' => "bill",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a bill
     *
     * @param string $TxnID
     */
    public function deleteAction($TxnID)
    {
        $bill = Bill::findFirstByTxnID($TxnID);
        if (!$bill) {
            $this->flash->error("bill was not found");

            $this->dispatcher->forward([
                'controller' => "bill",
                'action' => 'index'
            ]);

            return;
        }

        if (!$bill->delete()) {

            foreach ($bill->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "bill",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("bill was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "bill",
            'action' => "index"
        ]);
    }

}
