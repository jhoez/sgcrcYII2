<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FormatoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Archivos registrados';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archivos-index">

    <p>
        <?= Html::a('Subir Archivo', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Canaimitas registradas', ['/canaimita/index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row clearfix">
        <div class="col-md-offset-3 col-md-6">
            <div class="archivo-form">
                <?php $form = ActiveForm::begin([
                    'id'=>'archivo',
                    //'method' => 'post',
                    'action'=>Url::toRoute('/archivos/descargarfa'),
                    'enableClientValidation'=>true,
                    //'enableAjaxValidation' => true,
                ]);?>

                <h3 class="text-center">Actas descargables</h3>
                <div class="form-group">
                    <?= Html::label('Actas', 'idf', ['class' => ''])?>
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
                }
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
                'template'=>'{updatestatus}{view}{update}{delete}{descargarfa}',
                'buttons'=> [
                    'updatestatus' => function($url,$model){
                        if ($model->status == '0') {
                            return Html::a(
                                '<span class="glyphicon glyphicon-ok-circle"></span>',
                                Url::to(["archivos/updatestatus", "id" => implode((array)$model->idf)])
                            );
                        } else {
                        }
                    },
                    'view' => function($url){
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            $url
                        );
                    },
                    'update' => function($url){
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
                    'descargarfa' => function($url,$model,$index){
                        return Html::a(
                            '<span class="glyphicon glyphicon-download"></span>',
                            $url
                        );
                    },
                ],
            ],
        ],
    ]); ?>


</div>
