<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class SessionForm extends Form {

    public function initialize() {


        $email = new Text("email");
        $email->setLabel("Correo Electronico");
        $email->setFilters(array('striptags', 'string'));
        $email->addValidators(array(
            new PresenceOf(array(
                'message' => 'No ha ingresado la direccion de correo'
                    )),
            new Email(array(
                'message' => 'debe ingresar una direccion de correo valida'
                    ))
        ));
        $this->add($email);

        $password = new Password("password");
        $password->setLabel("Password");
        $password->addValidators(array(
            new PresenceOf(array(
                'message' => 'Debe ingresar una palabra clave'
                    )),
            new ValidaUserValidator(array(
                'correo' => 'email',
                'message' => 'El Email o el password no han sido registrados vuelva ha intentarlo'
                    ))
        ));

        $this->add($password);
    }

    public function messages($nombre) {
        if ($this->hasMessagesFor($nombre)) {
            foreach ($this->getMessagesFor($nombre) as $mensaje) {
                $this->flash->error($mensaje);
            }
        }
    }

}
