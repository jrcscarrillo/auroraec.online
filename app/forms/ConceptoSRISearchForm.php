<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Date;

class ConceptoSRISearchForm extends Form {
    
   public function initialize($entity = null, $options = array()) {

        $RefNumber = new Text("RefNumber");
        $RefNumber->setLabel("Numero Referencia");
        $this->add($RefNumber);

        $TxnDate = new Date("TxnDate");
        $TxnDate->setLabel("Fecha de Emision");
        $this->add($TxnDate);

        $CustomField1 = new Text("CustomField1");
        $CustomField1->setLabel("Factura de Compra");
        $this->add($CustomField1);

        $CustomField15 = new Text("CustomField15");
        $CustomField15->setLabel("Estado Facturacion Electronica");
        $this->add($CustomField1);

    }

}
