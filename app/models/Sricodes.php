<?php

class Sricodes extends \Phalcon\Mvc\Model {

// **********************
// ATTRIBUTE DECLARATION
// **********************

    protected $ListID;
    protected $TimeModified;
    protected $FullName;
    protected $ItemRef_ListID;
    protected $ItemRef_FullName;
    protected $ValueCode;
    protected $CodeType;
    protected $Percentaje;
    protected $Estado;

// **********************
// GETTER METHODS
// **********************


    function getListID() {
        return $this->ListID;
    }

    function getTimeModified() {
        return $this->TimeModified;
    }

    function getFullName() {
        return $this->FullName;
    }

    function getItemRefListID() {
        return $this->ItemRef_ListID;
    }

    function getItemRefFullName() {
        return $this->ItemRef_FullName;
    }

    function getValueCode() {
        return $this->ValueCode;
    }

    function getCodeType() {
        return $this->CodeType;
    }

    function getPercentaje() {
        return $this->Percentaje;
    }

    function getEstado() {
        return $this->Estado;
    }

// **********************
// SETTER METHODS
// **********************


    function setListID($val) {
        $this->ListID = $val;
    }

    function setTimeModified($val) {
        $this->TimeModified = $val;
    }

    function setFullName($val) {
        $this->FullName = $val;
    }

    function setItemRefListID($val) {
        $this->ItemRef_ListID = $val;
    }

    function setItemRefFullName($val) {
        $this->ItemRef_FullName = $val;
    }

    function setValueCode($val) {
        $this->ValueCode = $val;
    }

    function setCodeType($val) {
        $this->CodeType = $val;
    }

    function setPercentaje($val) {
        $this->Percentaje = $val;
    }

    function setEstado($val) {
        $this->Estado = $val;
    }

    public function initialize() {
        $this->setSchema("coopdb");
        $this->setSource("sricodes");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'sricodes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Sricodes[]|Sricodes|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Sricodes|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
