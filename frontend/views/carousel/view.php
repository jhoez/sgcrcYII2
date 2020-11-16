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
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $carousel,
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
                'label'=>'Nombre img',
                'attribute'=>'nombimg',
                'value'=>function($data){
                    return $data->nombimg;
                },
            ],
            [
                'label'=>'Extensión',
                'attribute'=>'extension',
                'value'=>function($data){
                    return $data->extension;
                },
            ],
            [
                'label'=>'Tipo de img',
                'attribute'=>'tipoimg',
                'value'=>function($data){
                    return $data->tipoimg;
                },
            ],
            [
                'label'=>'Usuario',
                'attribute'=>'username',
                'value'=>function($data){
                    return $data->getusuario()->username;
                },
            ],
        ],
    ]) ?>

</div>
