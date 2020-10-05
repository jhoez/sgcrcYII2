<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Asistencia */

$this->title = 'Actualizar Asistencia: ' . $model->idasis;
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = ['label' => 'Asistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idasis, 'url' => ['view', 'id' => $model->idasis]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="asistencia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
