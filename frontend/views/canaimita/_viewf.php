<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
//use kartik\date\DatePicker;
use yii\jui\DatePicker;
?>
<div class="">

    <div class="row clearfix">
        <div class="col-md-offset-3 col-md-6">
            <div class="archivos-form">
                <?php $form = ActiveForm::begin([
                    'id'=>'archivos',
                    //'method' => 'post',
                    'action'=>Url::toRoute('/archivos/descargarfa'),
                    'enableClientValidation'=>true,
                    //'enableAjaxValidation' => true,
                ]);?>

                <h3 class="text-center">Actas descargables</h3>
                <div class="form-group">
                    <?= Html::label('Actas', 'idf', ['class' => ''])?>
                    <div class="">
                        <?= Html::activeDropDownList(
                            $fsearchModel,'idf',
                            ArrayHelper::map($actasArray, 'idf', 'nombf'),
                            ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                        )?>
                    </div>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Descargar', ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <h3 class="text-center">Registros de Formatos</h3>
        <?= GridView::widget([
            'id'=>'fgrid',
            'dataProvider' => $fdataProvider,
            'filterModel' => $fsearchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label'=>'ID',
                    'attribute'=>'idf',
                    'value'=>function($data){
                        return $data->idf;
                    }
                ],
                [
                    'label'=>'F subido',
                    'attribute'=>'create_at',
                    'value'=>function($data){
                        return $data->create_at;
                    },
                    'filter'=> DatePicker::widget([
                        'model' => $fsearchModel,
                        'attribute' => 'create_at',
                        'language' => 'es',
                        'dateFormat' => 'yyyy-MM-dd',
                    ])
                ],
                [
                    'label'=>'Opcion',
                    'attribute'=>'opcion',
                    'value'=>function($data){
                        return $data->opcion;
                    }
                ],
                [
                    'label'=>'Por ver/visto',
                    'attribute'=>'nombf',
                    'value'=>function($data){
                        return $data->nombf;
                    }
                ],
                [
                    'label'=>'Extensión',
                    'attribute'=>'extens',
                    'value'=>function($data){
                        return $data->extens;
                    }
                ],
                [
                    'label'=>'Tamaño File',
                    'attribute'=>'tamanio',
                    'value'=>function($data){
                        return $data->tamanio;
                    }
                ],
                [
                    'label'=>'Status',
                    'attribute'=>'status',
                    'value'=>function($data){
                        return $data->status == true ? 'Visto' : 'Por ver';
                    },
                    'filter'=>[
                        '0'=>'Por ver',
                        '1'=>'Visto'
                    ]
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Action',
                    'headerOptions'=>['width'=>'60'],
                    'template'=>'{view}{update}{delete}{descargarfa}{marcar}',
                    'buttons'=> [
                        'view' => function($url,$model){
                            return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            Url::to(["archivos/view", "id" => implode((array)$model->idf)])
                            );
                        },
                        'update' => function($url,$model){
                            return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            Url::to(["archivos/update", "id" => implode((array)$model->idf)])
                            );
                        },
                        'delete' => function($url,$model){
                            return Html::a(
                            '<span class="glyphicon glyphicon-remove"></span>',
                            Url::to(["archivos/delete", "id" => implode((array)$model->idf)])
                            );
                        },
                        'descargarfa' => function($url,$model){
                            return Html::a(
                            '<span class="glyphicon glyphicon-download"></span>',
                            Url::to(["archivos/descargarfa", "id" => implode((array)$model->idf)])
                            );
                        },
                        'marcar' => function($url,$model){
                            return Html::a(
                            '<span class="glyphicon glyphicon-ok-circle"></span>',
                            Url::to(["archivos/updatestatus", "id" => implode((array)$model->idf)])
                            );
                        },
                    ],
                ],
            ],
        ]);?>
    </div>

</div>
