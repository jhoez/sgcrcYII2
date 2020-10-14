<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Multimedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row clearfix">
    <div class="col-md-6 col-md-offset-3">
        <div class="prodig-form">
            <?php $form = ActiveForm::begin([
                'method'=>'post',
                'options'=>['enctype' => 'multipart/form-data']
            ]); ?>

            <div class="form-group">
                <div class="">
                    <?= $form->field($proyecto, 'nombpro')->textInput() ?>
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <?= $form->field($proyecto, 'creador')->textInput() ?>
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <?= $form->field($proyecto, 'colaboracion')->textInput() ?>
                </div>
            </div>

            <div class="form-group">
                <div class="">
                    <?= $form->field($proyecto, 'descripcion')->textarea(['style'=>['resize'=>'none']]) ?>
                </div>
            </div>

            <div class="form-group">
                <?php	if (!$multimedia->isNewRecord) {?>
        			<div class="">
        					<?php	echo "$multimedia->tipomult a reemplazar: " . $multimedia->nombmult;?>
        			</div>
        		<?php } ?>
                <div class="">
                    <?= $form->field($multimedia, 'mva')->fileInput(); ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Subir Multimedia', ['class' => 'btn btn-success']) ?>
                <?= Html::resetButton('Limpiar', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
