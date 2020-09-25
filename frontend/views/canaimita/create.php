<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Equipo */

$this->title = 'Registrar Canaimita';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'estado'		=>	$estado,
        'municipio'		=>	$municipio,
        'parroquia'		=>	$parroquia,
        'estadoArray'       =>  $estadoArray,
        'municipioArray'    =>  $municipioArray,
        'parroquiaArray'    =>  $parroquiaArray,
        'sedeciat'		=>	$sedeciat,
        'insteduc'		=>	$insteduc,
        'representante'	=>	$representante,
        'estudiante'	=>	$estudiante,
        'niveleduc'		=>	$niveleduc,
        'equipo'		=>	$equipo,
        'fsoftware'		=>	$fsoftware,
        'fpantalla'		=>	$fpantalla,
        'ftarjetamadre'	=>	$ftarjetamadre,
        'fteclado'		=>	$fteclado,
        'fcarga'		=>	$fcarga,
        'fgeneral'		=>	$fgeneral,
    ]) ?>

</div>
