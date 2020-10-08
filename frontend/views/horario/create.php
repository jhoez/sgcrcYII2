<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Asistencia */

$this->title = 'Registrar Asistencia';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = ['label' => 'Asistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Asistencias registradas', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Canaimitas regitradas', ['canaimita/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= $this->render('_form', [
        'horario' => $horario,
        'horaE'     => $horaE,
        'horaS'     => $horaS,
        'lhoraE'    => $lhoraE,
        'lhoraS'    => $lhoraS
    ]) ?>

</div>
