<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Inicio', ['index'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row clearfix">
        <div class="col-offset-3">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="form-group">
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'email') ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'cedula') ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'cbit') ?>
            </div>
            <div class="form-group">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
