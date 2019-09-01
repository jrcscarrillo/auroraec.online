<?php

use \Phalcon\Forms\Form;
use \Phalcon\Forms\Element\Numeric;
use \Phalcon\Forms\Element\Select;
use \Phalcon\Validation\Validator\PresenceOf;

class RetencionProductoForm extends Form {

    public function initialize() {

        $item = Sricodes::find([
                    "columns" => "FullName, ListID"
        ]);
        $ItemRefListID = new Select(
                'ItemRefListID', $item, [
            'using' => [
                'ListID',
                'FullName',
            ]
                ]
        );

        $this->add($ItemRefListID);

        $base = new Numeric("base");
        $base->setLabel("Base Imponible");
        $base->addValidators(array(
            new PresenceOf(array(
                'message' => 'Debe ingresar un valor'
                    ))
        ));
        
        $this->add($base);
        
    }

}
