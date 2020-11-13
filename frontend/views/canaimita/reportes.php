<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$this->title = 'Reportes';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="report">
    <p>
        <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="row clearfix">
        <div class="col-md-offset-3 col-md-6">
            <div class="canaimita-form1">
                <?php $form = ActiveForm::begin([
                    'id'=>'reportemes',
                    //'method' => 'post',
                    'action'=>Url::toRoute('/canaimita/reportespdf'),
                    'enableClientValidation'=>true,
                    //'enableAjaxValidation' => true,
                ]);?>

                <!------------------------------------------------------------------------->
                <!-- REPORTE POR MES -->
                <!------------------------------------------------------------------------->
                <h3 class="text-center">Reporte por Mes</h3>
                <div class="form-group">
                    <div class="">
                        <?= $form->field($canaimita,'mes')->dropDownList(
                            [
                                '01'    =>  'Enero',
                                '02'    =>  'Febrero',
                                '03'    =>  'Marzo',
                                '04'    =>  'Abril',
                                '05'    =>  'Mayo',
                                '06'    =>  'Junio',
                                '07'    =>  'Julio',
                                '08'    =>  'Agosto',
                                '09'    =>  'Septiembre',
                                '10'    =>  'Octubre',
                                '11'    =>  'Noviembre',
                                '12'    =>  'Diciembre'
                            ],
                            ['prompt' => '---- Seleccione ----','class' => 'form-control input-md']
                        )?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Crear reporte', ['class' => 'btn btn-success']) ?>
                    <?= Html::button('Cancelar',['class' => 'btn btn-danger','onclick' => 'js:document.location.href="../canaimita/index"']);?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <!------------------------------------------------------------------------->
            <!-- REPORTE POR FALLAS -->
            <!------------------------------------------------------------------------->
            <div class="canaimita-form2">
                <?php $form = ActiveForm::begin([
                    'id'=>'reportefallas',
                    'action'=>Url::toRoute('/canaimita/reportesfallas'),
                    'enableClientValidation'=>true,
                    //'enableAjaxValidation' => true,
                ]);?>

                <h3 class="text-center">Reportes por Fallas</h3>
                <hr>
                <!-- FALLA DE SOFTWARE -->
                <div class="form-group">
                    <div class="">
                        <?= $form->field($fsoftware,'fsoft')->dropDownList(
                            ArrayHelper::map($arrayfsoft, 'nombcata', 'nombcata'),
                            ['prompt' => '---- Seleccione ----','class' => 'form-control input-md']
                        )?>
                    </div>
                </div>
                <!-- FALLA DE PANTALLA -->
                <div class="form-group">
                    <div class="">
                        <?= $form->field($fpantalla,'fpant')->dropDownList(
                            ArrayHelper::map($arrayfpant, 'nombcata', 'nombcata'),
                            ['prompt' => '---- Seleccione ----','class' => 'form-control input-md']
                        )?>
                    </div>
                </div>
                <!-- FALLA DE TARJETAMADRE -->
                <div class="form-group">
                    <div class="">
                        <?= $form->field($ftarjetamadre,'ftarj')->dropDownList(
                            ArrayHelper::map($arrayftarj, 'nombcata', 'nombcata'),
                            ['prompt' => '---- Seleccione ----','class' => 'form-control input-md']
                        )?>
                    </div>
                </div>
                <!-- FALLA DE TECLADO -->
                <div class="form-group">
                    <div class="">
                        <?= $form->field($fteclado,'ftec')->dropDownList(
                            ArrayHelper::map($arrayftec, 'nombcata', 'nombcata'),
                            ['prompt' => '---- Seleccione ----','class' => 'form-control input-md']
                        )?>
                    </div>
                </div>
                <!-- FALLA DE CARGA -->
                <div class="form-group">
                    <div class="">
                        <?= $form->field($fcarga,'fcarg')->dropDownList(
                            ArrayHelper::map($arrayfcar, 'nombcata', 'nombcata'),
                            ['prompt' => '---- Seleccione ----','class' => 'form-control input-md']
                        )?>
                    </div>
                </div>
                <!-- FALLA GENERAL -->
                <div class="form-group">
                    <div class="">
                        <?= $form->field($fgeneral,'fgen')->dropDownList(
                            ArrayHelper::map($arrayfgen, 'nombcata', 'nombcata'),
                            ['prompt' => '---- Seleccione ----','class' => 'form-control input-md']
                        )?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Crear reporte', ['class' => 'btn btn-success']) ?>
                    <?= Html::button('Cancelar',['class' => 'btn btn-danger','onclick' => 'js:document.location.href="../canaimita/index"']);?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>

            <!------------------------------------------------------------------------->
            <!-- REPORTE POR INICIO Y FIN -->
            <!------------------------------------------------------------------------->
            <div class="canaimita-form3">
                <?php $form = ActiveForm::begin([
                    'id'=>'reportefechas',
                    'action'=>Url::toRoute('/canaimita/reportespdf'),
                    'enableClientValidation'=>true,
                    //'enableAjaxValidation' => true,
                ]);?>

                <!------------------------------------------------------------------------->
                <!-- REPORTE POR CANAIMITA -->
                <!------------------------------------------------------------------------->
                <h3 class="text-center">Reporte Canaimitas Desde/Hasta</h3>
                <div class="form-group">
                    <div class="">
                        <?= Html::label('Desde la Fecha', 'frecepcion', ['class' => ''])?>
                        <?= DatePicker::widget([
                            'model' => $canaimita,
                            'attribute' => 'frecepcion',
                            'options' => ['placeholder' => 'DESDE'],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]); ?>
                    </div>
                    <div class="">
                        <?= Html::label('Hasta la Fecha', 'fentrega', ['class' => ''])?>
                        <?= DatePicker::widget([
                            'model' => $canaimita,
                            'attribute' => 'fentrega',
                            'options' => ['placeholder' => 'HASTA'],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ]); ?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Crear reporte', ['class' => 'btn btn-success']) ?>
                    <?= Html::button('Cancelar',['class' => 'btn btn-danger','onclick' => 'js:document.location.href="../canaimita/index"']);?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>