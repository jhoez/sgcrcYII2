<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ImagenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Imagens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Imagen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idimag',
            'nombimg',
            'extension',
            'ruta',
            'tamanio',
            //'tipoimg',
            //'fkuser',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
