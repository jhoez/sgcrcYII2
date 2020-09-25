<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\EquipoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ideq') ?>

    <?= $form->field($model, 'eqserial') ?>

    <?= $form->field($model, 'frecepcion') ?>

    <?= $form->field($model, 'fentrega') ?>

    <?= $form->field($model, 'eqversion') ?>

    <?php // echo $form->field($model, 'eqstatus') ?>

    <?php // echo $form->field($model, 'idrep') ?>

    <?php // echo $form->field($model, 'diagnostico') ?>

    <?php // echo $form->field($model, 'observacion') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
