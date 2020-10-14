<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MultimediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registros Multimedia';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodig-registros">

    <p>
        <?= Html::a('Proyectos digitales', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Crear Proyecto digital', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

<div class="table-responsive">
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
