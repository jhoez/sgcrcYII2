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

<div class="">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Asistencias registradas', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Marcar asistencia',['create'],['class'=>'btn btn-primary']);?>
    </p>
</div>


<!-- ejemplo para mostrar los libros y videos -->
<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
        <div class="card text-center">
            <img src="<?=Yii::$app->request->baseUrl.'/img/logo.jpg'?>" alt="Avatar" width='200'>
            <h1>Tailored Jeans</h1>
            <p class="price">$19.99</p>
            <p>Some text about the jeans..</p>
            <p><button class="btn btn-primary">Add to Cart</button></p>
       </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
        <div class="horario-form">
            <?php $form = ActiveForm::begin([
                'id'=>'reportemes',
                //'method' => 'post',
                'action'=>Url::toRoute('/horario/reporteasistencia'),
                'enableClientValidation'=>true,
                //'enableAjaxValidation' => true,
            ]);?>

            <!------------------------------------------------------------------------->
            <!-- REPORTE POR MES -->
            <!------------------------------------------------------------------------->
            <h3 class="text-center">Reporte por Mes</h3>
            <div class="form-group">
                <?= Html::label('Mes', 'mes', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $horario,'mes',
                        [
                            '01'    =>	'Enero',
                            '02'    =>	'Febrero',
                            '03'    =>	'Marzo',
                            '04'    =>	'Abril',
                            '05'    =>	'Mayo',
                            '06'    =>	'Junio',
                            '07'    =>	'Julio',
                            '08'    =>	'Agosto',
                            '09'    =>	'Septiembre',
                            '10'	=>	'Octubre',
                            '11'	=>	'Noviembre',
                            '12'	=>	'Diciembre'
                        ],
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Crear reporte', ['class' => 'btn btn-success']) ?>
                <?= Html::button('Cancelar',['class' => 'btn btn-danger','onclick' => 'js:document.location.href="../horario/index"']);?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <!------------------------------------------------------------------------->
        <!-- REPORTE POR INICIO Y FIN -->
        <!------------------------------------------------------------------------->
        <div class="horario-form2">
            <?php $form = ActiveForm::begin([
                'id'=>'reportefechas',
                'action'=>Url::toRoute('/horario/reporteasistencia'),
                'enableClientValidation'=>true,
                //'enableAjaxValidation' => true,
            ]);?>

            <!------------------------------------------------------------------------->
            <!-- REPORTE POR CANAIMITA -->
            <!------------------------------------------------------------------------->
            <h3 class="text-center">Reporte horario Desde/Hasta</h3>
            <div class="form-group">
                <div class="">
                    <?= Html::label('Desde la Fecha', 'fechain', ['class' => ''])?>
                    <?= DatePicker::widget([
                        'model' => $horario,
                        'attribute' => 'fechain',
                        'options' => ['placeholder' => 'DESDE'],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ]); ?>
                </div>
                <div class="">
                    <?= Html::label('Hasta la Fecha', 'fechaout', ['class' => ''])?>
                    <?= DatePicker::widget([
                        'model' => $horario,
                        'attribute' => 'fechaout',
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
                <?= Html::button('Cancelar',['class' => 'btn btn-danger','onclick' => 'js:document.location.href="../horario/index"']);?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>
