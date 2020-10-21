<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
        <div class="us-form">
            <?php $form = ActiveForm::begin(); ?>
            <div class="form-group">
                <div class="">
                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($model, 'cedula')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($model, 'cbit')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Crear Usuario', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>
</div>
