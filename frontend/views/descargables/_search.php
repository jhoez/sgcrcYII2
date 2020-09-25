<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FormatoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="formato-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idf') ?>

    <?= $form->field($model, 'opcion') ?>

    <?= $form->field($model, 'nombf') ?>

    <?= $form->field($model, 'extens') ?>

    <?= $form->field($model, 'ruta') ?>

    <?php // echo $form->field($model, 'tamanio') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'create_at') ?>

    <?php // echo $form->field($model, 'update_at') ?>

    <?php // echo $form->field($model, 'fkuser') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
