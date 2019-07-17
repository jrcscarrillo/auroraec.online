<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\TextArea;
use Phalcon\Forms\Element\Date;
use Phalcon\Forms\Element\Select;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Regex;
use ValidaInvoiceValidator;

class NuevaNCRForm extends Form {

    public function initialize() {

        $fechaemision = new Date("fechaemision ");
        $fechaemision ->setLabel("Fecha Nota CR");
        $fechaemision ->addValidators(array(
           new PresenceOf(array(
              'message' => 'Indicar la fecha de emision de la nota de credito'
              ))
        ));
        $this->add($fechaemision );

        $tiponotacr = new Select("tiponotacr", array("29" => "Aprobado Especial", "30" => "Devolucion Producto", "31" => "Descuento Producto"));
        $tiponotacr->setLabel("Tipo Nota de Credito");
        $tiponotacr->addValidators(array(
           new PresenceOf(array(
              'message' => 'No ha seleccionado el tipo de nota de credito'
              ))
        ));
        $this->add($tiponotacr);

        $aplica = new Select("aplica", array("28" => "Producto en mal estado", "29" => "Descuento en Promocion", "30" => "Descuento Pronto Pago"));
        $aplica->setLabel("aplica");
        $aplica->addValidators(array(
           new PresenceOf(array(
              'message' => 'No ha seleccionado el motivo para el credito'
              ))
        ));
        $this->add($aplica);

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
            new ValidaInvoiceValidator(array(
                'message' => 'Este numero de factura no se encuentra registrado'
            ))
        ));
        $this->add($numerofactura);
        
        $numeronotacr = new Text("numeronotacr");
        $numeronotacr->setLabel("Numero NotaCR");
        $numeronotacr->addValidators(array(
            new PresenceOf(array(
                'message' => 'Debe ingresar un numero de Nota de Credito'
            )),
        ));
        $this->add($numeronotacr);
        
        $referencia = new TextArea("referencia");
        $referencia->setLabel("Referencia");
        $referencia->setFilters(array('striptags', 'string'));
        $referencia->addValidators(array(
           new PresenceOf(array(
              'message' => 'Debe ingresar al menos n/a en referencia'
              ))
        ));
        $this->add($referencia);
        
        $notacomprador = new TextArea("notacomprador");
        $notacomprador->setLabel("Nota Comprador");
        $notacomprador->setFilters(array('striptags', 'string'));
        $notacomprador->addValidators(array(
           new PresenceOf(array(
              'message' => 'Debe ingresar al menos n/a en notas al comprador'
              ))
        ));
        $this->add($notacomprador);
        
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
