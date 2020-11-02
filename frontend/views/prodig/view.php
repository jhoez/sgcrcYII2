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
            [
                'attribute'=>'idpro',
                'value'=>function($data){
                    return $data->getMultproyecto()->idpro;
                },
            ],
            [
                'label'=>'Nombre del Proyecto',
                'attribute'=>'nombpro',
                'value'=>function($data){
                    return $data->getMultproyecto()->nombpro;
                },
            ],
            [
                'attribute'=>'creador',
                'value'=>function($data){
                    return $data->getMultproyecto()->creador;
                },
            ],
            [
                'attribute'=>'colaboracion',
                'value'=>function($data){
                    return $data->getMultproyecto()->colaboracion;
                },
            ],
            [
                'attribute'=>'descripcion',
                'value'=>function($data){
                    return $data->getMultproyecto()->descripcion;
                },
            ],
            [
                'label'=>'Archivo Multimedia',
                'attribute'=>'nombmult',
                'value'=>function($data){
                    return $data->nombmult;
                },
            ],
            [
                'attribute'=>'tipomult',
                'value'=>function($data){
                    return $data->tipomult;
                },
            ],
            [
                'attribute'=>'tamanio',
                'value'=>function($data){
                    return $data->tamanio;
                },
            ],
        ],
    ]) ?>

</div>
