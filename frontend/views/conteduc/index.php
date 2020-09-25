<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LibrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Libros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="libros-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Libros', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idlib',
            'nomblib',
            'extension',
            'ruta',
            'coleccion',
            //'nivel',
            //'tamanio',
            //'idfkimag',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
