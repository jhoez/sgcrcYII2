<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MultimediaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="multimedia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idmult') ?>

    <?= $form->field($model, 'nombmult') ?>

    <?= $form->field($model, 'extension') ?>

    <?= $form->field($model, 'tipomult') ?>

    <?= $form->field($model, 'tamanio') ?>

    <?php // echo $form->field($model, 'ruta') ?>

    <?php // echo $form->field($model, 'fkidpro') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
