<?php

class Vendorcredit extends \Phalcon\Mvc\Model {

    protected $TxnID;
    protected $TimeCreated;
    protected $TimeModified;
    protected $EditSequence;
    protected $TxnNumber;
    protected $VendorRef_ListID;
    protected $VendorRef_FullName;
    protected $APAccountRef_ListID;
    protected $APAccountRef_FullName;
    protected $TxnDate;
    protected $CreditAmount;
    protected $CurrencyRef_ListID;
    protected $CurrencyRef_FullName;
    protected $ExchangeRate;
    protected $CreditAmountInHomeCurrency;
    protected $RefNumber;
    protected $Memo;
    protected $OpenAmount;
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
        $this->VendorRef_ListID = ' ';
        $this->VendorRef_FullName = ' ';
        $this->APAccountRef_ListID = ' ';
        $this->APAccountRef_FullName = ' ';
        $this->TxnDate = $fecha;
        $this->CreditAmount = 0;
        $this->CurrencyRef_ListID = ' ';
        $this->CurrencyRef_FullName = ' ';
        $this->ExchangeRate = 0;
        $this->CreditAmountInHomeCurrency = 0;
        $this->RefNumber = ' ';
        $this->Memo = ' ';
        $this->OpenAmount = 'n/a';
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

    function getAPAccountRefListID() {
        return $this->APAccountRef_ListID;
    }

    function getAPAccountRefFullName() {
        return $this->APAccountRef_FullName;
    }

    function getTxnDate() {
        $val = date('F j, Y', strtotime($this->TxnDate));
        return $val;
//        return $this->TxnDate;
    }

    function getCreditAmount() {
        return $this->CreditAmount;
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

    function getCreditAmountInHomeCurrency() {
        return $this->CreditAmountInHomeCurrency;
    }

    function getRefNumber() {
        return $this->RefNumber;
    }

    function getMemo() {
        return $this->Memo;
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

    function setAPAccountRefListID($val) {
        $this->APAccountRef_ListID = $val;
    }

    function setAPAccountRefFullName($val) {
        $this->APAccountRef_FullName = $val;
    }

    function setTxnDate($val) {
        $this->TxnDate = $val;
    }

    function setCreditAmount($val) {
        $this->CreditAmount = $val;
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

    function setCreditAmountInHomeCurrency($val) {
        $this->CreditAmountInHomeCurrency = $val;
    }

    function setRefNumber($val) {
        $this->RefNumber = $val;
    }

    function setMemo($val) {
        $this->Memo = $val;
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

    function setCustomField4($val) {
        $this->CustomField4 = $val;
    }

    function setCustomField5($val) {
        $this->CustomField5 = $val;
    }

    function setCustomField6($val) {
        $this->CustomField6 = $val;
    }

    function setCustomField7($val) {
        $this->CustomField7 = $val;
    }

    function setCustomField8($val) {
        $this->CustomField8 = $val;
    }

    function setCustomField9($val) {
        $this->CustomField9 = $val;
    }

    function setCustomField10($val) {
        $this->CustomField10 = $val;
    }

    function setCustomField11($val) {
        $this->CustomField11 = $val;
    }

    function setCustomField12($val) {
        $this->CustomField12 = $val;
    }

    function setCustomField13($val) {
        $this->CustomField13 = $val;
    }

    function setCustomField14($val) {
        $this->CustomField14 = $val;
    }

    function setCustomField15($val) {
        $this->CustomField15 = $val;
    }

    function setStatus($val) {
        $this->Status = $val;
    }

    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->setSchema("coopdb");
        $this->setSource("vendorcredit");
        $this->hasMany('TxnID', 'Txnitemlinedetail', 'IDKEY');
        $this->belongsTo('VendorRef_ListID', 'Vendor', 'ListID');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'vendorcredit';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Vendorcredit[]|Vendorcredit|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Vendorcredit|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
