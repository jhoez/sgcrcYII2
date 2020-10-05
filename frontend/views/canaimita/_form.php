<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

?>

<div class="equipo-form">

    <?php $form = ActiveForm::begin([
        'id'=>'formulario',
        //'validationUrl'=>['canaimita/validarFormularioAjax'],
        'enableClientValidation'=>true,
        'enableAjaxValidation' => true,
    ]);?>

    <h3 class="text-center">Dirección</h3>
    <hr>
    <div class="form-group">
        <?= Html::label('Estados', 'idesta', ['class' => ''])?>
        <div class="">
            <?= Html::activeDropDownList(
                $estado,'idesta',
                ArrayHelper::map($estadoArray, 'idesta', 'nombest'),
                [
                    'prompt' => '---- Seleccione ----',
                    'class' => 'form-control imput-md',
                    'onchange'=>
                        '$.post(
                            "'.Yii::$app->urlManager->createUrl('canaimita/muncall?id=').'"+$(this).val(),
                            function( data ) {
                                $( "select#municipio-idmunc" ).html( data );
                            }
                        );'
                ]
            )?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::label('Municipio', 'idmunc', ['class' => ''])?>
        <div class="">
            <?= Html::activeDropDownList(
                $municipio,'idmunc',
                ArrayHelper::map($municipioArray, 'idmunc', 'municipio'),
                [
                    'prompt' => '---- Seleccione ----',
                    'class' => 'form-control imput-md',
                    'onchange'=>
                        '$.post(
                            "'.Yii::$app->urlManager->createUrl('canaimita/parrall?id=').'"+$(this).val(),
                            function( data ) {
                                $( "select#parroquia-idpar" ).html( data );
                            }
                        );'
                ]
            )?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::label('Parroquia', 'idpar', ['class' => ''])?>
        <div class="">
            <?= Html::activeDropDownList(
                $parroquia,'idpar',
                ArrayHelper::map($parroquiaArray, 'idpar', 'parroquia'),
                ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
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
        <?= Html::label('Nivel Educativo', 'nivel', ['class' => ''])?>
        <div class="">
            <?= Html::activeDropDownList(
                $niveleduc,'nivel',
                [
                    'primero'   =>  'primero',
                    'segundo'   =>  'segundo',
                    'tercero'   =>  'tercero',
                    'cuarto'    =>  'cuarto',
                    'quinto'    =>  'quinto',
                    'sexto'     =>  'sexto',
                    '1er año'   =>  '1er año',
                    '2do año'   =>  '2do año',
                    '3er año'   =>  '3er año',
                    '4to año'   =>  '4to año',
                    '5to año'   =>  '5to año',
                    '6to año'   =>  '6to año',
                ],
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
        <?= Html::label('Version de Equipo', 'eqversion', ['class' => ''])?>
        <div class="">
            <?= Html::activeDropDownList(
                $equipo,'eqversion',
                [
                    'V1'        => 'V1',
                    'V2'        => 'V2',
                    'V3'        => 'V3',
                    'V4'        => 'V4',
                    'V5'        => 'V5',
                    'V6'        => 'V6',
                    'Tablet'    => 'Tablet',
                ],
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
        <?= Html::label('Falla de Software', 'fsoft', ['class' => ''])?>
        <div class="">
            <?= Html::activeDropDownList(
                $fsoftware,'fsoft',
                [
                    'Actualizacion'     => 'Actualizacion',
                    'Posee windows'     => 'Posee windows',
                    'No carga el S.O'   => 'No carga el S.O',
                    'Revisar disco'     => 'Revisar disco',
                    'Grub rescue'       => 'Grub rescue',
                ],
                ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
            )?>
        </div>
    </div>
    <!-- FALLA DE PANTALLA -->
    <div class="form-group">
        <?= Html::label('Falla de Pantalla', 'fpant', ['class' => ''])?>
        <div class="">
            <?= Html::activeDropDownList(
                $fpantalla,'fpant',
                [
                    'Pantalla partida'                      => 'Pantalla partida',
                    'Pixelada'                              => 'Pixelada',
                    'Pantalla despegada'                    => 'Pantalla despegada',
                    'Pantalla de cristal líquido dañada'    => 'Pantalla de cristal líquido dañada',
                    'Flex dañado'                           => 'Flex dañado'
                ],
                ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
            )?>
        </div>
    </div>
    <!-- FALLA DE TARJETAMADRE -->
    <div class="form-group">
        <?= Html::label('Falla de Tarjeta madre', 'ftarj', ['class' => ''])?>
        <div class="">
            <?= Html::activeDropDownList(
                $ftarjetamadre,'ftarj',
                [
                    'Procesador dañado'         => 'Procesador dañado',
                    'Tarj de video dañada'      => 'Tarj de video dañada',
                    'Tarj de red dañada'        => 'Tarj de red dañada',
                    'Tarj de sonido dañada'     => 'Tarj de sonido dañada',
                    'Pila de bios'              => 'Pila de bios',
                    'Configuracion del bios'    => 'Configuracion del bios',
                    'Bios bloqueada'            => 'Bios bloqueada',
                    'Corto circuito'            => 'Corto circuito',
                ],
                ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
            )?>
        </div>
    </div>
    <!-- FALLA DE TECLADO -->
    <div class="form-group">
        <?= Html::label('Falla de Teclado', 'ftec', ['class' => ''])?>
        <div class="">
            <?= Html::activeDropDownList(
                $fteclado,'ftec',
                [
                    'Teclado dañado'    => 'Teclado dañado',
                    'Faltan teclas'     => 'Faltan teclas',
                    'No marcan teclas'  => 'No marcan teclas'
                ],
                ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
            )?>
        </div>
    </div>
    <!-- FALLA DE CARGA -->
    <div class="form-group">
        <?= Html::label('Falla de Carga', 'fcarg', ['class' => ''])?>
        <div class="">
            <?= Html::activeDropDownList(
                $fcarga,'fcarg',
                [
                    'Pin de carga'      => 'Pin de carga',
                    'Bateria dañada'    => 'Bateria dañada',
                    'Cargador dañado'   => 'Cargador dañado'
                ],
                ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
            )?>
        </div>
    </div>
    <!-- FALLA GENERAL -->
    <div class="form-group">
        <?= Html::label('Falla General', 'fgen', ['class' => ''])?>
        <div class="">
            <?= Html::activeDropDownList(
                $fgeneral,'fgen',
                [
                    'Mouse dañado'              => 'Mouse dañado',
                    'Disco duro dañado'         => 'Disco duro dañado',
                    'Momoria ram dañada'        => 'Momoria ram dañada',
                    'Fan cooler dañado'         => 'Fan cooler dañado',
                    'Boton encendido dañado'    => 'Boton encendido dañado',
                    'Camara dañada'             => 'Camara dañada',
                    'Equipo inoperativo'        => 'Equipo inoperativo'
                ],
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
