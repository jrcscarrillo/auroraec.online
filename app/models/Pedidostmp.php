<?php

class Pedidostmp extends \Phalcon\Mvc\Model
{
// **********************
// ATTRIBUTE DECLARATION
// **********************


public $TxnID;   
public $TimeCreated;   
public $TimeModified;   
public $EditSequence;   
public $TxnNumber;   
public $CustomerRef_ListID;   
public $CustomerRef_FullName;   
public $TxnDate;   
public $RefNumber;   
public $PONumber;   
public $TermsRef_ListID;   
public $TermsRef_FullName;   
public $DueDate;   
public $SalesRepRef_ListID;   
public $SalesRepRef_FullName;   
public $Subtotal;   
public $SalesTaxTotal;   
public $TotalAmount;   
public $IsManuallyClosed;   
public $IsFullyInvoiced;   
public $Memo;   
public $CustomerMsgRef_ListID;   
public $CustomerMsgRef_FullName;   
public $Other;   
public $Status;   
public $TxnLineID;   
public $ItemRef_ListID;   
public $ItemRef_FullName;   
public $Description;   
public $Quantity;   
public $UnitOfMeasure;   
public $Rate;   
public $RatePercent;   
public $Amount;   
public $InventorySiteRef_ListID;   
public $InventorySiteRef_FullName;   
public $SerialNumber;   
public $LotNumber;   
public $SalesTaxCodeRef_ListID;   
public $SalesTaxCodeRef_FullName;   
public $Invoiced;   
public $Other1;   
public $Other2;   
public $IDKEY;   

// **********************
// GETTER METHODS
// **********************


function getTxnID()
{
return $this->TxnID;
}

function getTimeCreated()
{
return $this->TimeCreated;
}

function getTimeModified()
{
return $this->TimeModified;
}

function getEditSequence()
{
return $this->EditSequence;
}

function getTxnNumber()
{
return $this->TxnNumber;
}

function getCustomerRefListID()
{
return $this->CustomerRef_ListID;
}

function getCustomerRefFullName()
{
return $this->CustomerRef_FullName;
}

function getTxnDate()
{
return $this->TxnDate;
}

function getRefNumber()
{
return $this->RefNumber;
}

function getPONumber()
{
return $this->PONumber;
}

function getTermsRef_ListID()
{
return $this->TermsRef_ListID;
}

function getTermsRef_FullName()
{
return $this->TermsRef_FullName;
}

function getDueDate()
{
return $this->DueDate;
}

function getSalesRepRef_ListID()
{
return $this->SalesRepRef_ListID;
}

function getSalesRepRef_FullName()
{
return $this->SalesRepRef_FullName;
}

function getSubtotal()
{
return $this->Subtotal;
}

function getSalesTaxTotal()
{
return $this->SalesTaxTotal;
}

function getTotalAmount()
{
return $this->TotalAmount;
}

function getIsManuallyClosed()
{
return $this->IsManuallyClosed;
}

function getIsFullyInvoiced()
{
return $this->IsFullyInvoiced;
}

function getMemo()
{
return $this->Memo;
}

function getCustomerMsgRef_ListID()
{
return $this->CustomerMsgRef_ListID;
}

function getCustomerMsgRef_FullName()
{
return $this->CustomerMsgRef_FullName;
}

function getOther()
{
return $this->Other;
}

function getStatus()
{
return $this->Status;
}

function getTxnLineID()
{
return $this->TxnLineID;
}

function getItemRef_ListID()
{
return $this->ItemRef_ListID;
}

function getItemRef_FullName()
{
return $this->ItemRef_FullName;
}

function getDescription()
{
return $this->Description;
}

function getQuantity()
{
return $this->Quantity;
}

function getUnitOfMeasure()
{
return $this->UnitOfMeasure;
}

function getRate()
{
return $this->Rate;
}

function getRatePercent()
{
return $this->RatePercent;
}

function getAmount()
{
return $this->Amount;
}

function getInventorySiteRef_ListID()
{
return $this->InventorySiteRef_ListID;
}

function getInventorySiteRef_FullName()
{
return $this->InventorySiteRef_FullName;
}

function getSerialNumber()
{
return $this->SerialNumber;
}

function getLotNumber()
{
return $this->LotNumber;
}

function getSalesTaxCodeRef_ListID()
{
return $this->SalesTaxCodeRef_ListID;
}

function getSalesTaxCodeRef_FullName()
{
return $this->SalesTaxCodeRef_FullName;
}

function getInvoiced()
{
return $this->Invoiced;
}

function getOther1()
{
return $this->Other1;
}

function getOther2()
{
return $this->Other2;
}

function getIDKEY()
{
return $this->IDKEY;
}

// **********************
// SETTER METHODS
// **********************


function setTxnID($val)
{
$this->TxnID =  $val;
}

function setTimeCreated($val)
{
$this->TimeCreated =  $val;
}

function setTimeModified($val)
{
$this->TimeModified =  $val;
}

function setEditSequence($val)
{
$this->EditSequence =  $val;
}

function setTxnNumber($val)
{
$this->TxnNumber =  $val;
}

function setCustomerRefListID($val)
{
$this->CustomerRef_ListID =  $val;
}

function setCustomerRefFullName($val)
{
$this->CustomerRef_FullName =  $val;
}

function setTxnDate($val)
{
$this->TxnDate =  $val;
}

function setRefNumber($val)
{
$this->RefNumber =  $val;
}

function setPONumber($val)
{
$this->PONumber =  $val;
}

function setTermsRef_ListID($val)
{
$this->TermsRef_ListID =  $val;
}

function setTermsRef_FullName($val)
{
$this->TermsRef_FullName =  $val;
}

function setDueDate($val)
{
$this->DueDate =  $val;
}

function setSalesRepRef_ListID($val)
{
$this->SalesRepRef_ListID =  $val;
}

function setSalesRepRef_FullName($val)
{
$this->SalesRepRef_FullName =  $val;
}

function setSubtotal($val)
{
$this->Subtotal =  $val;
}

function setSalesTaxTotal($val)
{
$this->SalesTaxTotal =  $val;
}

function setTotalAmount($val)
{
$this->TotalAmount =  $val;
}

function setIsManuallyClosed($val)
{
$this->IsManuallyClosed =  $val;
}

function setIsFullyInvoiced($val)
{
$this->IsFullyInvoiced =  $val;
}

function setMemo($val)
{
$this->Memo =  $val;
}

function setCustomerMsgRef_ListID($val)
{
$this->CustomerMsgRef_ListID =  $val;
}

function setCustomerMsgRef_FullName($val)
{
$this->CustomerMsgRef_FullName =  $val;
}

function setOther($val)
{
$this->Other =  $val;
}

function setStatus($val)
{
$this->Status =  $val;
}

function setTxnLineID($val)
{
$this->TxnLineID =  $val;
}

function setItemRef_ListID($val)
{
$this->ItemRef_ListID =  $val;
}

function setItemRef_FullName($val)
{
$this->ItemRef_FullName =  $val;
}

function setDescription($val)
{
$this->Description =  $val;
}

function setQuantity($val)
{
$this->Quantity =  $val;
}

function setUnitOfMeasure($val)
{
$this->UnitOfMeasure =  $val;
}

function setRate($val)
{
$this->Rate =  $val;
}

function setRatePercent($val)
{
$this->RatePercent =  $val;
}

function setAmount($val)
{
$this->Amount =  $val;
}

function setInventorySiteRef_ListID($val)
{
$this->InventorySiteRef_ListID =  $val;
}

function setInventorySiteRef_FullName($val)
{
$this->InventorySiteRef_FullName =  $val;
}

function setSerialNumber($val)
{
$this->SerialNumber =  $val;
}

function setLotNumber($val)
{
$this->LotNumber =  $val;
}

function setSalesTaxCodeRef_ListID($val)
{
$this->SalesTaxCodeRef_ListID =  $val;
}

function setSalesTaxCodeRef_FullName($val)
{
$this->SalesTaxCodeRef_FullName =  $val;
}

function setInvoiced($val)
{
$this->Invoiced =  $val;
}

function setOther1($val)
{
$this->Other1 =  $val;
}

function setOther2($val)
{
$this->Other2 =  $val;
}

function setIDKEY($val)
{
$this->IDKEY =  $val;
}

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("coopdb");
        $this->setSource("pedidostmp");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'pedidostmp';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Pedidostmp[]|Pedidostmp|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Pedidostmp|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
