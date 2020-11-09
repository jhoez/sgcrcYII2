<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FormatoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Archivos';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
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
<div class="ar-index">

    <p>
        <?= Html::a('Subir Archivo', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Canaimitas registradas', ['/canaimita/index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row clearfix">
        <div class="col-md-offset-3 col-md-6">
            <div class="ar-form">
                <?php $form = ActiveForm::begin([
                    'id'=>'archivo',
                    //'method' => 'post',
                    'action'=>Url::toRoute('/archivos/descargarfa'),
                    'enableClientValidation'=>true,
                    //'enableAjaxValidation' => true,
                ]);?>

                <div class="form-group">
                    <?= Html::label('Actas', 'formatosearch-idf', ['class' => ''])?>
                    <?php
                    if (Yii::$app->session->hasFlash('erromsj')){
                        echo Html::tag('strong','no se pudo descagar el archivo', ['class' => 'label label-success']);
                    }
                    ?>
                    <div class="">
                        <?= Html::activeDropDownList(
                            $searchModel,'idf',
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

    <h3 class="text-center"><?= Html::encode('Registros') ?></h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'F subido',
                'attribute'=>'create_at',
                'value'=>function($data){
                    return $data->create_at;
                }
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
                'filter'=>[
                    'ods'=>'ods',
                    'xls'=>'xls',
                    'odt'=>'odt',
                    'docx'=>'docx',
                    'doc'=>'doc'
                ],
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
                'header'=>'Acción',
                'headerOptions'=>['width'=>'70'],
                'template'=>'{updatestatus}{view}{update}{delete}{descargarfa}',
                'buttons'=> [
                    'updatestatus' => function($url,$model){
                        if (Yii::$app->user->can('administrador') && $model->status == false) {
                            return Html::a(
                                Html::img('@web/fonts/checked.svg'),
                                Url::to(['archivos/updatestatus', 'id' => $model->idf]),
                                [
                                    //'class' => 'btn btn-primary',
                                ]
                            );
                        }
                    },
                    'view' => function($url){
                        return Html::a(
                            Html::img('@web/fonts/view.svg'),
                            $url,
                            [
                                //'class' => 'btn btn-primary',
                            ]
                        );
                    },
                    'update' => function($url){
                        if (Yii::$app->user->can('administrador')) {
                            return Html::a(
                                Html::img('@web/fonts/pencil.svg'),
                                $url,
                                [
                                    //'class' => 'btn btn-warning',
                                ]
                            );
                        }
                    },
                    'delete' => function($url,$model){
                        if (Yii::$app->user->can('administrador')) {
                            return Html::a(
                                Html::img('@web/fonts/cross.svg'),
                                $url,
                                [
                                    //'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Esta seguro de eliminar el registro?',
                                        'method' => 'get',
                                    ]
                                ]
                            );
                        }
                    },
                    'descargarfa' => function($url,$model,$index){
                        if (Yii::$app->user->can('administrador')) {
                            return Html::a(
                                Html::img('@web/fonts/download.svg'),
                                $url,
                                [
                                    //'class' => 'btn btn-success',
                                ]
                            );
                        }
                    },
                ],
            ],
        ],
    ]); ?>


</div>
