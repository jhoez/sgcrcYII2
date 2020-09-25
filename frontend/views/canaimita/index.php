<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Registrar Canaimita', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Crear Reportes',['reportespdf'],['class'=>'btn btn-primary']);?>
        <?= Html::a('Subir Formato',['/descargables/create'],['class'=>'btn btn-primary']);?>
        <?= Html::a('Asistencia',['/horario/index'],['class'=>'btn btn-primary']);?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label'=>'Cedula',
                'attribute'=>'cedula',
                'value'=>function($data){
                    return $data->getCanrepresentante()->cedula;
                }
            ],
            [
                'attribute'=>'eqserial',
                'value'=>function($data){
                    return $data->eqserial;
                }
            ],
            [
                'attribute'=>'frecepcion',
                'value'=>function($data){
                    return $data->frecepcion;
                },
                'filter'=> DatePicker::widget([
                    'name' => 'frecepcion',
                    'type' => DatePicker::TYPE_INPUT,
                    //'value' => 'created_at',
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                    ]
                ])
            ],
            [
                'attribute'=>'fentrega',
                'value'=>function($data){
                    return $data->fentrega != null ? $data->fentrega : 'sin fecha' ;
                },
                'filter'=> DatePicker::widget([
                    'name' => 'fentrega',
                    'type' => DatePicker::TYPE_INPUT,
                    //'value' => 'created_at',
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                    ]
                ])
            ],
            [
                //'label'=>'Versión del Equipo',
                'attribute'=>'eqversion',
                'filter'=>[
                    'V1'        => 'V1',
                    'V2'        => 'V2',
                    'V3'        => 'V3',
                    'V4'        => 'V4',
                    'V5'        => 'V5',
                    'V6'        => 'V6',
                    'Tablet'    => 'Tablet',
                ],
                'value'=> function($data){
                    return $data->eqversion;
                }
            ],
            [
                //'label'=>'Estade de Entraga',
                'attribute'=>'eqstatus',
                'filter'=>[
                    'operativo'=>'Operativo',
                    'inoperativo'=>'Inoperativo',
                ],
                'value'=> function($data){
                    return $data->eqstatus;
                }
            ],
            [
                'label'=>'Representante',
                'attribute'=>'nombre',
                'value'=> function($data){
                    return $data->getCanrepresentante()->nombre;
                }
            ],
            [
                'label'=>'Estade de Entraga',
                'attribute'=>'status',
                'filter'=>[
                    '1'=>'Entregado',
                    '0'=>'No entregado',
                ],
                'value'=> function($data){
                    return $data->status == 1 ? 'Entregado' : 'No entregado';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Action',
                'headerOptions'=>['width'=>'60'],
                'template'=>'{marcar}{view}{update}{delete}',
                'buttons'=> [
                    'marcar' => function($data){
                    //'<span class="glyphicon glyphicon-remove-circle"></span>',para desmarcar el equipo
                        return Html::a(
                            '<span class="glyphicon glyphicon-ok-circle"></span>',
                            $data
                        );
                    },
                    'view' => function($data){
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            $data
                        );
                    },
                    'update' => function($data){
                        return Html::a(
                            '<span class="glyphicon glyphicon-pencil"></span>',
                            $data
                        );
                    },
                    'delete' => function($data){
                        return Html::a(
                            '<span class="glyphicon glyphicon-remove"></span>',
                            $data
                        );
                    },
                ],
            ],
        ],
    ]); ?>


</div>
