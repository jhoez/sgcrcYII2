<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RealaumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Realaums';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realaum-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Realaum', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idra',
            'nra',
            'exten',
            'ruta',
            'fk_pro',
            //'fkimag',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
