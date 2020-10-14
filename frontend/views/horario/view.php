<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Asistencia */

$this->title = $model->idasis;
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = ['label' => 'Asistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asistencia-view">

    <p>
        <?= Html::a('Asistencias registradas', ['index'], ['class' => 'btn btn-primary']) ?>
        <!--<?//= Html::a('Update', ['update', 'id' => $model->idasis], ['class' => 'btn btn-primary']) ?>
        <?/*= Html::a('Delete', ['delete', 'id' => $model->idasis], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
    ])*/ ?>-->
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idasis',
            'fkuser',
            'fecha',
            'horain',
            'horaout',
            'observacion:ntext',
        ],
    ]) ?>

</div>
