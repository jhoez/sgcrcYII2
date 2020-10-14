<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Libros */

$this->title = 'Detalles';
$this->params['breadcrumbs'][] = ['label' => 'Libros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="contenido-view">

    <p>
        <?= Html::a('Contenido registrado', ['registros'], ['class' => 'btn btn-primary']) ?>
        <!--<?//= Html::a('Update', ['update', 'id' => $model->idlib], ['class' => 'btn btn-primary']) ?>
        <?/*= Html::a('Delete', ['delete', 'id' => $model->idlib], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => 'Are you sure you want to delete this item?',
        'method' => 'post',
    ],
    ]) */?>-->
    </p>
    <h1 class="text-center">Libro subido: <?= Html::encode($model->nomblib) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label'=>'ID',
                'attribute'=>'idlib',
                'value'=>function($data){
                    return $data->idlib;
                }
            ],
            [
                'label'=>'Libro',
                'attribute'=>'nomblib',
                'value'=>function($data){
                    return $data->nomblib;
                }
            ],
            [
                'label'=>'Extensión',
                'attribute'=>'extension',
                'value'=>function($data){
                    return $data->extension;
                }
            ],
            [
                'label'=>'Ruta',
                'attribute'=>'ruta',
                'value'=>function($data){
                    return $data->ruta;
                }
            ],
            [
                'label'=>'Colección',
                'attribute'=>'coleccion',
                'value'=>function($data){
                    return $data->coleccion;
                }
            ],
            [
                'label'=>'Nivel',
                'attribute'=>'nivel',
                'value'=>function($data){
                    return $data->nivel;
                }
            ],
            [
                'label'=>'Tamaño',
                'attribute'=>'tamanio',
                'value'=>function($data){
                    return $data->tamanio;
                }
            ],
            [
                'label'=>'Usuario',
                'attribute'=>'username',
                'value'=>function($data){
                    return $data->getimagen()->getusuario()->username;
                }
            ],
        ],
    ]) ?>

</div>
