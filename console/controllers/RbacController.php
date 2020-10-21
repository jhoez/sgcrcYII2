<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

/**
 * @class RbacController
 */
class RbacController extends Controller
{
    // ejecutar el comando php yii rbac/init
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        // CREACIÓN DE PERMISOS
        $permisosuperadmin = $auth->createPermission('permisoSuperadmin');
        $auth->add($permisosuperadmin);
        $permisoadministrador = $auth->createPermission('permisoAdministrador');
        $auth->add($permisoadministrador);
        $permisotutor = $auth->createPermission('permisoTutor');
        $auth->add($permisotutor);

        // CREACIÓN DE ROLES
        // ROLE "superadmin" y le asigna el permiso "permisoSuperadmin"
        $superadmin = $auth->createRole('superadmin');
        $auth->add($superadmin);
        $auth->addChild($superadmin, $permisosuperadmin);
        // ROLE "administrador" y le asigna el permiso "permisoAdministrador"
        $administrador = $auth->createRole('administrador');
        $auth->add($administrador);
        $auth->addChild($administrador, $permisoadministrador);
        // ROLE "funcionario" y le asigna el permiso "permisoFuncionario"
        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);
        $auth->addChild($funcionario, $permisofuncionario);

        // ASIGNACION DE ROLES POR IDs devuelto por IdentityInterface::getId()
        $auth->assign($superadmin, 1);
        $auth->assign($administrador, 2);
        $auth->assign($tutor, 3);
    }
}


?>
