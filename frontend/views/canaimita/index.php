<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
//use yii\jui\Tabs;
use kartik\date\DatePicker;
//use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Canaimitas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="canaimita-index">

    <p>
        <?= Html::a('Registrar Canaimita', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Crear Reportes',['reportespdf'],['class'=>'btn btn-primary']);?>
        <?= Html::a('Subir archivo',['/archivos/create'],['class'=>'btn btn-primary']);?>
        <?= Html::a('Asistencia',['/horario/index'],['class'=>'btn btn-primary']);?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <br>

    <div class="table-responsive">
        <h3 class="text-center">Registros de Canaimitas</h3>
        <?= GridView::widget([
            'id'=>'cgrid',
            'dataProvider' => $cdataProvider,
            'filterModel' => $csearchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'label'=>'Cedula',
                    'attribute'=>'cedula',
                    'value'=>function($data){
                        return $data->getCanrepresentante()->cedula;
                    }
                ],
                [
                    'attribute'=>'eqserial',
                    'value'=>function($data){
                        return $data->eqserial;
                    }
                ],
                [
                    'attribute'=>'frecepcion',
                    'value'=>function($data){
                        return $data->frecepcion;
                    },
                    'filter'=> DatePicker::widget([
                        'model' => $csearchModel,
                        'attribute' => 'frecepcion',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => ['placeholder' => '0000-00-00'],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ])
                ],
                [
                    'attribute'=>'fentrega',
                    'value'=>function($data){
                        return $data->fentrega != null ? $data->fentrega : 'sin fecha' ;
                    },
                    'filter'=> DatePicker::widget([
                        'model' => $csearchModel,
                        'attribute' => 'fentrega',
                        'type' => DatePicker::TYPE_BUTTON,
                        'options' => ['placeholder' => '0000-00-00'],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ])
                ],
                [
                    'label'=>'Versión del Equipo',
                    'attribute'=>'eqversion',
                    'filter'=>[
                        'V1'        => 'V1',
                        'V2'        => 'V2',
                        'V3'        => 'V3',
                        'V4'        => 'V4',
                        'V5'        => 'V5',
                        'V6'        => 'V6',
                        'Tablet'    => 'Tablet',
                    ],
                    'value'=> function($data){
                        return $data->eqversion;
                    }
                ],
                [
                    'label'=>'Estado de Entraga',
                    'attribute'=>'eqstatus',
                    'filter'=>[
                        'operativo'=>'Operativo',
                        'inoperativo'=>'Inoperativo',
                    ],
                    'value'=> function($data){
                        return $data->eqstatus;
                    }
                ],
                [
                    'label'=>'Representante',
                    'attribute'=>'nombre',
                    'value'=> function($data){
                        return $data->getCanrepresentante()->nombre;
                    }
                ],
                [
                    'label'=>'Estade de Entraga',
                    'attribute'=>'status',
                    'filter'=>[
                        '1'=>'Entregado',
                        '0'=>'No entregado',
                    ],
                    'value'=> function($data){
                        return $data->status == 1 ? 'Entregado' : 'No entregado';
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Action',
                    'headerOptions'=>['width'=>'60'],
                    'template'=>'{marcar}{view}{update}{delete}',
                    'buttons'=> [
                        'marcar' => function($url,$model){
                            if ($model->status == 0) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-ok-circle"></span>',
                                    $url
                                );
                            } else {
                            }
                        },
                        'view' => function($url,$model){
                            return Html::a(
                                '<span class="glyphicon glyphicon-eye-open"></span>',
                                $url
                            );
                        },
                        'update' => function($url,$model){
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                $url
                            );
                        },
                        'delete' => function($url,$model){
                            return Html::a(
                                '<span class="glyphicon glyphicon-remove"></span>',
                                $url
                            );
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>

    <!------------------------------------------------------------------------->
                            <!-- SECCION DE FORMATOS -->
    <!------------------------------------------------------------------------->
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

                    <h3 class="text-center">Actas archivos</h3>
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
            <h3 class="text-center">Registros de Archivos</h3>
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
                            'type' => DatePicker::TYPE_INPUT,
                            'options' => ['placeholder' => '0000-00-00'],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd'
                            ]
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
                            return $data->status == '1' ? 'Visto' : 'Por ver';
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
                            if ($model->status == '0') {
                                return Html::a(
                                '<span class="glyphicon glyphicon-ok-circle"></span>',
                                Url::to(["archivos/updatestatus", "id" => implode((array)$model->idf)])
                                );
                            } else {
                            }
                        },
                        ],
                        ],
                        ],
                        ]); ?>
        </div>
    </div>
