<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $realidadaumentada frontend\models\Realaum */

$this->title = $realidadaumentada->nra;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos Realidad Aumentada', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="realaum-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $realidadaumentada->idra], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $realidadaumentada->idra], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $realidadaumentada,
        'attributes' => [
            'idra',
            'nra',
            'exten',
            'ruta',
            'fkpro',
            'fkimag',
        ],
    ]) ?>

</div>
