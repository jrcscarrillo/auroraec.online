<?php

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin as Pegado;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Pegado {

    public function getAcl() {

        $acl = new AclList();

        $acl->setDefaultAction(Acl::DENY);

        // Register roles
        $roles = array(
            'users' => new Role(
                    'Users', 'Member privileges, granted after sign in.'
            ),
            'guests' => new Role(
                    'Guests', 'Anyone browsing the site who is not signed in is considered to be a "Guest".'
            )
        );

        foreach ($roles as $role) {
            $acl->addRole($role);
        }

        //Private area resources
        $privateResources = array(
            'appliedtosync' => array('index', 'new', 'create', 'edit', 'save', 'delete', 'search'),
            'bodegas' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'bonificadetalle' => array('index', 'imprimir', 'facturar'),
            'codetype' => array('index', 'new', 'create', 'edit', 'save', 'delete', 'search'),
            'contact' => array('index', 'send'),
            'contribuyente' => array('index', 'search', 'new', 'create', 'delete', 'setup', 'seleccion', 'save'),
            'creditmemo' => array('index', 'search', 'autorizar', 'edit', 'save', 'create', 'impresion', 'firmar'),
            'creditodb' => array('index', 'acreditar', 'productos', 'valores', 'descuentos', 'impresion', 'revisar', 'firmar', 'autorizar', 'verificar'),
            'customer' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'driver' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'facturas' => array('index', 'search', 'sincronizar'),
            'guia' => array('index', 'search', 'autorizar', 'impresion', 'firmar'),
            'guiacab' => array('index', 'search', 'productos', 'masproductos', 'delproducto', 'aprobar', 'new', 'edit', 'save', 'create', 'delete', 'autorizar', 'impresion', 'firmar'),
            'guiasdb' => array('index', 'cabecera', 'create', 'aprobar', 'porcliente', 'factura', 'search', 'productos', 'masproductos', 'delproducto', 'facturar', 'impresion'),
            'inventario' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'invoice' => array('index', 'search', 'autorizar', 'edit', 'save', 'create', 'impresion', 'firmar'),
            'items' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'itemsislas' => array('index', 'search', 'seleccion', 'noseleccion', 'nuevo', 'antiguo'),
            'licencia' => array('index', 'search', 'setup', 'seleccion', 'new', 'create', 'delete', 'edit', 'save'),
            'lotesdetalle' => array('index', 'search', 'procesar', 'cerrar', 'saveproduccion', 'imprimir'),
            'lotestrx' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'lotestrxcab' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete', 'disponible', 'calcular', 'imprimir'),
            'modelos' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'notacredito' => array('index', 'search', 'sincronizar'),
            'pagosdb' => array('index', 'cabecera', 'pasada', 'opciondb', 'porcliente', 'factura' . 'search', 'productos', 'masproductos', 'delproducto', 'facturar', 'impresion'),
            'pedidos' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'pedidostmp' => array('indexventas', 'searchventas', 'pasaventas', 'newventas', 'editventas', 'saveventas', 'aprobarventas', 'deleteventas', 'corregir', 'eliminar'),
            'products' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'reporteinventarios' => array('index', 'imprimir', 'movbodega', 'movproducto', 'movtrx', 'movinicial', 'movtransferencia'),
            'reportepedidos' => array('index', 'imprimir', 'totalmensual', 'totalrep', 'totalitem', 'repmensual', 'itemmensual'),
            'reporteproduccion' => array('index', 'imprimir', 'acumuladomensual', 'listaproducto', 'listaordenes', 'lista', 'itemmensual'),
            'route' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'ruta' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'syncronizain' => array('index', 'seguir', 'procesar'),
            'syncronizaout' => array('index', 'seguir', 'procesar'),
            'users' => array('index', 'search', 'edit', 'delete'),
            'vehicle' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'vendor' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
            'vendorcredit' => array('indexventas', 'searchventas'),
            'ventas' => array('index', 'cabecera', 'factura' . 'search', 'productos', 'masproductos', 'delproducto', 'aprobar', 'new', 'edit', 'save', 'create', 'delete', 'facturar', 'pagar', 'seguir', 'impresion', 'cliente', 'inout', 'close', 'aprobarcaja', 'cerrarcaja', 'cerrar', 'imprimecaja'),
            'ventasdb' => array('index', 'cabecera', 'pasada', 'opciondb', 'porcliente', 'factura' . 'search', 'productos', 'masproductos', 'delproducto', 'facturar', 'impresion'),
        );
        foreach ($privateResources as $resource => $actions) {
            $acl->addResource(new Resource($resource), $actions);
        }

        //Public area resources
        $publicResources = array(
            'index' => array('index'),
            'home' => array('index'),
            'about' => array('index'),
            'register' => array('index'),
            'registrar' => array('index'),
            'errors' => array('show401', 'show404', 'show500', 'shownolicencia', 'shownoruc', 'showexpirada'),
            'session' => array('index', 'register', 'start', 'end'),
            'contact' => array('index', 'send')
        );
        foreach ($publicResources as $resource => $actions) {
            $acl->addResource(new Resource($resource), $actions);
        }

        //Grant access to public areas to both users and guests
        foreach ($roles as $role) {
            foreach ($publicResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow($role->getName(), $resource, $action);
                }
            }
        }

        //Grant access to private area to role Users
        foreach ($privateResources as $resource => $actions) {
            foreach ($actions as $action) {
                $acl->allow('Users', $resource, $action);
            }
        }

        //The acl is stored in session, APC would be useful here too
        $this->persistent->acl = $acl;

        return $this->persistent->acl;
    }

    public function beforeDispatch(Event $event, Dispatcher $dispatcher) {

        $auth = $this->session->get('auth');
        if (!$auth) {
            $role = 'Guests';
        } else {
            $role = 'Users';
        }

        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        $acl = $this->getAcl();

        if (!$acl->isResource($controller)) {
            $dispatcher->forward([
                'controller' => 'errors',
                'action' => 'show404'
            ]);

            return false;
        }

        $allowed = $acl->isAllowed($role, $controller, $action);
        if (!$allowed) {
            $dispatcher->forward(array(
                'controller' => 'errors',
                'action' => 'show401'
            ));
            $this->session->destroy();
            return false;
        }
    }

}
