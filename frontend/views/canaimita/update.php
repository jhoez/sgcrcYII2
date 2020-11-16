<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $equipo frontend\models\Equipo */

$this->title = 'Actualizar Canaimita';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Acualizar';
?>
<div class="canaimita-update">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center">Canaimita: <?= Html::encode($equipo->eqserial) ?></h1>

    <?= $this->render('_form', [
        'estado'        =>  $estado,
        'municipio'     =>  $municipio,
        'parroquia'     =>  $parroquia,
        'estadoArray'        =>  $estadoArray,
        'municipioArray'     =>  $municipioArray,
        'parroquiaArray'     =>  $parroquiaArray,
        'sedeciat'      =>  $sedeciat,
        'insteduc'      =>  $insteduc,
        'representante' =>  $representante,
        'estudiante'    =>  $estudiante,
        'niveleduc'     =>  $niveleduc,
        'equipo'        =>  $equipo,
        'fsoftware'     =>  $fsoftware,
        'fpantalla'     =>  $fpantalla,
        'ftarjetamadre' =>  $ftarjetamadre,
        'fteclado'      =>  $fteclado,
        'fcarga'        =>  $fcarga,
        'fgeneral'      =>  $fgeneral,
        'arraynivel'            =>  $arraynivel,
        'arrayversequipo'       =>  $arrayversequipo,
        'arrayfsoftware'        =>  $arrayfsoftware,
        'arrayfpantalla'        =>  $arrayfpantalla,
        'arrayftarjetamadre'    =>  $arrayftarjetamadre,
        'arrayfteclado'         =>  $arrayfteclado,
        'arrayfcarga'           =>  $arrayfcarga,
        'arrayfgeneral'         =>  $arrayfgeneral,
    ]) ?>

</div>
