<?php

class Creditmemo extends \Phalcon\Mvc\Model {

// **********************
// ATTRIBUTE DECLARATION
// **********************


    protected $TxnID;
    protected $TimeCreated;
    protected $TimeModified;
    protected $EditSequence;
    protected $TxnNumber;
    protected $CustomerRef_ListID;
    protected $CustomerRef_FullName;
    protected $ClassRef_ListID;
    protected $ClassRef_FullName;
    protected $ARAccountRef_ListID;
    protected $ARAccountRef_FullName;
    protected $TemplateRef_ListID;
    protected $TemplateRef_FullName;
    protected $TxnDate;
    protected $RefNumber;
    protected $BillAddress_Addr1;
    protected $BillAddress_Addr2;
    protected $BillAddress_Addr3;
    protected $BillAddress_Addr4;
    protected $BillAddress_Addr5;
    protected $BillAddress_City;
    protected $BillAddress_State;
    protected $BillAddress_PostalCode;
    protected $BillAddress_Country;
    protected $BillAddress_Note;
    protected $ShipAddress_Addr1;
    protected $ShipAddress_Addr2;
    protected $ShipAddress_Addr3;
    protected $ShipAddress_Addr4;
    protected $ShipAddress_Addr5;
    protected $ShipAddress_City;
    protected $ShipAddress_State;
    protected $ShipAddress_PostalCode;
    protected $ShipAddress_Country;
    protected $ShipAddress_Note;
    protected $IsPending;
    protected $PONumber;
    protected $TermsRef_ListID;
    protected $TermsRef_FullName;
    protected $DueDate;
    protected $SalesRepRef_ListID;
    protected $SalesRepRef_FullName;
    protected $FOB;
    protected $ShipDate;
    protected $ShipMethodRef_ListID;
    protected $ShipMethodRef_FullName;
    protected $Subtotal;
    protected $ItemSalesTaxRef_ListID;
    protected $ItemSalesTaxRef_FullName;
    protected $SalesTaxPercentage;
    protected $SalesTaxTotal;
    protected $TotalAmount;
    protected $CreditRemaining;
    protected $CurrencyRef_ListID;
    protected $CurrencyRef_FullName;
    protected $ExchangeRate;
    protected $CreditRemainingInHomeCurrency;
    protected $Memo;
    protected $CustomerMsgRef_ListID;
    protected $CustomerMsgRef_FullName;
    protected $IsToBePrinted;
    protected $IsToBeEmailed;
    protected $IsTaxIncluded;
    protected $CustomerSalesTaxCodeRef_ListID;
    protected $CustomerSalesTaxCodeRef_FullName;
    protected $Other;
    protected $CustomField1;
    protected $CustomField2;
    protected $CustomField3;
    protected $CustomField4;
    protected $CustomField5;
    protected $CustomField6;
    protected $CustomField7;
    protected $CustomField8;
    protected $CustomField9;
    protected $CustomField10;
    protected $CustomField11;
    protected $CustomField12;
    protected $CustomField13;
    protected $CustomField14;
    protected $CustomField15;
    protected $Status;

    function onConstruct() {

        $fecha = date('Y-m-d H:m:s');
        $this->TxnID = ' ';
        $this->TimeCreated = $fecha;
        $this->TimeModified = $fecha;
        $this->EditSequence = rand(10000, 10000000);
        $this->TxnNumber = 0;
        $this->CustomerRef_ListID = ' ';
        $this->CustomerRef_FullName = ' ';
        $this->ClassRef_ListID = ' ';
        $this->ClassRef_FullName = ' ';
        $this->ARAccountRef_ListID = ' ';
        $this->ARAccountRef_FullName = ' ';
        $this->TemplateRef_ListID = ' ';
        $this->TemplateRef_FullName = ' ';
        $this->TxnDate = $fecha;
        $this->RefNumber = ' ';
        $this->BillAddress_Addr1 = ' ';
        $this->BillAddress_Addr2 = ' ';
        $this->BillAddress_Addr3 = ' ';
        $this->BillAddress_Addr4 = ' ';
        $this->BillAddress_Addr5 = ' ';
        $this->BillAddress_City = ' ';
        $this->BillAddress_State = ' ';
        $this->BillAddress_PostalCode = ' ';
        $this->BillAddress_Country = ' ';
        $this->BillAddress_Note = ' ';
        $this->ShipAddress_Addr1 = ' ';
        $this->ShipAddress_Addr2 = ' ';
        $this->ShipAddress_Addr3 = ' ';
        $this->ShipAddress_Addr4 = ' ';
        $this->ShipAddress_Addr5 = ' ';
        $this->ShipAddress_City = ' ';
        $this->ShipAddress_State = ' ';
        $this->ShipAddress_PostalCode = ' ';
        $this->ShipAddress_Country = ' ';
        $this->ShipAddress_Note = ' ';
        $this->IsPending = 'false';
        $this->PONumber = ' ';
        $this->TermsRef_ListID = ' ';
        $this->TermsRef_FullName = ' ';
        $this->DueDate = $fecha;
        $this->SalesRepRef_ListID = ' ';
        $this->SalesRepRef_FullName = ' ';
        $this->FOB = ' ';
        $this->ShipDate = $fecha;
        $this->ShipMethodRef_ListID = ' ';
        $this->ShipMethodRef_FullName = ' ';
        $this->Subtotal = 0;
        $this->ItemSalesTaxRef_ListID = ' ';
        $this->ItemSalesTaxRef_FullName = ' ';
        $this->SalesTaxPercentage = 0;
        $this->SalesTaxTotal = 0;
        $this->TotalAmount = 0;
        $this->CreditRemaining = 0;
        $this->CurrencyRef_ListID = ' ';
        $this->CurrencyRef_FullName = ' ';
        $this->ExchangeRate = 0;
        $this->CreditRemainingInHomeCurrency = 0;
        $this->Memo = ' ';
        $this->CustomerMsgRef_ListID = ' ';
        $this->CustomerMsgRef_FullName = ' ';
        $this->IsToBePrinted = 'false';
        $this->IsToBeEmailed = 'false';
        $this->IsTaxIncluded = 'false';
        $this->CustomerSalesTaxCodeRef_ListID = ' ';
        $this->CustomerSalesTaxCodeRef_FullName = ' ';
        $this->Other = ' ';
        $this->CustomField1 = 'n/a';
        $this->CustomField2 = 'n/a';
        $this->CustomField3 = 'n/a';
        $this->CustomField4 = 'n/a';
        $this->CustomField5 = 'n/a';
        $this->CustomField6 = 'n/a';
        $this->CustomField7 = 'n/a';
        $this->CustomField8 = 'n/a';
        $this->CustomField9 = 'n/a';
        $this->CustomField10 = 'n/a';
        $this->CustomField11 = 'n/a';
        $this->CustomField12 = 'n/a';
        $this->CustomField13 = 'n/a';
        $this->CustomField14 = 'n/a';
        $this->CustomField15 = 'n/a';
        $this->Status = 'PENDIENTE';
    }

// **********************
// GETTER METHODS
// **********************

    function getTxnID() {
        return $this->TxnID;
    }

    function getTimeCreated() {
        return $this->TimeCreated;
    }

    function getTimeModified() {
        return $this->TimeModified;
    }

    function getEditSequence() {
        return $this->EditSequence;
    }

    function getTxnNumber() {
        return $this->TxnNumber;
    }

    function getCustomerRefListID() {
        return $this->CustomerRef_ListID;
    }

    function getCustomerRefFullName() {
        return $this->CustomerRef_FullName;
    }

    function getClassRefListID() {
        return $this->ClassRef_ListID;
    }

    function getClassRefFullName() {
        return $this->ClassRef_FullName;
    }

    function getARAccountRefListID() {
        return $this->ARAccountRef_ListID;
    }

    function getARAccountRefFullName() {
        return $this->ARAccountRef_FullName;
    }

    function getTemplateRefListID() {
        return $this->TemplateRef_ListID;
    }

    function getTemplateRefFullName() {
        return $this->TemplateRef_FullName;
    }

    function getTxnDate() {
        $val = date('F j, Y', strtotime($this->TxnDate));
        return $val;
//        return $this->TxnDate;
    }

    function getRefNumber() {
        return $this->RefNumber;
    }

    function getBillAddressAddr1() {
        return $this->BillAddress_Addr1;
    }

    function getBillAddressAddr2() {
        return $this->BillAddress_Addr2;
    }

    function getBillAddressAddr3() {
        return $this->BillAddress_Addr3;
    }

    function getBillAddressAddr4() {
        return $this->BillAddress_Addr4;
    }

    function getBillAddressAddr5() {
        return $this->BillAddress_Addr5;
    }

    function getBillAddressCity() {
        return $this->BillAddress_City;
    }

    function getBillAddressState() {
        return $this->BillAddress_State;
    }

    function getBillAddressPostalCode() {
        return $this->BillAddress_PostalCode;
    }

    function getBillAddressCountry() {
        return $this->BillAddress_Country;
    }

    function getBillAddressNote() {
        return $this->BillAddress_Note;
    }

    function getShipAddressAddr1() {
        return $this->ShipAddress_Addr1;
    }

    function getShipAddressAddr2() {
        return $this->ShipAddress_Addr2;
    }

    function getShipAddressAddr3() {
        return $this->ShipAddress_Addr3;
    }

    function getShipAddressAddr4() {
        return $this->ShipAddress_Addr4;
    }

    function getShipAddressAddr5() {
        return $this->ShipAddress_Addr5;
    }

    function getShipAddressCity() {
        return $this->ShipAddress_City;
    }

    function getShipAddressState() {
        return $this->ShipAddress_State;
    }

    function getShipAddressPostalCode() {
        return $this->ShipAddress_PostalCode;
    }

    function getShipAddressCountry() {
        return $this->ShipAddress_Country;
    }

    function getShipAddressNote() {
        return $this->ShipAddress_Note;
    }

    function getIsPending() {
        return $this->IsPending;
    }

    function getPONumber() {
        return $this->PONumber;
    }

    function getTermsRefListID() {
        return $this->TermsRef_ListID;
    }

    function getTermsRefFullName() {
        return $this->TermsRef_FullName;
    }

    function getDueDate() {
        return $this->DueDate;
    }

    function getSalesRepRefListID() {
        return $this->SalesRepRef_ListID;
    }

    function getSalesRepRefFullName() {
        return $this->SalesRepRef_FullName;
    }

    function getFOB() {
        return $this->FOB;
    }

    function getShipDate() {
        return $this->ShipDate;
    }

    function getShipMethodRefListID() {
        return $this->ShipMethodRef_ListID;
    }

    function getShipMethodRefFullName() {
        return $this->ShipMethodRef_FullName;
    }

    function getSubtotal() {
        return $this->Subtotal;
    }

    function getItemSalesTaxRefListID() {
        return $this->ItemSalesTaxRef_ListID;
    }

    function getItemSalesTaxRefFullName() {
        return $this->ItemSalesTaxRef_FullName;
    }

    function getSalesTaxPercentage() {
        return $this->SalesTaxPercentage;
    }

    function getSalesTaxTotal() {
        return $this->SalesTaxTotal;
    }

    function getTotalAmount() {
        return $this->TotalAmount;
    }

    function getCreditRemaining() {
        return $this->CreditRemaining;
    }

    function getCurrencyRefListID() {
        return $this->CurrencyRef_ListID;
    }

    function getCurrencyRefFullName() {
        return $this->CurrencyRef_FullName;
    }

    function getExchangeRate() {
        return $this->ExchangeRate;
    }

    function getCreditRemainingInHomeCurrency() {
        return $this->CreditRemainingInHomeCurrency;
    }

    function getMemo() {
        return $this->Memo;
    }

    function getCustomerMsgRefListID() {
        return $this->CustomerMsgRef_ListID;
    }

    function getCustomerMsgRefFullName() {
        return $this->CustomerMsgRef_FullName;
    }

    function getIsToBePrinted() {
        return $this->IsToBePrinted;
    }

    function getIsToBeEmailed() {
        return $this->IsToBeEmailed;
    }

    function getIsTaxIncluded() {
        return $this->IsTaxIncluded;
    }

    function getCustomerSalesTaxCodeRefListID() {
        return $this->CustomerSalesTaxCodeRef_ListID;
    }

    function getCustomerSalesTaxCodeRefFullName() {
        return $this->CustomerSalesTaxCodeRef_FullName;
    }

    function getOther() {
        return $this->Other;
    }

    function getCustomField1() {
        return $this->CustomField1;
    }

    function getCustomField2() {
        return $this->CustomField2;
    }

    function getCustomField3() {
        return $this->CustomField3;
    }

    function getCustomField4() {
        return $this->CustomField4;
    }

    function getCustomField5() {
        return $this->CustomField5;
    }

    function getCustomField6() {
        return $this->CustomField6;
    }

    function getCustomField7() {
        return $this->CustomField7;
    }

    function getCustomField8() {
        return $this->CustomField8;
    }

    function getCustomField9() {
        return $this->CustomField9;
    }

    function getCustomField10() {
        return $this->CustomField10;
    }

    function getCustomField11() {
        return $this->CustomField11;
    }

    function getCustomField12() {
        return $this->CustomField12;
    }

    function getCustomField13() {
        return $this->CustomField13;
    }

    function getCustomField14() {
        return $this->CustomField14;
    }

    function getCustomField15() {
        return $this->CustomField15;
    }

    function getStatus() {
        return $this->Status;
    }

// **********************
// SETTER METHODS
// **********************


    function setTxnID($val) {
        $this->TxnID = $val;
        return $this;
    }

    function setTimeCreated($val) {
        $this->TimeCreated = $val;
        return $this;
    }

    function setTimeModified($val) {
        $this->TimeModified = $val;
        return $this;
    }

    function setEditSequence($val) {
        $this->EditSequence = $val;
        return $this;
    }

    function setTxnNumber($val) {
        $this->TxnNumber = $val;
        return $this;
    }

    function setCustomerRefListID($val) {
        $this->CustomerRef_ListID = $val;
        return $this;
    }

    function setCustomerRefFullName($val) {
        $this->CustomerRef_FullName = $val;
        return $this;
    }

    function setClassRefListID($val) {
        $this->ClassRef_ListID = $val;
        return $this;
    }

    function setClassRefFullName($val) {
        $this->ClassRef_FullName = $val;
        return $this;
    }

    function setARAccountRefListID($val) {
        $this->ARAccountRef_ListID = $val;
        return $this;
    }

    function setARAccountRefFullName($val) {
        $this->ARAccountRef_FullName = $val;
        return $this;
    }

    function setTemplateRefListID($val) {
        $this->TemplateRef_ListID = $val;
        return $this;
    }

    function setTemplateRefFullName($val) {
        $this->TemplateRef_FullName = $val;
        return $this;
    }

    function setTxnDate($val) {
        $this->TxnDate = $val;
        return $this;
    }

    function setRefNumber($val) {
        $this->RefNumber = $val;
        return $this;
    }

    function setBillAddressAddr1($val) {
        $this->BillAddress_Addr1 = $val;
        return $this;
    }

    function setBillAddressAddr2($val) {
        $this->BillAddress_Addr2 = $val;
        return $this;
    }

    function setBillAddressAddr3($val) {
        $this->BillAddress_Addr3 = $val;
        return $this;
    }

    function setBillAddressAddr4($val) {
        $this->BillAddress_Addr4 = $val;
        return $this;
    }

    function setBillAddressAddr5($val) {
        $this->BillAddress_Addr5 = $val;
        return $this;
    }

    function setBillAddressCity($val) {
        $this->BillAddress_City = $val;
        return $this;
    }

    function setBillAddressState($val) {
        $this->BillAddress_State = $val;
        return $this;
    }

    function setBillAddressPostalCode($val) {
        $this->BillAddress_PostalCode = $val;
        return $this;
    }

    function setBillAddressCountry($val) {
        $this->BillAddress_Country = $val;
        return $this;
    }

    function setBillAddressNote($val) {
        $this->BillAddress_Note = $val;
        return $this;
    }

    function setShipAddressAddr1($val) {
        $this->ShipAddress_Addr1 = $val;
        return $this;
    }

    function setShipAddressAddr2($val) {
        $this->ShipAddress_Addr2 = $val;
        return $this;
    }

    function setShipAddressAddr3($val) {
        $this->ShipAddress_Addr3 = $val;
        return $this;
    }

    function setShipAddressAddr4($val) {
        $this->ShipAddress_Addr4 = $val;
        return $this;
    }

    function setShipAddressAddr5($val) {
        $this->ShipAddress_Addr5 = $val;
        return $this;
    }

    function setShipAddressCity($val) {
        $this->ShipAddress_City = $val;
        return $this;
    }

    function setShipAddressState($val) {
        $this->ShipAddress_State = $val;
        return $this;
    }

    function setShipAddressPostalCode($val) {
        $this->ShipAddress_PostalCode = $val;
        return $this;
    }

    function setShipAddressCountry($val) {
        $this->ShipAddress_Country = $val;
        return $this;
    }

    function setShipAddressNote($val) {
        $this->ShipAddress_Note = $val;
        return $this;
    }

    function setIsPending($val) {
        $this->IsPending = $val;
        return $this;
    }

    function setPONumber($val) {
        $this->PONumber = $val;
        return $this;
    }

    function setTermsRefListID($val) {
        $this->TermsRef_ListID = $val;
        return $this;
    }

    function setTermsRefFullName($val) {
        $this->TermsRef_FullName = $val;
        return $this;
    }

    function setDueDate($val) {
        $this->DueDate = $val;
        return $this;
    }

    function setSalesRepRefListID($val) {
        $this->SalesRepRef_ListID = $val;
        return $this;
    }

    function setSalesRepRefFullName($val) {
        $this->SalesRepRef_FullName = $val;
        return $this;
    }

    function setFOB($val) {
        $this->FOB = $val;
        return $this;
    }

    function setShipDate($val) {
        $this->ShipDate = $val;
        return $this;
    }

    function setShipMethodRefListID($val) {
        $this->ShipMethodRef_ListID = $val;
        return $this;
    }

    function setShipMethodRefFullName($val) {
        $this->ShipMethodRef_FullName = $val;
        return $this;
    }

    function setSubtotal($val) {
        $this->Subtotal = $val;
        return $this;
    }

    function setItemSalesTaxRefListID($val) {
        $this->ItemSalesTaxRef_ListID = $val;
        return $this;
    }

    function setItemSalesTaxRefFullName($val) {
        $this->ItemSalesTaxRef_FullName = $val;
        return $this;
    }

    function setSalesTaxPercentage($val) {
        $this->SalesTaxPercentage = $val;
        return $this;
    }

    function setSalesTaxTotal($val) {
        $this->SalesTaxTotal = $val;
        return $this;
    }

    function setTotalAmount($val) {
        $this->TotalAmount = $val;
        return $this;
    }

    function setCreditRemaining($val) {
        $this->CreditRemaining = $val;
        return $this;
    }

    function setCurrencyRefListID($val) {
        $this->CurrencyRef_ListID = $val;
        return $this;
    }

    function setCurrencyRefFullName($val) {
        $this->CurrencyRef_FullName = $val;
        return $this;
    }

    function setExchangeRate($val) {
        $this->ExchangeRate = $val;
        return $this;
    }

    function setCreditRemainingInHomeCurrency($val) {
        $this->CreditRemainingInHomeCurrency = $val;
        return $this;
    }

    function setMemo($val) {
        $this->Memo = $val;
        return $this;
    }

    function setCustomerMsgRefListID($val) {
        $this->CustomerMsgRef_ListID = $val;
        return $this;
    }

    function setCustomerMsgRefFullName($val) {
        $this->CustomerMsgRef_FullName = $val;
        return $this;
    }

    function setIsToBePrinted($val) {
        $this->IsToBePrinted = $val;
        return $this;
    }

    function setIsToBeEmailed($val) {
        $this->IsToBeEmailed = $val;
        return $this;
    }

    function setIsTaxIncluded($val) {
        $this->IsTaxIncluded = $val;
        return $this;
    }

    function setCustomerSalesTaxCodeRefListID($val) {
        $this->CustomerSalesTaxCodeRef_ListID = $val;
        return $this;
    }

    function setCustomerSalesTaxCodeRefFullName($val) {
        $this->CustomerSalesTaxCodeRef_FullName = $val;
        return $this;
    }

    function setOther($val) {
        $this->Other = $val;
        return $this;
    }

    function setCustomField1($val) {
        $this->CustomField1 = $val;
        return $this;
    }

    function setCustomField2($val) {
        $this->CustomField2 = $val;
        return $this;
    }

    function setCustomField3($val) {
        $this->CustomField3 = $val;
        return $this;
    }

    function setCustomField4($val) {
        $this->CustomField4 = $val;
        return $this;
    }

    function setCustomField5($val) {
        $this->CustomField5 = $val;
        return $this;
    }

    function setCustomField6($val) {
        $this->CustomField6 = $val;
        return $this;
    }

    function setCustomField7($val) {
        $this->CustomField7 = $val;
        return $this;
    }

    function setCustomField8($val) {
        $this->CustomField8 = $val;
        return $this;
    }

    function setCustomField9($val) {
        $this->CustomField9 = $val;
        return $this;
    }

    function setCustomField10($val) {
        $this->CustomField10 = $val;
        return $this;
    }

    function setCustomField11($val) {
        $this->CustomField11 = $val;
        return $this;
    }

    function setCustomField12($val) {
        $this->CustomField12 = $val;
        return $this;
    }

    function setCustomField13($val) {
        $this->CustomField13 = $val;
        return $this;
    }

    function setCustomField14($val) {
        $this->CustomField14 = $val;
        return $this;
    }

    function setCustomField15($val) {
        $this->CustomField15 = $val;
        return $this;
    }

    function setStatus($val) {
        $this->Status = $val;
        return $this;
    }

    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->setSchema("coopdb");
        $this->setSource("creditmemo");
        $this->hasMany('TxnID', 'Creditmemolinedetail', 'IDKEY');
        $this->belongsTo('CustomerRef_ListID', 'Customer', 'ListID');
    }

    public function getSource() {
        return 'creditmemo';
    }

    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
