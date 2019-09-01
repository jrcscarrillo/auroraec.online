<?php

/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Sign In');
        parent::initialize();
    }

    public function indexAction() {

        $form = new SessionForm;

        if ($this->request->isPost()) {

            if ($form->isValid($this->request->getPost()) != false) {

                if ($form->getMessages()) {
                    foreach ($form->getMessages() as $message) {
                        $this->flash->error((string) $message);
                    }
                }
            }
        }

        $this->view->form = $form;
    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function _registerSession(Users $user) {
        $this->session->set('auth', array(
            'id' => $user->id,
            'username' => $user->username,
            'tipo' => $user->tipo,
            'tipoId' => $user->tipoId,
            'numeroId' => $user->numeroId,
            'email' => $user->email,
            'qbid' => $user->qbid,
            'name' => $user->name
        ));
    }

    /**
     * This action authenticate and logs an user into the application
     *
     */
    public function startAction() {

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = Users::findFirst(array(
                    "(email = :email: OR username = :email:) AND password = :password: AND active = 'Y'",
                    'bind' => array('email' => $email, 'password' => sha1($password))
        ));
        if ($user) {
            $this->_registerSession($user);
            $this->flash->success('Welcome ' . $user->name);
            $ticket = Aticket::findFirst(array(
                        "Estado = :estado:",
                        "bind" => array("estado" => "GRABADO")
            ));
            if ($ticket) {
                $this->session->set('pendiente', array(
                    "estado" => "GRABADO",
                    "RefNumber" => $ticket->getTxnID()
                ));
            }
//                $caja = Cashier::findFirst(array(
//                            "Estado = :estado:",
//                            "bind" => array("estado" => "ABIERTO")
//                ));
//                if ($caja) {
//                    $this->session->set('cajaabierta', array(
//                        "estado" => "ABIERTO",
//                        "RefNumber" => $caja->getRefNumber()
//                    ));
//                }
            return $this->dispatcher->forward(
                            [
                                "controller" => "contribuyente",
                                "action" => "index",
                            ]
            );
        }

//        $this->flash->error('No existen ni la direccion de correo ni la palabra clave - Vuelva ha intentarlo');
        return $this->dispatcher->forward(
                        [
                            "controller" => "session",
                            "action" => "index",
                        ]
        );
    }

    /**
     * Finishes the active session redirecting to the index
     *
     * @return unknown
     */
    public function endAction() {
        $this->session->remove('auth');
        $this->session->remove('ruc');
        $this->session->remove('contribuyente');
        $this->session->remove('pendiente');
        $this->flash->success('Hasta Luego!');
        session_destroy();

        return $this->dispatcher->forward(
                        [
                            "controller" => "home",
                            "action" => "index",
                        ]
        );
    }

}
