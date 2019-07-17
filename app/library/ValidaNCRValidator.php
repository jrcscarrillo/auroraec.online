<?php

use Phalcon\Validation as validador;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

class ValidaNCRValidator extends Validator implements ValidatorInterface {

    /**
     *
     * @param  Validation $validator
     * @param  string $attribute
     *
     * @return boolean
     */
    public function validate($validator, $attribute) {
        //obtain the name of the field 
        $elcorreo = $this->getOption("correo");

        //obtain field value
        $elcorreo_value = $validator->getValue($elcorreo);

        // obtain the input field value
        $elpassword = $validator->getValue($attribute);

        //try to obtain message defined in a validator
        $message = $this->getOption('message');

        //check if the value is valid
        $user = Users::findFirst(array(
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
