<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Numeric;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;

class ItemsEditForm extends Form {

    public function initialize($entity = null, $options = array()) {

        if (!isset($options['edit'])) {
            $element = new Numeric("id");
            $this->add($element->setLabel("Codigo Producto"));
        } else {
            $this->add(new Hidden("id"));
        }
        $name = new Text("name");
        $name->setLabel("Nombre Corto");
        $name->setFilters(array('striptags', 'string'));
        $name->addValidators(array(
            new PresenceOf(array(
                'message' => 'El Nombre Corto es requerido'
                    ))
        ));
        $this->add($name);

        $fullname = new Text("fullname");
        $fullname->setLabel("Nombre Largo");
        $fullname->setFilters(array('striptags', 'string'));
        $fullname->addValidators(array(
            new PresenceOf(array(
                'message' => 'El Nombre Largo es requerido'
                    ))
        ));
        $this->add($fullname);

        $description = new Text("description");
        $description->setLabel("Descripcion");
        $description->setFilters(array('striptags', 'string'));
        $description->addValidators(array(
            new PresenceOf(array(
                'message' => 'Description is required'
                    ))
        ));
        $this->add($description);

        $sales_desc = new Text("sales_desc");
        $sales_desc->setLabel("Para Punto de Ventas");
        $sales_desc->setFilters(array('striptags', 'string'));
        $sales_desc->addValidators(array(
            new PresenceOf(array(
                'message' => 'La Descripcion para ventas es necesaria'
                    ))
        ));
        $this->add($sales_desc);

        $sales_price = new Numeric("sales_price");
        $sales_price->setLabel("Precio de Venta");
        $sales_price->addValidators(array(
            new PresenceOf(array(
                'message' => 'El precio de venta debe ser ingresado'
                    ))
        ));
        $this->add($sales_price);

        $barcode = new Numeric("barcode");
        $barcode->setLabel("Codigo de Barras");
        $barcode->addValidators(array(
            new PresenceOf(array(
                'message' => 'No ha ingresado un codigo de barras'
                    ))
        ));
        $this->add($barcode);

        $itemstax = Itemsalestax::find([
                    "columns" => "ListID, ItemDesc",
        ]);

        $tipoIva = new Select(
                'tipoIva',
                $itemstax, [
                    'using' => [
                        'ListID',
                        'ItemDesc',
            ]
                ]
        );

        $this->add($tipoIva);
    }

    public function messages($nombre) {
        if ($this->hasMessagesFor($nombre)) {
            foreach ($this->getMessagesFor($nombre) as $mensaje) {
                $this->flash->error($mensaje);
            }
        }
    }

}
