<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Equipo */

$this->title = 'Update Equipo: ' . $model->ideq;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ideq, 'url' => ['view', 'id' => $model->ideq]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="equipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
