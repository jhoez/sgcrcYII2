<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Realaum */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
        <div class="rea-form">

            <?php $form = ActiveForm::begin([
                'id'=>'raform',
                'enableClientValidation'=>true,
                //'enableAjaxValidation' => true,
                'options'=>['enctype' => 'multipart/form-data']
            ]); ?>

            <div class="form-group">
                <div class="">
                    <?= $form->field($proyecto, 'nombpro')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($proyecto, 'creador')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($proyecto, 'colaboracion')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($proyecto, 'descripcion')->textInput(['maxlength' => true]) ?>
                </div>
            </div>

            <div class="form-group">
                <?php if (!$imag->isNewRecord) {?>
        			<div class="row">
                        <?php echo "Imagen a cambiar: " . $imag->nombimg;?>
        			</div>
        		<?php } ?>
                <div class="">
                    <?= $form->field($imag, 'imagen')->fileInput() ?>
                </div>
            </div>

            <div class="form-group">
                <?php if (!$realidadaumentada->isNewRecord) {?>
        			<div class="row">
                        <?php	echo "Patron de Realidad Aumentada a ser reemplazado: " . $realidadaumentada->nra;?>
        			</div>
        		<?php } ?>
                <div class="">
                    <?= $form->field($realidadaumentada, 'fileglb')->fileInput() ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Subir proyecto', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
