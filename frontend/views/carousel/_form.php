<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Imagen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row clearfix">
    <div class="col-md-6 col-md-offset-3">
        <div class="img-form">
            <?php $form = ActiveForm::begin(); ?>
            <div class="form-group">
                <?= $form->field($carousel, 'imagen')->fileInput(['maxlength' => true]) ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Subir img', ['class' => 'btn btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
