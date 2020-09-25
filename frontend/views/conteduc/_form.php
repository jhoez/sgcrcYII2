<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Libros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="libros-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomblib')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'extension')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ruta')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coleccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nivel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tamanio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idfkimag')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
