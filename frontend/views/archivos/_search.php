<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $archivos frontend\models\FormatoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="archivo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($archivos, 'idf') ?>

    <?= $form->field($archivos, 'opcion') ?>

    <?= $form->field($archivos, 'nombf') ?>

    <?= $form->field($archivos, 'extens') ?>

    <?= $form->field($archivos, 'ruta') ?>

    <?php // echo $form->field($archivos, 'tamanio') ?>

    <?php // echo $form->field($archivos, 'status') ?>

    <?php // echo $form->field($archivos, 'create_at') ?>

    <?php // echo $form->field($archivos, 'update_at') ?>

    <?php // echo $form->field($archivos, 'fkuser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
