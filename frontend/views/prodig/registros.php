<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MultimediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros Multimedia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodig-registros">

    <p>
        <?= Html::a('Proyectos digitales', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Subir Proyecto', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombmult',
            //'extension',
            'tipomult',
            'tamanio',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'headerOptions'=>['width'=>'70'],
                'template'=>'{view}{update}{delete}{verva}',
                'buttons'=> [
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
                    'verva' => function($url,$model,$index){//function($url,$model,$index)
                        return Html::a(
                            '<span class="glyphicon glyphicon-download"></span>',
                            $url,//['verva','id'=>$model->idmult],
                            ['target'=>'_blank']
                        );
                    },
                ],
            ],
        ],
    ]); ?>
</div>
