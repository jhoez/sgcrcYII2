<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Multimedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="multimedia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombmult')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipomult')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tamanio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fkidpro')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
