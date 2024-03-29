<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Date;
use Phalcon\Validation\Validator\PresenceOf;

class CreditmemoForm  extends Form {
    public function initialize() {

        $CustomerRef_FullName = new Text("CustomerRef_FullName");
        $CustomerRef_FullName->setLabel("Cliente Razon Social");
        $CustomerRef_FullName->setFilters(array('striptags', 'strig'));
        $this->add($CustomerRef_FullName);

        $TxnDate = new Date("TxnDate");
        $TxnDate->setLabel("Fecha NotaCR");
        $this->add($TxnDate);

        $RefNumber = new Text("RefNumber");
        $RefNumber->setLabel("Numero NotaCR");
        $RefNumber->setFilters(array('striptags', 'strig'));
        $this->add($RefNumber);

        $CustomField15 = new Text("CustomField15");
        $CustomField15->setLabel("Estado Facturacion Electronica");
        $CustomField15->setFilters(array('striptags', 'strig'));
        $this->add($CustomField15);
    }        
    }
