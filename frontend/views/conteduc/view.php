<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Libros */

$this->title = 'Detalles';
$this->params['breadcrumbs'][] = ['label' => 'Contenido Educativo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="contenido-view">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Registros', ['registros'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center">Libro subido: <?= Html::encode($contenido->nomblib.'.'.$contenido->extension) ?></h1>


    <?= DetailView::widget([
        'model' => $contenido,
        'attributes' => [
            [
                'label'=>'Imagen',
                'value'=>function($data){
                    return Html::img('@web/'.$data->getimagen()->ruta.$data->getimagen()->nombimg.'.'.$data->getimagen()->extension,['width'=>'100px']);
                },
                'format'=>'raw'
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
            /*[
                'label'=>'Ruta',
                'attribute'=>'ruta',
                'value'=>function($data){
                    return $data->ruta;
                }
            ],*/
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
