<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Date;
use Phalcon\Validation\Validator\PresenceOf;

class GuiaInvoiceForm extends Form {

    public function initialize() {


        $TxnDate = new Date("TxnDate");
        $TxnDate->setLabel("Fecha Facturas");
        $TxnDate->addValidators(array(
           new PresenceOf(array(
              'message' => 'Mensaje de validacion'
              ))
        ));
        $this->add($TxnDate);

        $RefNumber = new Text("RefNumber");
        $RefNumber->setLabel("Numero Factura");
        $RefNumber->setFilters(array('striptags', 'strig'));
        $RefNumber->addValidators(array(
           new PresenceOf(array(
              'message' => 'Mensaje de validacion'
              ))
        ));
        $this->add($RefNumber);

        $CustomField7 = new Hidden("CustomField7");
        $CustomField7->setLabel("Guia Procesada");
        $this->add($CustomField7);
        
        $CustomField8 = new Hidden("CustomField8");
        $CustomField8->setLabel("Numero Guia");
        $this->add($CustomField8);
        
        $CustomField15 = new Text("CustomField15");
        $CustomField15->setLabel("Estado Facturacion Electronica");
        $CustomField15->setFilters(array('striptags', 'strig'));
        $CustomField15->addValidators(array(
           new PresenceOf(array(
              'message' => 'Mensaje de validacion'
              ))
        ));
        $this->add($CustomField15);
    }

}
