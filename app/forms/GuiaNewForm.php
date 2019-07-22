<?php

use \Phalcon\Forms\Form;
use \Phalcon\Forms\Element\Text;
use \Phalcon\Forms\Element\TextArea;
use \Phalcon\Forms\Element\Select;
use \Phalcon\Forms\Element\Date;
use \Phalcon\Validation\Validator\PresenceOf;
use \Phalcon\Validation\Validator\Regex;

class GuiaNewForm extends Form {

    public function initialize() {

        $refNumber = new Text("refNumber");
        $refNumber->setLabel(" Numero de la guia formato 111-111-111111111");
        $refNumber->setFilters(array('striptags', 'string'));
        $refNumber->addValidators(array(
           new PresenceOf(array(
              'message' => 'Debe ingresar un numero de guia'
              )),
           new Regex(array(
              'pattern' => '/^[0-9]{3}\-[0-9]{3}\-[0-9]{9}$/',
              'message' => 'Debe ingresar en un formato valido'
           ))
        ));
        $this->add($refNumber);

        $txnDate = new Date("txnDate");
        $txnDate->setLabel("Fecha de Emision");
        $txnDate->addValidators(array(
           new PresenceOf(array(
              'message' => 'Debe ingresar una fecha valida de emision'
              ))
        ));
        $this->add($txnDate);

        $origen = Bodegas::find([
            "columns" => "Name, ListID",
            "conditions" => "Sublevel > ?1 AND Status = ?2",
            "bind"       => [1 => "0", 2 => "CON-MOV"]
           ]); 
        $origenId = new Select(
           'origenId',
           $origen,
           [
              'using'      => [
                 'ListID',
                 'Name',
                 ]
              ]
           );

        $this->add($origenId);

        $destinoId = new Select(
           'destinoId',
           $origen,
           [
              'using'      => [
                 'ListID',
                 'Name',
                 ]
              ]
           );

        $this->add($destinoId);
        

        $chofer = Driver::find([
            "columns" => "description, listID",
           ]); 
        $driverId = new Select(
           'driverId',
           $chofer,
           [
              'using'      => [
                 'listID',
                 'description',
                 ]
              ]
           );

        $this->add($driverId);

        $ruta = Route::find([
            "columns" => "description, listID",
           ]); 
        $routeId = new Select(
           'routeId',
           $ruta,
           [
              'using'      => [
                 'listID',
                 'description',
                 ]
              ]
           );
        $this->add($routeId);

        $carro = Vehicle::find([
            "columns" => "description, listID",
           ]); 
        $vehicleId = new Select(
           'vehicleId',
           $carro,
           [
              'using'      => [
                 'listID',
                 'description',
                 ]
              ]
           );
        $this->add($vehicleId);

        $dateBegin = new Date("dateBegin");
        $dateBegin->setLabel(" Fecha que se inicia el transporte");
        $dateBegin->addValidators(array(
           new PresenceOf(array(
              'message' => 'Debe ingresar una fecha de inicio'
              ))
        ));
        $this->add($dateBegin);

        $dateEnd = new Date("dateEnd");
        $dateEnd->setLabel(" Fecha fin del transporte");
        $dateEnd->addValidators(array(
           new PresenceOf(array(
              'message' => 'Debe ingresar una fecha de fin'
              ))
        ));
        $this->add($dateEnd);

        $motive = new TextArea("motive");
        $motive->setLabel("Datos adicionales en la guia");
        $motive->setFilters(array('striptags', 'string'));
        $motive->addValidators(array(
           new PresenceOf(array(
              'message' => 'Debe ingresar al menos n/a'
              ))
        ));
        $this->add($motive);

    }

}
