<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Realaum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="realaum-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nra')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'exten')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fk_pro')->textInput() ?>

    <?= $form->field($model, 'fkimag')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
