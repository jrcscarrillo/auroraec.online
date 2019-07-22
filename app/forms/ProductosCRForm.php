<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\PresenceOf;
use \base\ValidaNCRValidator;

class ProductosCRForm extends Form {

    public function initialize() {

  
        for ($i = 0; $i < count($array); $i++) {
        }
    }
    /**
     * Prints messages for a specific element
     */
    public function messages($nombre)
    {
        if ($this->hasMessagesFor($nombre)) {
            foreach ($this->getMessagesFor($nombre) as $mensaje) {
                $this->flash->error($mensaje);
            }
        }
    }

}
