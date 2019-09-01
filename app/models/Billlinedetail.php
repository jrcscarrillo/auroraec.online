<?php

class Billlinedetail extends \Phalcon\Mvc\Model {

// **********************
// ATTRIBUTE DECLARATION
// **********************

    protected $TxnLineID;
    protected $ItemRef_ListID;
    protected $ItemRef_FullName;
    protected $InventorySiteRef_ListID;
    protected $InventorySiteRef_FullName;
    protected $InventorySiteLocationRef_ListID;
    protected $InventorySiteLocationRef_FullName;
    protected $SerialNumber;
    protected $LotNumber;
    protected $Description;
    protected $Quantity;
    protected $UnitOfMeasure;
    protected $OverrideUOMSetRef_ListID;
    protected $OverrideUOMSetRef_FullName;
    protected $Cost;
    protected $Amount;
    protected $CustomerRef_ListID;
    protected $CustomerRef_FullName;
    protected $ClassRef_ListID;
    protected $ClassRef_FullName;
    protected $SalesTaxCodeRef_ListID;
    protected $SalesTaxCodeRef_FullName;
    protected $BillableStatus;
    protected $LinkedTxnID;
    protected $LinkedTxnLineID;
    protected $CustomField1;
    protected $CustomField2;
    protected $CustomField3;
    protected $CustomField4;
    protected $CustomField5;
    protected $IDKEY;

    function onConstruct() {
        $this->TxnLineID = ' ';
        $this->ItemRef_ListID = ' ';
        $this->ItemRef_FullName = ' ';
        $this->InventorySiteRef_ListID = ' ';
        $this->InventorySiteRef_FullName = ' ';
        $this->InventorySiteLocationRef_ListID = ' ';
        $this->InventorySiteLocationRef_FullName = ' ';
        $this->SerialNumber = ' ';
        $this->LotNumber = ' ';
        $this->Description = ' ';
        $this->Quantity = 0;
        $this->UnitOfMeasure = 'each';
        $this->OverrideUOMSetRef_ListID = ' ';
        $this->OverrideUOMSetRef_FullName = ' ';
        $this->Cost = 0;
        $this->Amount = 0;
        $this->CustomerRef_ListID = ' ';
        $this->CustomerRef_FullName = ' ';
        $this->ClassRef_ListID = ' ';
        $this->ClassRef_FullName = ' ';
        $this->SalesTaxCodeRef_ListID = ' ';
        $this->SalesTaxCodeRef_FullName = ' ';
        $this->BillableStatus = 'false';
        $this->LinkedTxnID = ' ';
        $this->LinkedTxnLineID = ' ';
        $this->CustomField1 = 'n/a';
        $this->CustomField2 = 'n/a';
        $this->CustomField3 = 'n/a';
        $this->CustomField4 = 'n/a';
        $this->CustomField5 = 'n/a';
        $this->IDKEY = ' ';
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

    function getInventorySiteRefListID() {
        return $this->InventorySiteRef_ListID;
    }

    function getInventorySiteRefFullName() {
        return $this->InventorySiteRef_FullName;
    }

    function getInventorySiteLocationRefListID() {
        return $this->InventorySiteLocationRef_ListID;
    }

    function getInventorySiteLocationRefFullName() {
        return $this->InventorySiteLocationRef_FullName;
    }

    function getSerialNumber() {
        return $this->SerialNumber;
    }

    function getLotNumber() {
        return $this->LotNumber;
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

    function getCost() {
        return $this->Cost;
    }

    function getAmount() {
        return $this->Amount;
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

    function getSalesTaxCodeRefListID() {
        return $this->SalesTaxCodeRef_ListID;
    }

    function getSalesTaxCodeRefFullName() {
        return $this->SalesTaxCodeRef_FullName;
    }

    function getBillableStatus() {
        return $this->BillableStatus;
    }

    function getLinkedTxnID() {
        return $this->LinkedTxnID;
    }

    function getLinkedTxnLineID() {
        return $this->LinkedTxnLineID;
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

    function getIDKEY() {
        return $this->IDKEY;
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

    function setInventorySiteRefListID($val) {
        $this->InventorySiteRef_ListID = $val;
    }

    function setInventorySiteRefFullName($val) {
        $this->InventorySiteRef_FullName = $val;
    }

    function setInventorySiteLocationRefListID($val) {
        $this->InventorySiteLocationRef_ListID = $val;
    }

    function setInventorySiteLocationRefFullName($val) {
        $this->InventorySiteLocationRef_FullName = $val;
    }

    function setSerialNumber($val) {
        $this->SerialNumber = $val;
    }

    function setLotNumber($val) {
        $this->LotNumber = $val;
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

    function setCost($val) {
        $this->Cost = $val;
    }

    function setAmount($val) {
        $this->Amount = $val;
    }

    function setCustomerRefListID($val) {
        $this->CustomerRef_ListID = $val;
    }

    function setCustomerRefFullName($val) {
        $this->CustomerRef_FullName = $val;
    }

    function setClassRefListID($val) {
        $this->ClassRef_ListID = $val;
    }

    function setClassRefFullName($val) {
        $this->ClassRef_FullName = $val;
    }

    function setSalesTaxCodeRefListID($val) {
        $this->SalesTaxCodeRef_ListID = $val;
    }

    function setSalesTaxCodeRefFullName($val) {
        $this->SalesTaxCodeRef_FullName = $val;
    }

    function setBillableStatus($val) {
        $this->BillableStatus = $val;
    }

    function setLinkedTxnID($val) {
        $this->LinkedTxnID = $val;
    }

    function setLinkedTxnLineID($val) {
        $this->LinkedTxnLineID = $val;
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

    function setIDKEY($val) {
        $this->IDKEY = $val;
    }

    public function initialize() {
        $this->setSchema("coopdb");
        $this->setSource("billlinedetail");
        $this->belongsTo('IDKEY', 'Bill', 'TxnID');
        $this->belongsTo('itemRef_ListID', 'Items', 'ListID');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'billlinedetail';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Billlinedetail[]|Billlinedetail|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Billlinedetail|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
