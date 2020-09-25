<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\LibrosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="libros-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idlib') ?>

    <?= $form->field($model, 'nomblib') ?>

    <?= $form->field($model, 'extension') ?>

    <?= $form->field($model, 'ruta') ?>

    <?= $form->field($model, 'coleccion') ?>

    <?php // echo $form->field($model, 'nivel') ?>

    <?php // echo $form->field($model, 'tamanio') ?>

    <?php // echo $form->field($model, 'idfkimag') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
