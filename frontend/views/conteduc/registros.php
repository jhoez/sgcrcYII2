<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
//use yii\jui\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LibrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros';
$this->params['breadcrumbs'][] = ['label'=>'Contenido Educativo','url'=>'index'];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="contenido-registros">
    <p>
        <?= Html::a('Contenido Educativo', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Subir Libro', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

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
                'filter'=> Html::activeDropDownList(
                    $searchModel,'coleccion',
                    [
                        'coleccionBicentenaria'		=>	'Coleccion Bicentenaria',
                        'coleccionMaestros'			=>	'Coleccion Maestro',
                        'lectura'					=>	'Lectura Sugerida'
                    ],
                    ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                )
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'headerOptions'=>['width'=>'60'],
                'template'=>'{view}{update}{delete}{verlib}',
                'buttons'=> [
                    'view' => function($url){
                        return Html::a(
                            Html::img('@web/fonts/view.svg'),
                            $url
                        );
                    },
                    'update' => function($url){
                        return Html::a(
                            Html::img('@web/fonts/pencil.svg'),
                            $url
                        );
                    },
                    'delete' => function($url,$model){
                        return Html::a(
                            Html::img('@web/fonts/cross.svg'),
                            $url
                        );
                    },
                    'verlib' => function($url,$model,$index){
                        return Html::a(
                            Html::img('@web/fonts/file1.svg'),
                            $url,
                            ['target'=>'_blank']
                        );
                    },
                ],
            ],
        ],
    ]);?>
</div>
