<?php


use Phalcon\Validation as validador;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

class ValidaCompraValidator extends Validator implements ValidatorInterface {

    /**
     *
     * @param  Validation $validator
     * @param  string $attribute
     *
     * @return boolean
     */
    public function validate(Phalcon\Validation $validator, $attribute) {
        //obtain the name of the field 

        //obtain field value

        // obtain the input field value
        $lafactura  = $validator->getValue($attribute);

        //try to obtain message defined in a validator
        $message = $this->getOption('message');

        //check if the value is valid
        $compra = Bill::findFirstByRefNumber($lafactura);
        if (!$compra) {
            $message = 'NO esta registrada en nuestra base de datos el numero de esta factura - Vuelva ha intentarlo';
            $validator->appendMessage(new Message($message, $attribute, 'usuario'));
        }
        if (count($validator->getMessages())) {
            return false;
        }
        return true;
    }

}
