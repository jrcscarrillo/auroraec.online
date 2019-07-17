<?php

class Itemsalestax extends \Phalcon\Mvc\Model {

// **********************
// ATTRIBUTE DECLARATION
// **********************

    protected $ListID;
    protected $FullName;
    protected $IsActive;
    protected $ClassRefListID;
    protected $ClassRefFullName;
    protected $IsUsed;
    protected $ItemDesc;
    protected $TaxRate;
    protected $TaxVendorRefListID;
    protected $TaxVendorRefFullName;
    protected $SalesTaxRefListID;
    protected $SalesTaxRefFullName;
    protected $CustomField1;

// **********************
// GETTER METHODS
// **********************


    function getListID() {
        return $this->ListID;
    }

    function getFullName() {
        return $this->FullName;
    }

    function getIsActive() {
        return $this->IsActive;
    }

    function getClassRefListID() {
        return $this->ClassRefListID;
    }

    function getClassRefFullName() {
        return $this->ClassRefFullName;
    }

    function getIsUsed() {
        return $this->IsUsed;
    }

    function getItemDesc() {
        return $this->ItemDesc;
    }

    function getTaxRate() {
        return $this->TaxRate;
    }

    function getTaxVendorRefListID() {
        return $this->TaxVendorRefListID;
    }

    function getTaxVendorRefFullName() {
        return $this->TaxVendorRefFullName;
    }

    function getSalesTaxRefListID() {
        return $this->SalesTaxRefListID;
    }

    function getSalesTaxRefFullName() {
        return $this->SalesTaxRefFullName;
    }

    function getCustomField1() {
        return $this->CustomField1;
    }

// **********************
// SETTER METHODS
// **********************


    function setListID($val) {
        $this->ListID = $val;
    }

    function setFullName($val) {
        $this->FullName = $val;
    }

    function setIsActive($val) {
        $this->IsActive = $val;
    }

    function setClassRefListID($val) {
        $this->ClassRefListID = $val;
    }

    function setClassRefFullName($val) {
        $this->ClassRefFullName = $val;
    }

    function setIsUsed($val) {
        $this->IsUsed = $val;
    }

    function setItemDesc($val) {
        $this->ItemDesc = $val;
    }

    function setTaxRate($val) {
        $this->TaxRate = $val;
    }

    function setTaxVendorRefListID($val) {
        $this->TaxVendorRefListID = $val;
    }

    function setTaxVendorRefFullName($val) {
        $this->TaxVendorRefFullName = $val;
    }

    function setSalesTaxRefListID($val) {
        $this->SalesTaxRefListID = $val;
    }

    function setSalesTaxRefFullName($val) {
        $this->SalesTaxRefFullName = $val;
    }

    function setCustomField1($val) {
        $this->CustomField1 = $val;
    }

    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->setSchema("coopdb");
        $this->setSource("itemsalestax");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'itemsalestax';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Itemsalestax[]|Itemsalestax|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Itemsalestax|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
