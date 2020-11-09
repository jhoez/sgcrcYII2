<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Asistencia */

$this->title = 'Detalles';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = ['label' => 'Asistencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="asistencia-view">

    <p>
        <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
        <!--<?//= Html::a('Update', ['update', 'id' => $model->idasis], ['class' => 'btn btn-primary']) ?>
        <?/*= Html::a('Delete', ['delete', 'id' => $model->idasis], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
    ])*/ ?>-->
    </p>
    <h1 class="text-center">Detalle de su asistencia</h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idasis',
            [
                'label'=>'Usuario',
                'attribute'=>'username',
                'value'=>function($data){
                    return $data->getFkusuario()->username;
                }
            ],
            [
                'label'=>'Fecha asistencia',
                'attribute'=>'fecha',
                'value'=>function($data){
                    return $data->fecha;
                }
            ],
            [
                'label'=>'Entrada',
                'attribute'=>'horain',
                'value'=>function($data){
                    return $data->horain;
                }
            ],
            [
                'label'=>'Salida',
                'attribute'=>'horaout',
                'value'=>function($data){
                    return $data->horaout;
                }
            ],
            [
                'label'=>'Observación',
                'attribute'=>'observacion:ntext',
                'value'=>function($data){
                    return $data->observacion;
                }
            ],
        ],
    ]) ?>

</div>
