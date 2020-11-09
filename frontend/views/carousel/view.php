<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Imagen */

$this->title = 'Detalles';
$this->params['breadcrumbs'][] = ['label' => 'Carousel', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="img-view">
    <p>
        <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'idimag',
            [
                'label'=>'Imagen',
                'value'=>function($data){
                    return Html::img('@web/'.$data->ruta.$data->nombimg.'.'.$data->extension,['width'=>'100px']);
                },
                'format'=>'raw'
            ],
            [
                'attribute'=>'nombimg',
                'value'=>function($data){
                    return $data->nombimg;
                },
            ],
            [
                'attribute'=>'extension',
                'value'=>function($data){
                    return $data->extension;
                },
            ],
            [
                'attribute'=>'tipoimg',
                'value'=>function($data){
                    return $data->tipoimg;
                },
            ],
            [
                'attribute'=>'username',
                'value'=>function($data){
                    return $data->getusuario()->username;
                },
            ],
        ],
    ]) ?>

</div>
