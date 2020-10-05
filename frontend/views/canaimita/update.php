<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $equipo frontend\models\Equipo */

$this->title = 'Actualizar Canaimita';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Acualizar';
?>
<div class="equipo-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Canaimitas registradas', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>

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
