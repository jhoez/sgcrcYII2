<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MultimediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Multimedia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multimedia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Multimedia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idmult',
            'nombmult',
            'extension',
            'tipomult',
            'tamanio',
            //'ruta',
            //'fkidpro',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
