<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Date;
use Phalcon\Validation\Validator\PresenceOf;

class GuiaForm extends Form {

    public function initialize() {


        $txnDate = new Date("txnDate");
        $txnDate->setLabel("Fecha Guia");
        $txnDate->addValidators(array(
           new PresenceOf(array(
              'message' => 'Mensaje de validacion'
              ))
        ));
        $this->add($txnDate);

        $refNumber = new Text("refNumber");
        $refNumber->setLabel("Numero Guia");
        $refNumber->setFilters(array('striptags', 'strig'));
        $refNumber->addValidators(array(
           new PresenceOf(array(
              'message' => 'Mensaje de validacion'
              ))
        ));
        $this->add($refNumber);

        $customField15 = new Text("customField15");
        $customField15->setLabel("Estado Facturacion Electronica");
        $customField15->setFilters(array('striptags', 'strig'));
        $customField15->addValidators(array(
           new PresenceOf(array(
              'message' => 'Mensaje de validacion'
              ))
        ));
        $this->add($customField15);
    }

}
