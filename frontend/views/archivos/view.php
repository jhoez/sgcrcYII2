<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $archivos frontend\models\Formato */

$this->title = 'Detalles';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = ['label' => 'Archivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="archivo-view">

    <p>
        <?= Html::a('Archivos registrados', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($archivos->nombf.'.'.$archivos->extens) ?></h1>

    <?= DetailView::widget([
        'model' => $archivos,
        'attributes' => [
            /*[
                'attribute'=>'idf',
                'value'=>function($data){
                    return $data->idf;
                }
            ],*/
            [
                'attribute'=>'opcion',
                'value'=>function($data){
                    return $data->opcion;
                }
            ],
            [
                'attribute'=>'nombf',
                'value'=>function($data){
                    return $data->nombf;
                }
            ],
            [
                'attribute'=>'extens',
                'value'=>function($data){
                    return $data->extens;
                }
            ],
            /*[
                'attribute'=>'ruta',
                'value'=>function($data){
                    return $data->ruta;
                }
            ],*/
            [
                'attribute'=>'tamanio',
                'value'=>function($data){
                    return $data->tamanio;
                }
            ],
            [
                'attribute'=>'status',
                'value'=>function($data){
                    return $data->status == '1' ? 'Visto' : 'Por ver';
                }
            ],
            [
                'attribute'=>'statusacta',
                'value'=>function($data){
                    return $data->statusacta == '1' ? 'Acta' : 'Archivo';
                }
            ],
            [
                'attribute'=>'create_at',
                'value'=>function($data){
                    return $data->create_at;
                }
            ],
            [
                'attribute'=>'fkuser',
                'value'=>function($data){
                    return $data->getiduser()->one()->username;
                }
            ],
        ],
    ]) ?>

</div>
