<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\db\Query;
use frontend\models\Usuario;

/**
 * @class RbacController
 */
class RbacController extends Controller
{
    // ejecutar el comando php yii rbac/init
    public function actionInit()
    {
        $usuario = new Usuario;
        $usuario->username = 'ACF';
        $usuario->generateAuthKey();
        $usuario->password = '4dm1nACF';
        $usuario->generatePasswordResetToken();
        $usuario->email = 'fundabit@gmail.com';
        $usuario->status = 1;
        $usuario->created_at = date( "Y-m-d h:i:s",time() );
        $usuario->generateEmailVerificationToken();
        $usuario->cedula = '12345678';
        $usuario->cbit = 'altagracia';
        if ( $usuario->save() ) {
            $auth = Yii::$app->authManager;
            // CREACIÓN DE PERMISOS
            $permisoadministrador = $auth->createPermission('permisoAdministrador');
            $auth->add($permisoadministrador);
            $permisotutor = $auth->createPermission('permisoTutor');
            $auth->add($permisotutor);

            // RUTAS A CONTROLLER
            $pathadmin = $auth->createPermission('/admin/*');//ADMIN
            $auth->add($pathadmin);
            $pathusuario = $auth->createPermission('/usuario/*');//USUARIO
            $auth->add($pathusuario);
            // RUTAS A CONTROLLER SITE
            $pathsite = $auth->createPermission('/site/*');
            $auth->add($pathsite);
            $pathsiteindex = $auth->createPermission('/site/index');
            $auth->add($pathsiteindex);
            $pathsitelogin = $auth->createPermission('/site/login');
            $auth->add($pathsitelogin);
            $pathsitelogout = $auth->createPermission('/site/logout');
            $auth->add($pathsitelogout);
            $pathsitecaptcha = $auth->createPermission('/site/captcha');
            $auth->add($pathsitecaptcha);
            $pathsiterequestpasswordreset = $auth->createPermission('/site/request-password-reset');
            $auth->add($pathsiterequestpasswordreset);
            $pathsiteresetpassword = $auth->createPermission('/site/reset-password');
            $auth->add($pathsiteresetpassword);
            $pathsiteverifyemail = $auth->createPermission('/site/verify-email');
            $auth->add($pathsiteverifyemail);
            $pathsiteresenverificationemail = $auth->createPermission('/site/resen-verification-email');
            $auth->add($pathsiteresenverificationemail);
            $pathsitemv = $auth->createPermission('/site/mv');
            $auth->add($pathsitemv);
            $pathsiteobj = $auth->createPermission('/site/obj');
            $auth->add($pathsiteobj);
            $pathsitev = $auth->createPermission('/site/v');
            $auth->add($pathsitev);

            // RUTA CONTENIDO EDUCATIVO
            $pathconteduc = $auth->createPermission('/conteduc/*');
            $auth->add($pathconteduc);
            $pathconteducindex = $auth->createPermission('/conteduc/index');
            $auth->add($pathconteducindex);
            $pathconteducverlib = $auth->createPermission('/conteduc/verlib');
            $auth->add($pathconteducverlib);
            $pathconteducregistros = $auth->createPermission('/conteduc/registros');
            $auth->add($pathconteducregistros);
            $pathconteducview = $auth->createPermission('/conteduc/view');
            $auth->add($pathconteducview);
            $pathconteduccreate = $auth->createPermission('/conteduc/create');
            $auth->add($pathconteduccreate);
            $pathconteducupdate = $auth->createPermission('/conteduc/update');
            $auth->add($pathconteducupdate);
            $pathconteducdesclib = $auth->createPermission('/conteduc/desclib');
            $auth->add($pathconteducdesclib);

            // RUTA PROYECTOS DIGITALES
            $pathprodig = $auth->createPermission('/prodig/*');
            $auth->add($pathprodig);
            $pathprodigindex = $auth->createPermission('/prodig/index');
            $auth->add($pathprodigindex);
            $pathprodigdescva = $auth->createPermission('/prodig/descva');
            $auth->add($pathprodigdescva);
            $pathprodigregistros = $auth->createPermission('/prodig/registros');
            $auth->add($pathprodigregistros);
            $pathprodigview = $auth->createPermission('/prodig/view');
            $auth->add($pathprodigview);
            $pathprodigcreate = $auth->createPermission('/prodig/create');
            $auth->add($pathprodigcreate);
            $pathprodigupdate = $auth->createPermission('/prodig/update');
            $auth->add($pathprodigupdate);
            $pathprodigverva = $auth->createPermission('/prodig/verva');
            $auth->add($pathprodigverva);

            // RUTA REALIDAD AUMENTADA
            $pathrea = $auth->createPermission('/rea/*');
            $auth->add($pathrea);
            $pathreaindex = $auth->createPermission('/rea/index');
            $auth->add($pathreaindex);
            $pathreara = $auth->createPermission('/rea/ra');
            $auth->add($pathreara);
            $pathreadescra = $auth->createPermission('/rea/descra');
            $auth->add($pathreadescra);
            $pathrearegrea = $auth->createPermission('/rea/regrea');
            $auth->add($pathrearegrea);
            $pathreaview = $auth->createPermission('/rea/view');
            $auth->add($pathreaview);
            $pathreacreate = $auth->createPermission('/rea/create');
            $auth->add($pathreacreate);
            $pathreaupdate = $auth->createPermission('/rea/update');
            $auth->add($pathreaupdate);

            // RUTA ARCHIVOS
            $patharchivos = $auth->createPermission('/archivos/*');
            $auth->add($patharchivos);
            $patharchivosindex = $auth->createPermission('/archivos/index');
            $auth->add($patharchivosindex);
            $patharchivosdescargarfa = $auth->createPermission('/archivos/descargarfa');
            $auth->add($patharchivosdescargarfa);
            $patharchivosview = $auth->createPermission('/archivos/view');
            $auth->add($patharchivosview);
            $patharchivoscreate = $auth->createPermission('/archivos/create');
            $auth->add($patharchivoscreate);

            // RUTA HORARIO
            $pathhorario = $auth->createPermission('/horario/*');
            $auth->add($pathhorario);
            $pathhorarioindex = $auth->createPermission('/horario/index');
            $auth->add($pathhorarioindex);
            $pathhorarioview = $auth->createPermission('/horario/view');
            $auth->add($pathhorarioview);
            $pathhorariocreate = $auth->createPermission('/horario/create');
            $auth->add($pathhorariocreate);

            // RUTA CAROUSEL
            $pathcarousel = $auth->createPermission('/carousel/*');
            $auth->add($pathcarousel);
            $pathcarouselindex = $auth->createPermission('/carousel/index');
            $auth->add($pathcarouselindex);
            $pathcarouselview = $auth->createPermission('/carousel/view');
            $auth->add($pathcarouselview);
            $pathcarouselcreate = $auth->createPermission('/carousel/create');
            $auth->add($pathcarouselcreate);
            $pathcarouselupdate = $auth->createPermission('/carousel/update');
            $auth->add($pathcarouselupdate);

            // RUTA GII
            $pathgii = $auth->createPermission('/gii/*');
            $auth->add($pathgii);

            // RUTA CANAIMITA
            $pathcanindex = $auth->createPermission('/canaimita/index');
            $auth->add($pathcanindex);
            $pathcanview = $auth->createPermission('/canaimita/view');
            $auth->add($pathcanview);
            $pathcancreate = $auth->createPermission('/canaimita/create');
            $auth->add($pathcancreate);
            $pathcanmuncall = $auth->createPermission('/canaimita/muncall');
            $auth->add($pathcanmuncall);
            $pathcanparrall = $auth->createPermission('/canaimita/parrall');
            $auth->add($pathcanparrall);
            $pathcanreportespdf = $auth->createPermission('/canaimita/reportespdf');
            $auth->add($pathcanreportespdf);
            $pathcanreportesfallas = $auth->createPermission('/canaimita/reportesfallas');
            $auth->add($pathcanreportesfallas);
            $pathcanmarcar = $auth->createPermission('/canaimita/marcar');//CONTENIDO EDUCATIVO
            $auth->add($pathcanmarcar);

            // RUTA A PERMISOADMINISTRADOR
            $auth->addChild($permisoadministrador,$pathadmin);
            $auth->addChild($permisoadministrador,$pathusuario);
            $auth->addChild($permisoadministrador,$pathsite);
            $auth->addChild($permisoadministrador,$pathconteduc);
            $auth->addChild($permisoadministrador,$pathprodig);
            $auth->addChild($permisoadministrador,$pathrea);
            $auth->addChild($permisoadministrador,$patharchivos);
            $auth->addChild($permisoadministrador,$pathhorario);
            $auth->addChild($permisoadministrador,$pathcarousel);
            $auth->addChild($permisoadministrador,$pathgii);
            // PERMISO DE RUTAS DE CANAIMITA
            $auth->addChild($permisoadministrador,$pathcanindex);
            $auth->addChild($permisoadministrador,$pathcanview);
            $auth->addChild($permisoadministrador,$pathcancreate);
            $auth->addChild($permisoadministrador,$pathcanmuncall);
            $auth->addChild($permisoadministrador,$pathcanparrall);
            $auth->addChild($permisoadministrador,$pathcanreportespdf);
            $auth->addChild($permisoadministrador,$pathcanreportesfallas);
            $auth->addChild($permisoadministrador,$pathcanmarcar);

            // RUTAS A PERMISOTUTOR
            $auth->addChild($permisotutor,$pathcanindex);
            $auth->addChild($permisotutor,$pathcanview);
            $auth->addChild($permisotutor,$pathcancreate);
            $auth->addChild($permisotutor,$pathcanmuncall);
            $auth->addChild($permisotutor,$pathcanparrall);
            $auth->addChild($permisotutor,$pathcanmarcar);
            // permiso para site
            $auth->addChild($permisotutor,$pathsiteindex);
            $auth->addChild($permisotutor,$pathsitelogin);
            $auth->addChild($permisotutor,$pathsitelogout);
            $auth->addChild($permisotutor,$pathsitecaptcha);
            $auth->addChild($permisotutor,$pathsiterequestpasswordreset);
            $auth->addChild($permisotutor,$pathsiteresetpassword);
            $auth->addChild($permisotutor,$pathsiteverifyemail);
            $auth->addChild($permisotutor,$pathsiteresenverificationemail);
            $auth->addChild($permisotutor,$pathsitemv);
            $auth->addChild($permisotutor,$pathsiteobj);
            $auth->addChild($permisotutor,$pathsitev);
            // permiso para conteduc
            $auth->addChild($permisotutor,$pathconteducindex);
            $auth->addChild($permisotutor,$pathconteducverlib);
            $auth->addChild($permisotutor,$pathconteducregistros);
            $auth->addChild($permisotutor,$pathconteducview);
            $auth->addChild($permisotutor,$pathconteduccreate);
            $auth->addChild($permisotutor,$pathconteducupdate);
            $auth->addChild($permisotutor,$pathconteducdesclib);
            // permiso para prodig
            $auth->addChild($permisotutor,$pathprodigindex);
            $auth->addChild($permisotutor,$pathprodigdescva);
            $auth->addChild($permisotutor,$pathprodigregistros);
            $auth->addChild($permisotutor,$pathprodigview);
            $auth->addChild($permisotutor,$pathprodigcreate);
            $auth->addChild($permisotutor,$pathprodigupdate);
            $auth->addChild($permisotutor,$pathprodigverva);
            // permiso para rea
            $auth->addChild($permisotutor,$pathreaindex);
            $auth->addChild($permisotutor,$pathreara);
            $auth->addChild($permisotutor,$pathreadescra);
            $auth->addChild($permisotutor,$pathrearegrea);
            $auth->addChild($permisotutor,$pathreaview);
            $auth->addChild($permisotutor,$pathreacreate);
            $auth->addChild($permisotutor,$pathreaupdate);
            // permiso para archivos
            $auth->addChild($permisotutor,$patharchivosindex);
            $auth->addChild($permisotutor,$patharchivosdescargarfa);
            $auth->addChild($permisotutor,$patharchivosview);
            $auth->addChild($permisotutor,$patharchivoscreate);
            // permiso para horario
            $auth->addChild($permisotutor,$pathhorarioindex);
            $auth->addChild($permisotutor,$pathhorarioview);
            $auth->addChild($permisotutor,$pathhorariocreate);
            // permiso para carousel
            $auth->addChild($permisotutor,$pathcarouselindex);
            $auth->addChild($permisotutor,$pathcarouselview);
            $auth->addChild($permisotutor,$pathcarouselcreate);
            $auth->addChild($permisotutor,$pathcarouselupdate);

            // CREACIÓN DE ROLES
            // ROLE "administrador" y le asigna el permiso "permisoAdministrador"
            $administrador = $auth->createRole('administrador');
            $auth->add($administrador);
            $auth->addChild($administrador, $permisoadministrador);
            // ROLE "funcionario" y le asigna el permiso "permisoTutor"
            $tutor = $auth->createRole('tutor');
            $auth->add($tutor);
            $auth->addChild($tutor, $permisotutor);

            // ASIGNACION DE ROLES POR IDs devuelto por IdentityInterface::getId()
            $auth->assign( $administrador, $usuario->getId() );
        }
    }
}


?>
