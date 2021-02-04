<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>
<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
        <div class="canaimita-form">
            <?php $form = ActiveForm::begin([
                'id'=>'formulario',
                'enableClientValidation'=>true,
                'options'=>['class' => '']
                //'enableAjaxValidation' => true,
            ]);?>

            <h3 class="text-center">Dirección</h3>
            <hr>
            <div class="form-group">
                <div class="">
                    <!-- , ['inputOptions'=>[ 'class'=>'form-control']] -->
                    <?= $form->field($estado,'idesta')->dropDownList(
                        ArrayHelper::map($estadoArray, 'idesta', 'nombest'),
                        [
                            'prompt' => '---- Seleccione ----',
                            'class' => 'form-control imput-md',
                            'onchange'=>
                            '$.get("'.Url::toRoute('canaimita/muncall').'",{ id: $(this).val() })
                            .done(
                                function( data ) {
                                    $( "#'.Html::getInputId($municipio,'idmunc').'" ).html( data );
                                }
                            );'
                        ]
                    ); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($municipio,'idmunc')->dropDownList(
                        ArrayHelper::map($municipioArray, 'idmunc', 'municipio'),
                        [
                            'prompt' => '---- Seleccione ----',
                            'class' => 'form-control input-md',
                            'onchange'=>
                                '$.get("'.Url::toRoute('canaimita/parrall').'",{ id: $(this).val() } )
                                .done(
                                    function( data ) {
                                        $( "#'.Html::getInputId($parroquia,'idpar').'" ).html( data );
                                    }
                                );'
                        ]
                    )?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($parroquia,'idpar')->dropDownList(
                        ArrayHelper::map($parroquiaArray, 'idpar', 'parroquia'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control input-md']
                    )?>
                </div>
            </div>

            <h3 class="text-center">Institutos</h3>
            <hr>
            <div class="form-group">
                <div class="">
                    <?= $form->field($sedeciat, 'sede')->textInput() ?>
                </div>
            </div>
            <!------------------------------------------------------------------------->
            <!-- DATOS DEL INSTITUTO -->
            <div class="form-group">
                <div class="">
                    <?= $form->field($insteduc, 'nombinst')->textInput() ?>
                </div>
            </div>
            <!------------------------------------------------------------------------->
            <!-- DATOS DEL REPRESENTATE -->
            <h3 class="text-center">Representante o Docente</h3>
            <hr>
            <div class="form-group">
                <div class="">
                    <?= $form->field($representante, 'nombre')->textInput() ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($representante, 'cedula')->textInput() ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($representante, 'telf')->textInput() ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('¿Es Docente?', 'docente', ['class'=>'']) ?>
                <div class="">
                    <?= Html::activeCheckbox($representante, 'docente', ['label'=>'¡Si! o ¡No!']) ?>
                </div>
            </div>
            <!-- DATOS DEL ESTUDIANTE -->
            <h3 class="text-center">Estudiante</h3>
            <hr>
            <div class="form-group">
                <div class="">
                    <?= $form->field($estudiante, 'nombestu')->textInput() ?>
                </div>
            </div>
            <!------------------------------------------------------------------------->
            <!-- NIVEL EDUCATIVO -->
            <div class="form-group">
                <div class="">
                    <?= $form->field($niveleduc,'nivel')->dropDownList(
                        ArrayHelper::map($arraynivel,'nombcata','nombcata'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('¿Esta Graduado?', 'graduado', ['class'=>'']) ?>
                <div class="">
                    <?= Html::activeCheckbox($niveleduc, 'graduado', ['label'=>'¡Si! o ¡No!']) ?>
                </div>
            </div>
            <!------------------------------------------------------------------------->
            <!-- DATOS DEL EQUIPO -->
            <h3 class="text-center">Datos del Equipo</h3>
            <div class="form-group">
                <div class="">
                    <?= $form->field($equipo,'eqversion')->dropDownList(
                        ArrayHelper::map($arrayversequipo,'nombcata','nombcata'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($equipo, 'eqserial')->textInput() ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::label('Estatus de Equipo', 'eqstatus', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $equipo,'eqstatus',
                        [
                            'operativo'     =>  'Operativo',
                            'inoperativo'   =>  'Inoperativo'
                        ],
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($equipo, 'diagnostico')->textarea(['style'=>['resize'=>'none']]) ?>
                </div>
            </div>
            <div class="form-group">
                <div class="">
                    <?= $form->field($equipo, 'observacion')->textarea(['style'=>['resize'=>'none']]) ?>
                </div>
            </div>
            <!------------------------------------------------------------------------->
            <h3 class="text-center">Fallas</h3>
            <hr>
            <!-- FALLA DE SOFTWARE -->
            <div class="form-group">
                <div class="">
                    <?= $form->field($fsoftware,'fsoft')->dropDownList(
                        ArrayHelper::map($arrayfsoftware,'nombcata','nombcata'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>
            <!-- FALLA DE PANTALLA -->
            <div class="form-group">
                <div class="">
                    <?= $form->field($fpantalla,'fpant')->dropDownList(
                        ArrayHelper::map($arrayfpantalla,'nombcata','nombcata'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>
            <!-- FALLA DE TARJETAMADRE -->
            <div class="form-group">
                <div class="">
                    <?= $form->field($ftarjetamadre,'ftarj')->dropDownList(
                        ArrayHelper::map($arrayftarjetamadre,'nombcata','nombcata'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>
            <!-- FALLA DE TECLADO -->
            <div class="form-group">
                <div class="">
                    <?= $form->field($fteclado,'ftec')->dropDownList(
                        ArrayHelper::map($arrayfteclado,'nombcata','nombcata'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>
            <!-- FALLA DE CARGA -->
            <div class="form-group">
                <div class="">
                    <?= $form->field($fcarga,'fcarg')->dropDownList(
                        ArrayHelper::map($arrayfcarga,'nombcata','nombcata'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>
            <!-- FALLA GENERAL -->
            <div class="form-group">
                <div class="">
                    <?= $form->field($fgeneral,'fgen')->dropDownList(
                        ArrayHelper::map($arrayfgeneral,'nombcata','nombcata'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton($equipo->isNewRecord ? 'Registrar Canaimita' : 'Actualizar Canaimita', ['class' => 'btn btn-success']) ?>
                <?= Html::button('Cancelar',['class' => 'btn btn-danger','onclick' => 'js:document.location.href="canaimita/index"']);?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
