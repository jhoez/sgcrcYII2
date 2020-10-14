<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Asistencia */
/* @var $form yii\widgets\ActiveForm */
$hora	= date("h:i:s",time());
?>

<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
        <div class="asistencia-form">
            <h1 class="text-center">Marque su asistencia</h1>
            <?php
            $form = ActiveForm::begin();
            if ($hora >= $horaE && $hora <= $lhoraE) {
                echo Html::activeHiddenInput($horario,'horain',['value'=>$hora]);
            } elseif($hora >= $horaS && $hora <= $lhoraS) {
                echo Html::activeHiddenInput($horario,'horaout',['value'=>$hora]);
            }
            ?>

            <?php if ( $hora >= $horaS && $hora <= $lhoraS ): ?>
                <?= $form->field($horario, 'observacion')->textarea(['rows' => 6,'style'=>['resize'=>'none']]) ?>
            <?php endif; ?>

            <div class="form-group">
                <?php if ( $hora >= $horaE && $hora <= $lhoraE ): ?>
                    <?= Html::submitButton('Registrar Entrada', ['class' => 'btn btn-success']) ?>
                <?php elseif($hora >= $horaS && $hora <= $lhoraS): ?>
                    <?= Html::a('Registrar Salida', ['create','ms'=>'hs'], [
                        'class' => 'btn btn-success',
                        'data' => [
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php endif; ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
