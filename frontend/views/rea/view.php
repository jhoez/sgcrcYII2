<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $realidadaumentada frontend\models\Realaum */

$this->title = 'Detalles';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos Realidad Aumentada', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="realaum-view">
    <p>
        <?= Html::a('Proyectos Realidad Aumentada', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($realidadaumentada->nra.'.'.$realidadaumentada->exten) ?></h1>

    <?= DetailView::widget([
        'model' => $realidadaumentada,
        'attributes' => [
            [
                'label'=>'Img realidad aumentada',
                'value'=>function($data){
                    return Html::img('@web/'.$data->getRaImagen()->ruta.$data->getRaImagen()->nombimg.'.'.$data->getRaImagen()->extension,['width'=>'100px']);
                },
                'format'=>'raw'
            ],
            [
                'label'=>'Centro Bolivariano de Informatica y Telematica',
                'attribute'=>'creador',
                'value'=>function($data){
                    return $data->getRaProyecto()->creador;
                }
            ],
            [
                'label'=>'Usuario creador',
                'attribute'=>'username',
                'value'=>function($data){
                    return $data->getRaProyecto()->getUsuario()->username;
                }
            ],
            [
                'label'=>'Nombre del proyecto',
                'attribute'=>'nombpro',
                'value'=>function($data){
                    return $data->getRaProyecto()->nombpro;
                }
            ],
            [
                'label'=>'Nomb. Realidad Aumentada',
                'attribute'=>'nra',
                'value'=>function($data){
                    return $data->nra;
                },
            ],
            [
                'label'=>'Extensión',
                'attribute'=>'exten',
                'value'=>function($data){
                    return $data->exten;
                },
            ],
            [
                'label'=>'Colaboración',
                'attribute'=>'colaboracion',
                'value'=>function($data){
                    return $data->getRaProyecto()->colaboracion;
                }
            ],
            [
                'label'=>'F. Creación',
                'attribute'=>'create_at',
                'value'=>function($data){
                    return $data->getRaProyecto()->create_at;
                }
            ],
            [
                'label'=>'F. Actualización',
                'attribute'=>'update_at',
                'value'=>function($data){
                    return $data->getRaProyecto()->update_at;
                }
            ],
        ],
    ]) ?>

</div>
