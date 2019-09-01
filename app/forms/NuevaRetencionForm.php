<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;

class NuevaRetencionForm extends Form {

    public function initialize() {

        $fechaemision = new Date("fechaemision ");
        $fechaemision ->setLabel("Fecha Retencion");
        $fechaemision ->addValidators(array(
           new PresenceOf(array(
              'message' => 'Indicar la fecha de emision de la nota de credito'
              ))
        ));
        $this->add($fechaemision );

        $numerofactura = new Text("numerofactura");
        $numerofactura->setLabel("Numero Factura");
        $numerofactura->addValidators(array(
           new PresenceOf(array(
              'message' => 'Debe indicar el numero de factura'
              )),
            new Regex(array(
                'pattern' => '/^\d{3}\-\d{3}\-\d{3,9}$/',
                'message' => 'El numero de factura no corresponde a la notacion requerida por el SRI'
            )),
            new ValidaCompraValidator(array(
                'message' => 'Este numero de factura no se encuentra registrado'
            ))
        ));
        $this->add($numerofactura);
        
        $numeroretencion = new Text("numeroretencion");
        $numeroretencion->setLabel("Numero Retencion");
        $numeroretencion->addValidators(array(
            new PresenceOf(array(
                'message' => 'Debe ingresar un numero de Retencion'
            )),
        ));
        $this->add($numeroretencion);
        
        $referencia = new TextArea("referencia");
        $referencia->setLabel("Referencia");
        $referencia->setFilters(array('striptags', 'string'));
        $referencia->addValidators(array(
           new PresenceOf(array(
              'message' => 'Debe ingresar al menos n/a en referencia'
              ))
        ));
        $this->add($referencia);
        
        $notaproveedor = new TextArea("notaproveedor");
        $notaproveedor->setLabel("Nota Comprador");
        $notaproveedor->setFilters(array('striptags', 'string'));
        $notaproveedor->addValidators(array(
           new PresenceOf(array(
              'message' => 'Debe ingresar al menos n/a en notas al comprador'
              ))
        ));
        $this->add($notaproveedor);
        
        $condiciones = new TextArea("condiciones");
        $condiciones->setLabel("Condiciones");
        $condiciones->setFilters(array('striptags', 'string'));
        $condiciones->addValidators(array(
           new PresenceOf(array(
              'message' => 'Debe ingresar al menos n/a en los terminos y condiciones'
              ))
        ));
        $this->add($condiciones);
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
