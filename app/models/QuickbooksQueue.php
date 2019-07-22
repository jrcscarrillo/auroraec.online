<?php

class QuickbooksQueue extends \Phalcon\Mvc\Model {

// **********************
// ATTRIBUTE DECLARATION
// **********************


    protected $quickbooks_queue_id;
    protected $quickbooks_ticket_id;
    protected $qb_username;
    protected $qb_action;
    protected $ident;
    protected $extra;
    protected $qbxml;
    protected $priority;
    protected $qb_status;
    protected $msg;
    protected $enqueue_datetime;
    protected $dequeue_datetime;

    public function setQuickbooksQueueId($quickbooks_queue_id) {
        $this->quickbooks_queue_id = $quickbooks_queue_id;

        return $this;
    }

    /**
     * Method to set the value of field quickbooks_ticket_id
     *
     * @param integer $quickbooks_ticket_id
     * @return $this
     */
    public function setQuickbooksTicketId($quickbooks_ticket_id) {
        $this->quickbooks_ticket_id = $quickbooks_ticket_id;

        return $this;
    }

    /**
     * Method to set the value of field qb_username
     *
     * @param string $qb_username
     * @return $this
     */
    public function setQbUsername($qb_username) {
        $this->qb_username = $qb_username;

        return $this;
    }

    /**
     * Method to set the value of field qb_action
     *
     * @param string $qb_action
     * @return $this
     */
    public function setQbAction($qb_action) {
        $this->qb_action = $qb_action;

        return $this;
    }

    /**
     * Method to set the value of field ident
     *
     * @param string $ident
     * @return $this
     */
    public function setIdent($ident) {
        $this->ident = $ident;

        return $this;
    }

    /**
     * Method to set the value of field extra
     *
     * @param string $extra
     * @return $this
     */
    public function setExtra($extra) {
        $this->extra = $extra;

        return $this;
    }

    /**
     * Method to set the value of field qbxml
     *
     * @param string $qbxml
     * @return $this
     */
    public function setQbxml($qbxml) {
        $this->qbxml = $qbxml;

        return $this;
    }

    /**
     * Method to set the value of field priority
     *
     * @param integer $priority
     * @return $this
     */
    public function setPriority($priority) {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Method to set the value of field qb_status
     *
     * @param string $qb_status
     * @return $this
     */
    public function setQbStatus($qb_status) {
        $this->qb_status = $qb_status;

        return $this;
    }

    /**
     * Method to set the value of field msg
     *
     * @param string $msg
     * @return $this
     */
    public function setMsg($msg) {
        $this->msg = $msg;

        return $this;
    }

    /**
     * Method to set the value of field enqueue_datetime
     *
     * @param string $enqueue_datetime
     * @return $this
     */
    public function setEnqueueDatetime($enqueue_datetime) {
        $this->enqueue_datetime = $enqueue_datetime;

        return $this;
    }

    /**
     * Method to set the value of field dequeue_datetime
     *
     * @param string $dequeue_datetime
     * @return $this
     */
    public function setDequeueDatetime($dequeue_datetime) {
        $this->dequeue_datetime = $dequeue_datetime;

        return $this;
    }

    /**
     * Returns the value of field quickbooks_queue_id
     *
     * @return integer
     */
    public function getQuickbooksQueueId() {
        return $this->quickbooks_queue_id;
    }

    /**
     * Returns the value of field quickbooks_ticket_id
     *
     * @return integer
     */
    public function getQuickbooksTicketId() {
        return $this->quickbooks_ticket_id;
    }

    /**
     * Returns the value of field qb_username
     *
     * @return string
     */
    public function getQbUsername() {
        return $this->qb_username;
    }

    /**
     * Returns the value of field qb_action
     *
     * @return string
     */
    public function getQbAction() {
        return $this->qb_action;
    }

    /**
     * Returns the value of field ident
     *
     * @return string
     */
    public function getIdent() {
        return $this->ident;
    }

    /**
     * Returns the value of field extra
     *
     * @return string
     */
    public function getExtra() {
        return $this->extra;
    }

    /**
     * Returns the value of field qbxml
     *
     * @return string
     */
    public function getQbxml() {
        return $this->qbxml;
    }

    /**
     * Returns the value of field priority
     *
     * @return integer
     */
    public function getPriority() {
        return $this->priority;
    }

    /**
     * Returns the value of field qb_status
     *
     * @return string
     */
    public function getQbStatus() {
        return $this->qb_status;
    }

    /**
     * Returns the value of field msg
     *
     * @return string
     */
    public function getMsg() {
        return $this->msg;
    }

    /**
     * Returns the value of field enqueue_datetime
     *
     * @return string
     */
    public function getEnqueueDatetime() {
        return $this->enqueue_datetime;
    }

    /**
     * Returns the value of field dequeue_datetime
     *
     * @return string
     */
    public function getDequeueDatetime() {
        return $this->dequeue_datetime;
    }

    /**
     * Initialize method for model.
     */
    public function initialize() {
        $this->setSchema("coopdb");
        $this->setSource("quickbooks_queue");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'quickbooks_queue';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return QuickbooksQueue[]|QuickbooksQueue|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null) {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return QuickbooksQueue|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null) {
        return parent::findFirst($parameters);
    }

}
