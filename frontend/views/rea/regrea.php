<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RealaumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rea-regrea">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Subir proyecto', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Realidad Aumentada', ['index'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Creador',
                'attribute'=>'creador',
                'value'=>function($data){
                    return $data->getRaProyecto()->creador;
                },
            ],
            [
                'label'=>'Nomb. proyecto',
                'attribute'=>'nombpro',
                'value'=>function($data){
                    return $data->getRaProyecto()->nombpro;
                },
            ],
            [
                'label'=>'Colaboración',
                'attribute'=>'colaboracion',
                'value'=>function($data){
                    return $data->getRaProyecto()->colaboracion;
                },
            ],
            [
                'label'=>'F creado',
                'attribute'=>'create_at',
                'value'=>function($data){
                    return $data->getRaProyecto()->create_at;
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Acción',
                'headerOptions'=>['width'=>'60'],
                'template'=>'{view}{update}{delete}{ra}',
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
                    'delete' => function($url){
                        return Html::a(
                            '<span class="glyphicon glyphicon-remove"></span>',
                            $url
                        );
                    },
                    'ra' => function($url){
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-close"></span>',
                            $url,
                            ['target'=>'_blank']
                        );
                    },
                ],
            ],
        ],
    ]); ?>


</div>
