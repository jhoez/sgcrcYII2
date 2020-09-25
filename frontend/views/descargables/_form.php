<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Formato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="formato-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'opcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extens')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tamanio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_at')->textInput() ?>

    <?= $form->field($model, 'update_at')->textInput() ?>

    <?= $form->field($model, 'fkuser')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
