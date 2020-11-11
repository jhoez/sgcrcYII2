<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Asistencia */

$this->title = 'Registrar Asistencia';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = ['label' => 'Asistencia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistencia-create">

    <p>
        <?= Html::a('Asistencias registradas', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Canaimitas regitradas', ['canaimita/index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'horario' => $horario,
        'horaE'     => $horaE,
        'horaS'     => $horaS,
        'lhoraE'    => $lhoraE,
        'lhoraS'    => $lhoraS
    ]) ?>

</div>
