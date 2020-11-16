<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AsistenciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Asistencia';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="asistencia-index">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Marcar Asistencia', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Reporte de Asistencia', ['reporteasistencia'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <h3 class="text-center"><?= Html::encode('Asistencias registradas') ?></h3>

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
                            Html::img('@web/fonts/view.svg'),
                            $url
                        );
                    },
                    'delete' => function($url){
                        return Html::a(
                            Html::img('@web/fonts/cross.svg'),
                            $url
                        );
                    },
                ],
            ],
        ],
    ]); ?>


</div>
