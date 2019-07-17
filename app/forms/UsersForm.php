<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;

class UsersForm extends Form
{

    public function initialize($entity = null, $options = array())
    {

        $tipo = new Text("tipo");
        $tipo->setLabel("Tipo Usuario");
        $tipo->setFilters(array('striptags', 'string'));
        $this->add($tipo);

        $username = new Text("username");
        $username->setLabel("Nombre Usuario");
        $username->setFilters(array('striptags', 'string'));
        $this->add($username);

        $numeroId = new Text("numeroId");
        $numeroId->setLabel("Numero Identificacion");
        $numeroId->setFilters(array('striptags', 'string'));
        $this->add($numeroId);
        

        $name = new Text("name");
        $name->setLabel("Nombre");
        $name->setFilters(array('striptags', 'string'));
        $this->add($name);

        $email = new Text("email");
        $email->setLabel("Correo electronico");
        $email->setFilters(array('striptags', 'string'));
        $this->add($email);
        

    }

}