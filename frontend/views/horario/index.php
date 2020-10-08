<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AsistenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asistencias';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistencia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Marcar Asistencia', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reporte de Asistencia', ['reporteAsistencia'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Usuario',
                'attribute'=>'username',
                'value'=>function($data){
                    return $data->getfkuser()->one()->username;
                },
            ],
            'fecha',
            'horain',
            'horaout',
            'observacion:ntext',
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'headerOptions'=>['width'=>'60'],
                'template'=>'{view}{delete}',
                'buttons'=> [
                    'view' => function($url){
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            $url
                        );
                    },
                    'delete' => function($url){
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
