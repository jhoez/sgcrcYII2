<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Equipo */

$this->title = 'Registrar Canaimita';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="canaimita-create">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Crear Reportes',['reportespdf'],['class'=>'btn btn-primary']);?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

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
