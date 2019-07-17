<?php

/**
 * Description of RegisterController
 *
 * @author jrcsc
 */
class RegisterController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Sign Up/Sign In');
        parent::initialize();
    }

    /**
     * Action to register a new user
     */
    public function indexAction() {
        $form = new RegistrarteForm;

        if ($this->request->isPost()) {
            if (!$form->isValid($this->request->getPost())) {

                if ($form->getMessages()) {
                    foreach ($form->getMessages() as $message) {
//                        $this->flash->error((string) $message);
                    }
                }
            } else {

                $user = new Users();
                $user->tipoId = $this->request->getPost('tipoId');
                $user->tipo = $this->request->getPost('tipo');
                $user->numeroId = $this->request->getPost('numeroId');
                $user->username = $this->request->getPost('username');
                $password = $this->request->getPost('password');
                
                $user->password = sha1($password);
                $user->name = $this->request->getPost('name');
                $user->email = $this->request->getPost('email');
                $qbid = $_SESSION['quickbooksid'];
                $user->qbid = $qbid;
                $user->created_at = new Phalcon\Db\RawValue('now()');
                $user->active = 'Y';

                if (!$user->save()) {
                    foreach ($user->getMessages() as $message) {
                        $this->flash->error((string) $message);
                    }
                } else {
                    $this->tag->setDefault('email', '');
                    $this->tag->setDefault('password', '');
                    $this->flash->success('Gracias por registrarse a vuelta de correo usted recibira la notificacion de que su cuenta esta habilitada');
                    $part = '<p>Gracias por registrarse a vuelta de correo usted recibira la notificacion de que su cuenta esta habilitada</p>';
                    $paraemail['part'] = $part;
                    $paraemail['body'] = $part;
                    $paraemail['subject'] = 'LOS COQUEIROS - Usuario Registrado';
                    $paraemail['fromemail']['email'] = 'xavierbustos@loscoqueiros.com';
                    $paraemail['fromemail']['nombre'] = 'Heladerias Cofrunat Cia. Ltda.';
                    $paraemail['toemail']['email'] = $this->email;
                    $paraemail['toemail']['nombre'] = $this->name;
                    $paraemail['bccemail']['email'] = 'ventas@loscoqueiros.com';
                    $paraemail['bccemail']['nombre'] = 'Ventas';
                    $exp = $this->sendmail->enviaEmail($paraemail);
                    return $this->dispatcher->forward(
                                    [
                                        "controller" => "session",
                                        "action" => "index",
                                    ]
                    );
                }
            }
        }

        $this->view->form = $form;
    }

}
