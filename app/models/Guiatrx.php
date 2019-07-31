<?php

class Guiatrx extends \Phalcon\Mvc\Model {

    /**
     *
     * @var string
     * @Primary
     * @Column(type="string", length=50, nullable=false)
     */
    protected $txnID;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $timeCreated;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $timeModified;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $editSequence;

    /**
     *
     * @var string
     * @Column(type="string", length=250, nullable=false)
     */
    protected $numeroLote;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $ItemRefListID;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=false)
     */
    protected $ItemRefFullName;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $obsLote;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $origenTrx;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $destinoTrx;

    /**
     *
     * @var integer
     * @Column(type="integer", length=7, nullable=false)
     */
    protected $qty;

    /**
     *
     * @var string
     * @Column(type="string", length=25, nullable=false)
     */
    protected $IDKEY;

    /**
     *
     * @var string
     * @Column(type="string", length=12, nullable=false)
     */
    protected $estado;

    /**
     * Method to set the value of field txnID
     *
     * @param string $txnID
     * @return $this
     */
    public function setTxnID($txnID) {
        $this->txnID = $txnID;

        return $this;
    }

    /**
     * Method to set the value of field timeCreated
     *
     * @param string $timeCreated
     * @return $this
     */
    public function setTimeCreated($timeCreated) {
        $this->timeCreated = $timeCreated;

        return $this;
    }

    /**
     * Method to set the value of field timeModified
     *
     * @param string $timeModified
     * @return $this
     */
    public function setTimeModified($timeModified) {
        $this->timeModified = $timeModified;

        return $this;
    }

    /**
     * Method to set the value of field editSequence
     *
     * @param integer $editSequence
     * @return $this
     */
    public function setEditSequence($editSequence) {
        $this->editSequence = $editSequence;

        return $this;
    }

    /**
     * Method to set the value of field numeroLote
     *
     * @param string $numeroLote
     * @return $this
     */
    public function setNumeroLote($numeroLote) {
        $this->numeroLote = $numeroLote;

        return $this;
    }

    /**
     * Method to set the value of field itemRefListID
     *
     * @param string $itemRefListID
     * @return $this
     */
    public function setItemRefListID($ItemRefListID) {
        $this->ItemRefListID = $ItemRefListID;

        return $this;
    }

    /**
     * Method to set the value of field itemRefFullName
     *
     * @param string $itemRefFullName
     * @return $this
     */
    public function setItemRefFullName($ItemRefFullName) {
        $this->ItemRefFullName = $ItemRefFullName;

        return $this;
    }

    /**
     * Method to set the value of field obsLote
     *
     * @param string $obsLote
     * @return $this
     */
    public function setObsLote($obsLote) {
        $this->obsLote = $obsLote;

        return $this;
    }

    /**
     * Method to set the value of field origenTrx
     *
     * @param string $origenTrx
     * @return $this
     */
    public function setOrigenTrx($origenTrx) {
        $this->origenTrx = $origenTrx;

        return $this;
    }

    /**
     * Method to set the value of field destinoTrx
     *
     * @param string $destinoTrx
     * @return $this
     */
    public function setDestinoTrx($destinoTrx) {
        $this->destinoTrx = $destinoTrx;

        return $this;
    }

    /**
     * Method to set the value of field qty
     *
     * @param integer $qty
     * @return $this
     */
    public function setQty($qty) {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Method to set the value of field iDKEY
     *
     * @param string $iDKEY
     * @return $this
     */
    public function setIDKEY($IDKEY) {
        $this->IDKEY = $IDKEY;

        return $this;
    }

    /**
     * Method to set the value of field estado
     *
     * @param string $estado
     * @return $this
     */
    public function setEstado($estado) {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Returns the value of field txnID
     *
     * @return string
     */
    public function getTxnID() {
        return $this->txnID;
    }

    /**
     * Returns the value of field timeCreated
     *
     * @return string
     */
    public function getTimeCreated() {
        return $this->timeCreated;
    }

    /**
     * Returns the value of field timeModified
     *
     * @return string
     */
    public function getTimeModified() {
        return $this->timeModified;
    }

    /**
     * Returns the value of field editSequence
     *
     * @return integer
     */
    public function getEditSequence() {
        return $this->editSequence;
    }

    /**
     * Returns the value of field numeroLote
     *
     * @return string
     */
    public function getNumeroLote() {
        return $this->numeroLote;
    }

    /**
     * Returns the value of field itemRefListID
     *
     * @return string
     */
    public function getItemRefListID() {
        return $this->ItemRefListID;
    }

    /**
     * Returns the value of field itemRefFullName
     *
     * @return string
     */
    public function getItemRefFullName() {
        return $this->ItemRefFullName;
    }

    /**
     * Returns the value of field obsLote
     *
     * @return string
     */
    public function getObsLote() {
        return $this->obsLote;
    }

    /**
     * Returns the value of field origenTrx
     *
     * @return string
     */
    public function getOrigenTrx() {
        return $this->origenTrx;
    }

    /**
     * Returns the value of field destinoTrx
     *
     * @return string
     */
    public function getDestinoTrx() {
        return $this->destinoTrx;
    }

    /**
     * Returns the value of field qty
     *
     * @return integer
     */
    public function getQty() {
        return $this->qty;
    }

    /**
     * Returns the value of field iDKEY
     *
     * @return string
     */
    public function getIDKEY() {
        return $this->IDKEY;
    }

    /**
     * Returns the value of field estado
     *
     * @return string
     */
    public function getEstado() {
        return $this->estado;
    }

    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->setSchema("coopdb");
        $this->setSource("guiatrx");
        $this->belongsTo('IDKEY', 'Guiacab', 'txnID');
        $this->belongsTo(
           'ItemRefListID', 'Items', 'quickbooks_listid');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'guiatrx';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Guiatrx[]|Guiatrx|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Guiatrx|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
