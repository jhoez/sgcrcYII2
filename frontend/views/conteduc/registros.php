<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
//use yii\jui\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LibrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contenido Educativo registrado';
$this->params['breadcrumbs'][] = ['label'=>'Contenido Educativo','url'=>'index'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contenido-registros">
    <p>
        <?= Html::a('Contenido Educativo', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Subir Libro', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <h3 class="text-center">Registros</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Libro',
                'attribute'=>'nomblib',
                'value'=>function($data){
                    return $data->nomblib;
                },
            ],
            [
                'label'=>'Imagen',
                'attribute'=>'nombimg',
                'value'=>function($data){
                    return $data->getimagen()->nombimg;
                },
            ],
            [
                'label'=>'Colección',
                'attribute'=>'coleccion',
                'value'=>function($data){
                    return $data->coleccion;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'headerOptions'=>['width'=>'60'],
                'template'=>'{view}{update}{delete}',
                'buttons'=> [
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
    ]);?>
</div>
