<?php

class Bill extends \Phalcon\Mvc\Model {

// **********************
// ATTRIBUTE DECLARATION
// **********************

    protected $TxnID;
    protected $TimeCreated;
    protected $TimeModified;
    protected $EditSequence;
    protected $TxnNumber;
    protected $VendorRef_ListID;
    protected $VendorRef_FullName;
    protected $VendorAddress_Addr1;
    protected $VendorAddress_Addr2;
    protected $VendorAddress_Addr3;
    protected $VendorAddress_Addr4;
    protected $VendorAddress_Addr5;
    protected $VendorAddress_City;
    protected $VendorAddress_State;
    protected $VendorAddress_PostalCode;
    protected $VendorAddress_Country;
    protected $VendorAddress_Note;
    protected $APAccountRef_ListID;
    protected $APAccountRef_FullName;
    protected $TxnDate;
    protected $DueDate;
    protected $AmountDue;
    protected $CurrencyRef_ListID;
    protected $CurrencyRef_FullName;
    protected $ExchangeRate;
    protected $AmountDueInHomeCurrency;
    protected $RefNumber;
    protected $TermsRef_ListID;
    protected $TermsRef_FullName;
    protected $Memo;
    protected $IsTaxIncluded;
    protected $SalesTaxCodeRef_ListID;
    protected $SalesTaxCodeRef_FullName;
    protected $IsPaID;
    protected $OpenAmount;
    protected $CustomField1;
    protected $CustomField2;
    protected $CustomField3;
    protected $Status;

    function onConstruct() {
        $fecha = date('Y-m-d H:m:s');
        $this->TxnID = ' ';
        $this->TimeCreated = $fecha;
        $this->TimeModified = $fecha;
        $this->EditSequence = rand(10000, 10000000);
        $this->TxnNumber = 0;
        $this->VendorRef_ListID = ' ';
        $this->VendorRef_FullName = ' ';
        $this->VendorAddress_Addr1 = ' ';
        $this->VendorAddress_Addr2 = ' ';
        $this->VendorAddress_Addr3 = ' ';
        $this->VendorAddress_Addr4 = ' ';
        $this->VendorAddress_Addr5 = ' ';
        $this->VendorAddress_City = ' ';
        $this->VendorAddress_State = ' ';
        $this->VendorAddress_PostalCode = ' ';
        $this->VendorAddress_Country = ' ';
        $this->VendorAddress_Note = ' ';
        $this->APAccountRef_ListID = ' ';
        $this->APAccountRef_FullName = ' ';
        $this->TxnDate = $fecha;
        $this->DueDate = $fecha;
        $this->AmountDue = 0;
        $this->CurrencyRef_ListID = ' ';
        $this->CurrencyRef_FullName = ' ';
        $this->ExchangeRate = 0;
        $this->AmountDueInHomeCurrency = 0;
        $this->RefNumber = ' ';
        $this->TermsRef_ListID = ' ';
        $this->TermsRef_FullName = ' ';
        $this->Memo = ' ';
        $this->IsTaxIncluded = 'false';
        $this->SalesTaxCodeRef_ListID = ' ';
        $this->SalesTaxCodeRef_FullName = ' ';
        $this->IsPaID = 'false';
        $this->OpenAmount = 'n/a';
        $this->CustomField1 = 'n/a';
        $this->CustomField2 = 'n/a';
        $this->CustomField3 = 'n/a';
        $this->Status = 'ACTIVO';
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

    function getVendorRefListID() {
        return $this->VendorRef_ListID;
    }

    function getVendorRefFullName() {
        return $this->VendorRef_FullName;
    }

    function getVendorAddressAddr1() {
        return $this->VendorAddress_Addr1;
    }

    function getVendorAddressAddr2() {
        return $this->VendorAddress_Addr2;
    }

    function getVendorAddressAddr3() {
        return $this->VendorAddress_Addr3;
    }

    function getVendorAddressAddr4() {
        return $this->VendorAddress_Addr4;
    }

    function getVendorAddressAddr5() {
        return $this->VendorAddress_Addr5;
    }

    function getVendorAddressCity() {
        return $this->VendorAddress_City;
    }

    function getVendorAddressState() {
        return $this->VendorAddress_State;
    }

    function getVendorAddressPostalCode() {
        return $this->VendorAddress_PostalCode;
    }

    function getVendorAddressCountry() {
        return $this->VendorAddress_Country;
    }

    function getVendorAddressNote() {
        return $this->VendorAddress_Note;
    }

    function getAPAccountRefListID() {
        return $this->APAccountRef_ListID;
    }

    function getAPAccountRefFullName() {
        return $this->APAccountRef_FullName;
    }

    function getTxnDate() {
        return $this->TxnDate;
    }

    function getDueDate() {
        return $this->DueDate;
    }

    function getAmountDue() {
        return $this->AmountDue;
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

    function getAmountDueInHomeCurrency() {
        return $this->AmountDueInHomeCurrency;
    }

    function getRefNumber() {
        return $this->RefNumber;
    }

    function getTermsRefListID() {
        return $this->TermsRef_ListID;
    }

    function getTermsRefFullName() {
        return $this->TermsRef_FullName;
    }

    function getMemo() {
        return $this->Memo;
    }

    function getIsTaxIncluded() {
        return $this->IsTaxIncluded;
    }

    function getSalesTaxCodeRefListID() {
        return $this->SalesTaxCodeRef_ListID;
    }

    function getSalesTaxCodeRefFullName() {
        return $this->SalesTaxCodeRef_FullName;
    }

    function getIsPaID() {
        return $this->IsPaID;
    }

    function getOpenAmount() {
        return $this->OpenAmount;
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

    function getStatus() {
        return $this->Status;
    }

// **********************
// SETTER METHODS
// **********************


    function setTxnID($val) {
        $this->TxnID = $val;
    }

    function setTimeCreated($val) {
        $this->TimeCreated = $val;
    }

    function setTimeModified($val) {
        $this->TimeModified = $val;
    }

    function setEditSequence($val) {
        $this->EditSequence = $val;
    }

    function setTxnNumber($val) {
        $this->TxnNumber = $val;
    }

    function setVendorRefListID($val) {
        $this->VendorRef_ListID = $val;
    }

    function setVendorRefFullName($val) {
        $this->VendorRef_FullName = $val;
    }

    function setVendorAddressAddr1($val) {
        $this->VendorAddress_Addr1 = $val;
    }

    function setVendorAddressAddr2($val) {
        $this->VendorAddress_Addr2 = $val;
    }

    function setVendorAddressAddr3($val) {
        $this->VendorAddress_Addr3 = $val;
    }

    function setVendorAddressAddr4($val) {
        $this->VendorAddress_Addr4 = $val;
    }

    function setVendorAddressAddr5($val) {
        $this->VendorAddress_Addr5 = $val;
    }

    function setVendorAddressCity($val) {
        $this->VendorAddress_City = $val;
    }

    function setVendorAddressState($val) {
        $this->VendorAddress_State = $val;
    }

    function setVendorAddressPostalCode($val) {
        $this->VendorAddress_PostalCode = $val;
    }

    function setVendorAddressCountry($val) {
        $this->VendorAddress_Country = $val;
    }

    function setVendorAddressNote($val) {
        $this->VendorAddress_Note = $val;
    }

    function setAPAccountRefListID($val) {
        $this->APAccountRef_ListID = $val;
    }

    function setAPAccountRefFullName($val) {
        $this->APAccountRef_FullName = $val;
    }

    function setTxnDate($val) {
        $this->TxnDate = $val;
    }

    function setDueDate($val) {
        $this->DueDate = $val;
    }

    function setAmountDue($val) {
        $this->AmountDue = $val;
    }

    function setCurrencyRefListID($val) {
        $this->CurrencyRef_ListID = $val;
    }

    function setCurrencyRefFullName($val) {
        $this->CurrencyRef_FullName = $val;
    }

    function setExchangeRate($val) {
        $this->ExchangeRate = $val;
    }

    function setAmountDueInHomeCurrency($val) {
        $this->AmountDueInHomeCurrency = $val;
    }

    function setRefNumber($val) {
        $this->RefNumber = $val;
    }

    function setTermsRefListID($val) {
        $this->TermsRef_ListID = $val;
    }

    function setTermsRefFullName($val) {
        $this->TermsRef_FullName = $val;
    }

    function setMemo($val) {
        $this->Memo = $val;
    }

    function setIsTaxIncluded($val) {
        $this->IsTaxIncluded = $val;
    }

    function setSalesTaxCodeRefListID($val) {
        $this->SalesTaxCodeRef_ListID = $val;
    }

    function setSalesTaxCodeRefFullName($val) {
        $this->SalesTaxCodeRef_FullName = $val;
    }

    function setIsPaID($val) {
        $this->IsPaID = $val;
    }

    function setOpenAmount($val) {
        $this->OpenAmount = $val;
    }

    function setCustomField1($val) {
        $this->CustomField1 = $val;
    }

    function setCustomField2($val) {
        $this->CustomField2 = $val;
    }

    function setCustomField3($val) {
        $this->CustomField3 = $val;
    }

    function setStatus($val) {
        $this->Status = $val;
    }

    public function initialize() {
        $this->setSchema("coopdb");
        $this->setSource("bill");
        $this->hasMany('TxnID', 'Billlinedetail', 'IDKEY');
        $this->belongsTo('VendorRef_ListID', 'Vendor', 'ListID');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'bill';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Bill[]|Bill|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Bill|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
