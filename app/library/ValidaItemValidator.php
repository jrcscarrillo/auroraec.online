<?php


use Phalcon\Validation as validador;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

class ValidaitemValidator extends Validator implements ValidatorInterface {

    /**
     *
     * @param  Validation $validator
     * @param  string $attribute
     *
     * @return boolean
     */
    public function validate(Phalcon\Validation $validator, $attribute) {
        //obtain the name of the field 
        $itemref = $this->getOption("ItemRef");

        //obtain field value
        $itref_value = $validator->getValue($itemref);

        // obtain the input field value
        $itemref_value = $validator->getValue($attribute);

        //try to obtain message defined in a validator
        $message = $this->getOption('message');

        //check if the value is valid
        $user = Items::findFirst(array(
                    "(email = :email: OR username = :email:) AND password = :password: AND active = 'Y'",
                    'bind' => array('email' => $elcorreo_value, 'password' => sha1($elpassword))
        ));
        if (!$user) {
            $message = 'NO estan registrados en nuestra base de datos el correo o la palabra clave - Vuelva ha intentarlo';
            $validator->appendMessage(new Message($message, $attribute, 'usuario'));
        }
        if (count($validator->getMessages())) {
            return false;
        }
        return true;
    }

}
