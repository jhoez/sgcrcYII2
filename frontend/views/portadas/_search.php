<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ImagenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imagen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idimag') ?>

    <?= $form->field($model, 'nombimg') ?>

    <?= $form->field($model, 'extension') ?>

    <?= $form->field($model, 'ruta') ?>

    <?= $form->field($model, 'tamanio') ?>

    <?php // echo $form->field($model, 'tipoimg') ?>

    <?php // echo $form->field($model, 'fkuser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
