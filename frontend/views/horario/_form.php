<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Asistencia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="asistencia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fkuser')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'horain')->textInput() ?>

    <?= $form->field($model, 'horaout')->textInput() ?>

    <?= $form->field($model, 'observacion')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
