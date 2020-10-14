<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $multimedia frontend\models\Multimedia */

$this->title = $multimedia->nombpro;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos Digitales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="prodig-view">

    <p>
        <?= Html::a('Proyectos registrados', ['registros'], ['class' => 'btn btn-primary']) ?>
        <!--<?//= Html::a('Update', ['update', 'id' => $multimedia->idmult], ['class' => 'btn btn-primary']) ?>
        <?/*= Html::a('Delete', ['delete', 'id' => $multimedia->idmult], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>-->
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $multimedia,
        'attributes' => [
            'idmult',
            'nombmult',
            'extension',
            'tipomult',
            'tamanio',
            'ruta',
            'fkidpro',
        ],
    ]) ?>

</div>
