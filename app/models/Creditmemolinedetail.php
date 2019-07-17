<?php

class Creditmemolinedetail extends \Phalcon\Mvc\Model {

// **********************
// ATTRIBUTE DECLARATION
// **********************

    protected $TxnLineID;
    protected $ItemRef_ListID;
    protected $ItemRef_FullName;
    protected $Description;
    protected $Quantity;
    protected $UnitOfMeasure;
    protected $OverrideUOMSetRef_ListID;
    protected $OverrideUOMSetRef_FullName;
    protected $Rate;
    protected $RatePercent;
    protected $ClassRef_ListID;
    protected $ClassRef_FullName;
    protected $Amount;
    protected $InventorySiteRef_ListID;
    protected $InventorySiteRef_FullName;
    protected $SerialNumber;
    protected $LotNumber;
    protected $ServiceDate;
    protected $SalesTaxCodeRef_ListID;
    protected $SalesTaxCodeRef_FullName;
    protected $Other1;
    protected $Other2;
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
    protected $IDKEY;
    protected $GroupIDKEY;

    function onConstruct() {

// **********************
// ATTRIBUTE DECLARATION
// **********************
        $fecha = date('Y-m-d H:m:s');
        $this->TxnLineID = 'n/a';
        $this->ItemRef_ListID = 'n/a';
        $this->ItemRef_FullName = 'n/a';
        $this->Description = 'n/a';
        $this->Quantity = 0;
        $this->UnitOfMeasure = 'n/a';
        $this->OverrideUOMSetRef_ListID = 'n/a';
        $this->OverrideUOMSetRef_FullName = 'n/a';
        $this->Rate = 0;
        $this->RatePercent = 0;
        $this->ClassRef_ListID = 'n/a';
        $this->ClassRef_FullName = 'n/a';
        $this->Amount = 0;
        $this->InventorySiteRef_ListID = 'n/a';
        $this->InventorySiteRef_FullName = 'n/a';
        $this->SerialNumber = 'n/a';
        $this->LotNumber = 'n/a';
        $this->ServiceDate = $fecha;
        $this->SalesTaxCodeRef_ListID = 'n/a';
        $this->SalesTaxCodeRef_FullName = 'n/a';
        $this->Other1 = 'n/a';
        $this->Other2 = 'n/a';
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
        $this->IDKEY = 'n/a';
        $this->GroupIDKEY = 'n/a';
    }

// **********************
// GETTER METHODS
// **********************


    function getTxnLineID() {
        return $this->TxnLineID;
    }

    function getItemRefListID() {
        return $this->ItemRef_ListID;
    }

    function getItemRefFullName() {
        return $this->ItemRef_FullName;
    }

    function getDescription() {
        return $this->Description;
    }

    function getQuantity() {
        return $this->Quantity;
    }

    function getUnitOfMeasure() {
        return $this->UnitOfMeasure;
    }

    function getOverrideUOMSetRefListID() {
        return $this->OverrideUOMSetRef_ListID;
    }

    function getOverrideUOMSetRefFullName() {
        return $this->OverrideUOMSetRef_FullName;
    }

    function getRate() {
        return $this->Rate;
    }

    function getRatePercent() {
        return $this->RatePercent;
    }

    function getClassRefListID() {
        return $this->ClassRef_ListID;
    }

    function getClassRefFullName() {
        return $this->ClassRef_FullName;
    }

    function getAmount() {
        return $this->Amount;
    }

    function getInventorySiteRefListID() {
        return $this->InventorySiteRef_ListID;
    }

    function getInventorySiteRefFullName() {
        return $this->InventorySiteRef_FullName;
    }

    function getSerialNumber() {
        return $this->SerialNumber;
    }

    function getLotNumber() {
        return $this->LotNumber;
    }

    function getServiceDate() {
        return $this->ServiceDate;
    }

    function getSalesTaxCodeRefListID() {
        return $this->SalesTaxCodeRef_ListID;
    }

    function getSalesTaxCodeRefFullName() {
        return $this->SalesTaxCodeRef_FullName;
    }

    function getOther1() {
        return $this->Other1;
    }

    function getOther2() {
        return $this->Other2;
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

    function getIDKEY() {
        return $this->IDKEY;
    }

    function getGroupIDKEY() {
        return $this->GroupIDKEY;
    }

// **********************
// SETTER METHODS
// **********************


    function setTxnLineID($val) {
        $this->TxnLineID = $val;
    }

    function setItemRefListID($val) {
        $this->ItemRef_ListID = $val;
    }

    function setItemRefFullName($val) {
        $this->ItemRef_FullName = $val;
    }

    function setDescription($val) {
        $this->Description = $val;
    }

    function setQuantity($val) {
        $this->Quantity = $val;
    }

    function setUnitOfMeasure($val) {
        $this->UnitOfMeasure = $val;
    }

    function setOverrideUOMSetRefListID($val) {
        $this->OverrideUOMSetRef_ListID = $val;
    }

    function setOverrideUOMSetRefFullName($val) {
        $this->OverrideUOMSetRef_FullName = $val;
    }

    function setRate($val) {
        $this->Rate = $val;
    }

    function setRatePercent($val) {
        $this->RatePercent = $val;
    }

    function setClassRefListID($val) {
        $this->ClassRef_ListID = $val;
    }

    function setClassRefFullName($val) {
        $this->ClassRef_FullName = $val;
    }

    function setAmount($val) {
        $this->Amount = $val;
    }

    function setInventorySiteRefListID($val) {
        $this->InventorySiteRef_ListID = $val;
    }

    function setInventorySiteRefFullName($val) {
        $this->InventorySiteRef_FullName = $val;
    }

    function setSerialNumber($val) {
        $this->SerialNumber = $val;
    }

    function setLotNumber($val) {
        $this->LotNumber = $val;
    }

    function setServiceDate($val) {
        $this->ServiceDate = $val;
    }

    function setSalesTaxCodeRefListID($val) {
        $this->SalesTaxCodeRef_ListID = $val;
    }

    function setSalesTaxCodeRefFullName($val) {
        $this->SalesTaxCodeRef_FullName = $val;
    }

    function setOther1($val) {
        $this->Other1 = $val;
    }

    function setOther2($val) {
        $this->Other2 = $val;
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

    function setIDKEY($val) {
        $this->IDKEY = $val;
    }

    function setGroupIDKEY($val) {
        $this->GroupIDKEY = $val;
    }

    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->setSchema("coopdb");
        $this->setSource("creditmemolinedetail");
        $this->belongsTo('IDKEY', 'Creditmemo', 'TxnID');
        $this->belongsTo('itemRef_ListID', 'Items', 'quickbooks_listid');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'creditmemolinedetail';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Creditmemolinedetail[]|Creditmemolinedetail|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Creditmemolinedetail|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
