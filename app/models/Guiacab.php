<?php

class Guiacab extends \Phalcon\Mvc\Model {

// **********************
// ATTRIBUTE DECLARATION
// **********************


    protected $txnID;
    protected $timeCreated;
    protected $timeModified;
    protected $editSequence;
    protected $refNumber;
    protected $txnDate;
    protected $origenId;
    protected $origenName;
    protected $destinoId;
    protected $destinoName;
    protected $driverId;
    protected $driverName;
    protected $routeId;
    protected $routeName;
    protected $vehicleId;
    protected $vehicleName;
    protected $dateBegin;
    protected $dateEnd;
    protected $motive;
    protected $CustomField15;
    protected $CustomField10;
    protected $CustomField11;
    protected $CustomField12;
    protected $CustomField13;
    protected $CustomField14;
    protected $status;
    protected $estado;

// **********************
// GETTER METHODS
// **********************


    function gettxnID() {
        return $this->txnID;
    }

    function gettimeCreated() {
        return $this->timeCreated;
    }

    function gettimeModified() {
        return $this->timeModified;
    }

    function geteditSequence() {
        return $this->editSequence;
    }

    function getrefNumber() {
        return $this->refNumber;
    }

    function gettxnDate() {
        return $this->txnDate;
    }

    function getorigenId() {
        return $this->origenId;
    }

    function getorigenName() {
        return $this->origenName;
    }

    function getdestinoId() {
        return $this->destinoId;
    }

    function getdestinoName() {
        return $this->destinoName;
    }

    function getdriverId() {
        return $this->driverId;
    }

    function getdriverName() {
        return $this->driverName;
    }

    function getrouteId() {
        return $this->routeId;
    }

    function getrouteName() {
        return $this->routeName;
    }

    function getvehicleId() {
        return $this->vehicleId;
    }

    function getvehicleName() {
        return $this->vehicleName;
    }

    function getdateBegin() {
        return $this->dateBegin;
    }

    function getdateEnd() {
        return $this->dateEnd;
    }

    function getmotive() {
        return $this->motive;
    }

    function getCustomField15() {
        return $this->CustomField15;
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

    function getstatus() {
        return $this->status;
    }

    function getestado() {
        return $this->estado;
    }

// **********************
// SETTER METHODS
// **********************


    function settxnID($val) {
        $this->txnID = $val;
    }

    function settimeCreated($val) {
        $this->timeCreated = $val;
    }

    function settimeModified($val) {
        $this->timeModified = $val;
    }

    function seteditSequence($val) {
        $this->editSequence = $val;
    }

    function setrefNumber($val) {
        $this->refNumber = $val;
    }

    function settxnDate($val) {
        $this->txnDate = $val;
    }

    function setorigenId($val) {
        $this->origenId = $val;
    }

    function setorigenName($val) {
        $this->origenName = $val;
    }

    function setdestinoId($val) {
        $this->destinoId = $val;
    }

    function setdestinoName($val) {
        $this->destinoName = $val;
    }

    function setdriverId($val) {
        $this->driverId = $val;
    }

    function setdriverName($val) {
        $this->driverName = $val;
    }

    function setrouteId($val) {
        $this->routeId = $val;
    }

    function setrouteName($val) {
        $this->routeName = $val;
    }

    function setvehicleId($val) {
        $this->vehicleId = $val;
    }

    function setvehicleName($val) {
        $this->vehicleName = $val;
    }

    function setdateBegin($val) {
        $this->dateBegin = $val;
    }

    function setdateEnd($val) {
        $this->dateEnd = $val;
    }

    function setmotive($val) {
        $this->motive = $val;
    }

    function setCustomField15($val) {
        $this->CustomField15 = $val;
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

    function setstatus($val) {
        $this->status = $val;
    }

    function setestado($val) {
        $this->estado = $val;
    }

    public function initialize() {
        $this->setSchema("carrillo_dbaurora");
        $this->setSource("guiacab");
        $this->hasMany('txnID', 'Guiatrx', 'IDKEY');
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Guiacab[]|Guiacab|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Guiacab|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'guiacab';
    }

}
