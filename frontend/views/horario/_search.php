<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\AsistenciaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asistencia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idasis') ?>

    <?= $form->field($model, 'fkuser') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'horain') ?>

    <?= $form->field($model, 'horaout') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
