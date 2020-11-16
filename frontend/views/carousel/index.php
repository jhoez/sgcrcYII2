<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ImagenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carousel';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="img-index">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Subir Img Carousel', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode('Registros') ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Nomb. Img',
                'attribute'=>'nombimg',
                'value'=>function($data){
                    return $data->nombimg;
                }
            ],
            [
                'label'=>'Extensión',
                'attribute'=>'extension',
                'value'=>function($data){
                    return $data->extension;
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
                'label'=>'Tipo img',
                'attribute'=>'tipoimg',
                'value'=>function($data){
                    return $data->tipoimg;
                }
            ],
            [
                'label'=>'Usuario',
                'attribute'=>'username',
                'value'=>function($data){
                    return $data->getusuario()->username;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Acción',
                'headerOptions'=>['width'=>'70'],
                'template'=>'{view}{update}{delete}',
                'buttons'=> [
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
