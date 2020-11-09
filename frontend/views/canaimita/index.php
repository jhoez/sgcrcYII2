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

if (Yii::$app->user->can('administrador')) {
    $elementos = [
        'estadistica'	=>	'Estadistica',
        'planificacion'	=>	'Actividades Planificadas',
        'inventario'	=>	'Inventario Tecnologico',
        'acta'			=>	'Acta'
    ];
} else {
    $elementos = [
        'estadistica'	=>	'Estadistica',
        'planificacion'	=>	'Actividades Planificadas',
        'inventario'	=>	'Inventario Tecnologico'
    ];
}
?>

<div class="canaimita-index">

    <p>
        <?= Html::a('Registrar Canaimita', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Crear Reportes',['reportespdf'],['class'=>'btn btn-primary']);?>
        <?= Html::a('Archivos',['/archivos/index'],['class'=>'btn btn-primary']);?>
        <?= Html::a('Asistencia',['/horario/index'],['class'=>'btn btn-primary']);?>
        <?= Html::a('Carousel', ['/carousel/index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php // $this->render('_search', ['model' => $csearchModel]); ?>

    <div class="table-responsive">
        <h3 class="text-center">Canaimitas registradas</h3>
        <hr>
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
                        'type' => DatePicker::TYPE_BUTTON,//'type' => DatePicker::TYPE_INPUT,
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
                    'filter'=> Html::activeDropDownList(
                        $csearchModel,'eqversion',
                        [
                            'V1'        => 'V1',
                            'V2'        => 'V2',
                            'V3'        => 'V3',
                            'V4'        => 'V4',
                            'V5'        => 'V5',
                            'V6'        => 'V6',
                            'Tablet'    => 'Tablet',
                        ],
                        ['prompt' => '','class' => 'form-control imput-md']
                    ),
                    'value'=> function($data){
                        return $data->eqversion;
                    }
                ],
                [
                    'label'=>'Status del Equipo',
                    'attribute'=>'eqstatus',
                    'filter'=> Html::activeDropDownList(
                        $csearchModel,'eqstatus',
                        [
                            'operativo'=>'Operativo',
                            'inoperativo'=>'Inoperativo',
                        ],
                        ['prompt' => '','class' => 'form-control imput-md']
                    ),
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
                    'label'=>'Estado de Entraga',
                    'attribute'=>'status',
                    'filter'=> Html::activeDropDownList(
                        $csearchModel,'status',
                        [
                            '1'=>'Entregado',
                            '0'=>'No entregado',
                        ],
                        ['prompt' => '','class' => 'form-control imput-md']
                    ),
                    'value'=> function($data){
                        return $data->status == true ? 'Entregado' : 'No entregado';
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Acción',
                    'headerOptions'=>['width'=>'70'],
                    'template'=>'{marcar}{view}{update}{delete}',
                    'buttons'=> [
                        'marcar' => function($url,$model){
                            if ( \Yii::$app->user->can('administrador') && $model->status == false) {
                                return Html::a(
                                    Html::img('@web/fonts/checked.svg'),
                                    $url
                                );
                            }
                        },
                        'view' => function($url,$model){
                            return Html::a(
                                Html::img('@web/fonts/view.svg'),
                                $url
                            );
                        },
                        'update' => function($url,$model){
                            if ( \Yii::$app->user->can('superadmin') ) {
                                return Html::a(
                                    Html::img('@web/fonts/pencil.svg'),
                                    $url
                                );
                            }
                        },
                        'delete' => function($url,$model){
                            if ( \Yii::$app->user->can('superadmin') ) {
                                return Html::a(
                                    Html::img('@web/fonts/cross.svg'),
                                    $url
                                );
                            }
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

                    <h3 class="text-center">Actas descargables</h3>
                    <hr>
                    <div class="form-group">
                        <div class="">
                            <?= Html::label('Actas', 'formatosearch-idf', ['class' => ''])?>
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
            <h3 class="text-center">Archivos registrados</h3>
            <hr>
            <?= GridView::widget([
                'id'=>'fgrid',
                'dataProvider' => $fdataProvider,
                'filterModel' => $fsearchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label'=>'F subido',
                        'attribute'=>'create_at',
                        'value'=>function($data){
                            return $data->create_at;
                        },
                        'filter'=> DatePicker::widget([
                            'model' => $fsearchModel,
                            'attribute' => 'create_at',
                            'type' => DatePicker::TYPE_BUTTON,
                            'options' => ['placeholder' => '0000-00-00'],
                            'pluginOptions' => [
                                'autoclose'=>true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ])
                    ],
                    [
                        'label'=>'Tipo',
                        'attribute'=>'opcion',
                        'filter'=>$elementos,
                        'value'=>function($data){
                            return $data->opcion;
                        }
                    ],
                    [
                        'label'=>'Archivo',
                        'attribute'=>'nombf',
                        'value'=>function($data){
                            return $data->nombf;
                        }
                    ],
                    [
                        'label'=>'Extensión',
                        'attribute'=>'extens',
                        'filter'=> Html::activeDropDownList(
                            $fsearchModel,'extens',
                            [
                                'ods'=>'ods',
                                'xls'=>'xls',
                                'odt'=>'odt',
                                'docx'=>'docx',
                                'doc'=>'doc'
                            ],
                            ['prompt' => '','class' => 'form-control imput-md']
                        ),
                        'value'=>function($data){
                            return $data->extens;
                        }
                    ],
                    /*[
                        'label'=>'Tamaño File',
                        'attribute'=>'tamanio',
                        'filter'=>false,
                        'value'=>function($data){
                            return $data->tamanio;
                        }
                    ],*/
                    [
                        'label'=>'Por ver/Visto',
                        'attribute'=>'status',
                        'filter'=> Html::activeDropDownList(
                            $fsearchModel,'status',
                            [
                                '1'=>'Visto',
                                '0'=>'Por ver'
                            ],
                            ['prompt' => '','class' => 'form-control imput-md']
                        ),
                        'value'=>function($data){
                            return $data->status == true ? 'Visto' : 'Por ver';
                        },
                        'visible'=>Yii::$app->user->can('administrador')
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Acción',
                        'headerOptions'=>['width'=>'70'],
                        'template'=>'{marcar}{view}{update}{delete}{descargarfa}',
                        'buttons'=> [
                            'marcar' => function($url,$model){
                                if (Yii::$app->user->can('administrador') && $model->status == false) {
                                    return Html::a(
                                        Html::img('@web/fonts/checked.svg'),
                                        Url::to(['/canaimita/marcarstatus', 'id' => $model->idf])
                                    );
                                }
                            },
                            'view' => function($url,$model){
                                return Html::a(
                                    Html::img('@web/fonts/view.svg'),
                                    Url::to(['/archivos/view', 'id' => $model->idf])
                                );
                            },
                            'update' => function($url,$model){
                                if (Yii::$app->user->can('administrador')) {
                                    return Html::a(
                                        Html::img('@web/fonts/pencil.svg'),
                                        Url::to(['/archivos/update', 'id' => $model->idf])
                                    );
                                }
                            },
                            'delete' => function($url,$model){
                                if (Yii::$app->user->can('administrador')) {
                                    return Html::a(
                                        Html::img('@web/fonts/cross.svg'),
                                        Url::to(['/archivos/delete', 'id' => $model->idf])
                                    );
                                }
                            },
                            'descargarfa' => function($url,$model){
                                if (Yii::$app->user->can('administrador')) {
                                    return Html::a(
                                        Html::img('@web/fonts/download.svg'),
                                        Url::to(['/archivos/descargarfa', 'id' => $model->idf])
                                    );
                                }
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
