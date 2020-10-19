<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FormatoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Formatos registrados';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formato-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Subir Formato', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Canaimitas registradas', ['/canaimita/index'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row clearfix">
        <div class="col-md-offset-3 col-md-6">
            <div class="descargables-form">
                <?php $form = ActiveForm::begin([
                    'id'=>'descargables',
                    //'method' => 'post',
                    'action'=>Url::toRoute('/descargables/descargarf'),
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
                'template'=>'{marcar}{view}{update}{delete}{descargarf}',
                'buttons'=> [
                    'marcar' => function($url){
                        return Html::a(
                            '<span class="glyphicon glyphicon-ok-circle"></span>',
                            $url
                        );
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
                    'delete' => function($url){
                        return Html::a(
                            '<span class="glyphicon glyphicon-remove"></span>',
                            $url
                        );
                    },
                    'descargarf' => function($url,$model,$index){
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
