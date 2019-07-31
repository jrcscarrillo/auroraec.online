<?php


use Phalcon\Validation as validador;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\ValidatorInterface;

class ValidaIgualValidator extends Validator implements ValidatorInterface {

    /**
     *
     * @param  Validation $validator
     * @param  string $attribute
     *
     * @return boolean
     */
    public function validate(Phalcon\Validation $validator, $attribute) {
        //obtain the name of the field 
        $tipo = $this->getOption("tipo");
        $tipoId = $this->getOption("tipoId");

        //obtain field value
        $valor_tipo = $validator->getValue($tipo);
        $valor_tipoId = $validator->getValue($tipoId);

        // obtain the input field value
        $value = $validator->getValue($attribute);

        //try to obtain message defined in a validator
        $message = $this->getOption('message');

        //check if the value is valid
        if ($valor_tipo == 'EMPLEADO') { // empleado
            $usuarios = Employee::find(
                            [
                                "conditions" => "AccountNumber = ?1",
                                "bind" => [
                                    1 => $value
                                ]
                            ]
            );
        } elseif ($valor_tipo == 'CLIENTE') { // cliente
            $usuarios = Customer::find(
                            [
                                "conditions" => "AccountNumber = ?1",
                                "bind" => [
                                    1 => $value
                                ]
                            ]
            );
        } elseif ($valor_tipo == 'PROVEEDOR') { // proveedor
            $usuarios = Vendor::find(
                            [
                                "conditions" => "AccountNumber = ?1",
                                "bind" => [
                                    1 => $value
                                ]
                            ]
            );
        }
        if (!$usuarios) {
            $message = 'No existe este empleado, o cliente, o proveedor en nuestra base de datos';
            $validator->appendMessage(new Message($message, $attribute, 'basededatos'));
        } else {
            foreach ($usuarios as $quickbooks) {
                $_SESSION['quickbooksid'] =  $quickbooks->ListID;
            }
        }

        if (count($validator->getMessages())) {
            return false;
        }
        return true;
    }

}
