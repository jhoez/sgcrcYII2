<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Formato */
/* @var $form yii\widgets\ActiveForm */
$elementos = array(
    'estadistica'	=>	'Estadistica',
    'planificacion'	=>	'Actividades Planificadas',
    'inventario'	=>	'Inventario Tecnologico',
    'acta'			=>	'Acta'
);

?>

<div class="row clearfix">
    <div class="col-md-6 col-md-offset-3">
        <div class="subir-form">
            <?php $form = ActiveForm::begin([
                'method'=>'post',
                'options'=>['enctype' => 'multipart/form-data']
            ]); ?>

            <div class="form-group">
                <?= Html::label('Opcion del formato', 'opcion', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $archivos,'opcion',
                        $elementos,
                        [
                            'prompt' => '---- Seleccione ----',
                            'class' => 'form-control imput-md',
                        ]
                    )?>
                </div>
            </div>

            <!-- MOSTRAR ESTE CAMPO SOLO SI ES ADMINISTRADOR -->
            <?php if (Yii::$app->user->identity->username == 'jhon'): ?>
                <div class="form-group">
                    <?= Html::label('¿Es un acta?', 'statusacta', ['class'=>'']) ?>
                    <div class="">
                        <?= Html::activeCheckbox($archivos, 'statusacta', ['label'=>'¡Si! o ¡No!']) ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <div class="">
                    <?= $form->field($archivos, 'ftutor')->fileInput(); ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Subir Archivo', ['class' => 'btn btn-success']) ?>
                <?= Html::resetButton('Limpiar', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
