<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RealaumSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="realaum-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idra') ?>

    <?= $form->field($model, 'nra') ?>

    <?= $form->field($model, 'exten') ?>

    <?= $form->field($model, 'ruta') ?>

    <?= $form->field($model, 'fk_pro') ?>

    <?php // echo $form->field($model, 'fkimag') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
