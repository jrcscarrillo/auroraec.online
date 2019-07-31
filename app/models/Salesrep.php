<?php

class Salesrep extends \Phalcon\Mvc\Model
{

    // **********************
    // ATTRIBUTE DECLARATION
    // **********************

    protected $ListID;
    protected $TimeCreated;
    protected $TimeModified;
    protected $EditSequence;
    protected $Initial;
    protected $IsActive;
    protected $SalesRepEntityRef_ListID;
    protected $SalesRepEntityRef_FullName;
    protected $Status;

    // **********************
    // GETTER METHODS
    // **********************

    public function getListID()
    {
        return $this->ListID;
    }

    public function getTimeCreated()
    {
        return $this->TimeCreated;
    }

    public function getTimeModified()
    {
        return $this->TimeModified;
    }

    public function getEditSequence()
    {
        return $this->EditSequence;
    }

    public function getInitial()
    {
        return $this->Initial;
    }

    public function getIsActive()
    {
        return $this->IsActive;
    }

    public function getSalesRepEntityRefListID()
    {
        return $this->SalesRepEntityRef_ListID;
    }

    public function getSalesRepEntityRefFullName()
    {
        return $this->SalesRepEntityRef_FullName;
    }

    public function getStatus()
    {
        return $this->Status;
    }

    // **********************
    // SETTER METHODS
    // **********************

    public function setListID($val)
    {
        $this->ListID = $val;
    }

    public function setTimeCreated($val)
    {
        $this->TimeCreated = $val;
    }

    public function setTimeModified($val)
    {
        $this->TimeModified = $val;
    }

    public function setEditSequence($val)
    {
        $this->EditSequence = $val;
    }

    public function setInitial($val)
    {
        $this->Initial = $val;
    }

    public function setIsActive($val)
    {
        $this->IsActive = $val;
    }

    public function setSalesRepEntityRefListID($val)
    {
        $this->SalesRepEntityRef_ListID = $val;
    }

    public function setSalesRepEntityRefFullName($val)
    {
        $this->SalesRepEntityRef_FullName = $val;
    }

    public function setStatus($val)
    {
        $this->Status = $val;
    }

    public function initialize()
    {
        $this->setSchema("coopdb");
        $this->setSource("salesrep");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'salesrep';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Salesrep[]|Salesrep|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Salesrep|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
