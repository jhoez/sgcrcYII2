<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FormatoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Formatos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formato-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Formato', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idf',
            'opcion',
            'nombf',
            'extens',
            'ruta',
            //'tamanio',
            //'status',
            //'create_at',
            //'update_at',
            //'fkuser',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
