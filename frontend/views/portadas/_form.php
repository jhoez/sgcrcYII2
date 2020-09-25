<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Imagen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imagen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombimg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tamanio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipoimg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fkuser')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
