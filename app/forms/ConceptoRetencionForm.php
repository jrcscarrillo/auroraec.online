<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;

class ConceptoRetencionForm extends Form {

    public function initialize() {

        $ListID = new Hidden("Clave");
        $this->add($ListID);

        $CodigoConcepto = new Text("CodigoConcepto");
        $CodigoConcepto->setLabel("Codigo Concepto");
        $CodigoConcepto->addValidators(array(
            new PresenceOf(array(
                'message' => 'No ha ingresado el concepto de la retencion de la tabla del SRI'
                    ))
        ));
        $this->add($CodigoConcepto);

        $NombreConcepto = new Text("NombreConcepto");
        $NombreConcepto->setLabel("Nombre Concepto");
        $NombreConcepto->addValidators(array(
            new PresenceOf(array(
                'message' => 'No ha ingresado el concepto de la retencion de la tabla del SRI'
                    ))
        ));
        $this->add($NombreConcepto);

        $tipoconcepto = new Select("tipoconcepto", array("1" => "RENTA", "2" => "IVA", "6" => "ISD"));
        $tipoconcepto->setLabel("Tipo Concepto");
        $tipoconcepto->addValidators(array(
            new PresenceOf(array(
                'message' => 'No ha seleccionado el tipo de factura'
                    ))
        ));
        $this->add($tipoconcepto);

        $destipo = 'OtherCharge';
        $retenciones = Items::find([
                    "columns" => "nombre, quickbooks_listid",
                    "conditions" => "tipo = ?1",
                    "bind" => [1 => $destipo],
                    "order" => "nombre"
        ]);

        $ItemRef = new Select(
                'ItemRef', $retenciones, [
            'using' => [
                'quickbooks_listid',
                'nombre',
            ]
                ]
        );

        $this->add($ItemRef);

        $Percentaje = new Numeric("Percentaje");
        $Percentaje->setLabel("Porcentaje");
        $Percentaje->addValidators(array(
            new PresenceOf(array(
                'message' => 'Debe indicar el porcentaje de retencion'
                    ))
        ));
        $this->add($Percentaje);
    }

    /**
     * Prints messages for a specific element
     */
    public function messages($nombre) {
        if ($this->hasMessagesFor($nombre)) {
            foreach ($this->getMessagesFor($nombre) as $mensaje) {
                $this->flash->error($mensaje);
            }
        }
    }

}
