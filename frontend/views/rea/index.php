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

    <p>
        <?= Html::a('Subir Realidad Aumentada', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>


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
