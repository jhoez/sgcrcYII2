<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\bootstrap\Tabs;
//use yii\jui\Tabs;
use kartik\date\DatePicker;
//use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\EquipoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Canaimitas';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="canaimita-index">

    <p>
        <?= Html::a('Registrar Canaimita', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Crear Reportes',['reportespdf'],['class'=>'btn btn-primary']);?>
        <?= Html::a('Archivos',['/archivos/index'],['class'=>'btn btn-primary']);?>
        <?= Html::a('Asistencia',['/horario/index'],['class'=>'btn btn-primary']);?>
        <?= Html::a('Carousel', ['/carousel/index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php // $this->render('_search', ['model' => $csearchModel]); ?>

    <div class="table-responsive">
        <h3 class="text-center">Canaimitas registradas</h3>
        <hr>
        <?= GridView::widget([
            'id'=>'cgrid',
            'dataProvider' => $cdataProvider,
            'filterModel' => $csearchModel,
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
                        'model' => $csearchModel,
                        'attribute' => 'frecepcion',
                        'type' => DatePicker::TYPE_BUTTON,//'type' => DatePicker::TYPE_INPUT,
                        'options' => ['placeholder' => '0000-00-00'],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ])
                ],
                [
                    'attribute'=>'fentrega',
                    'value'=>function($data){
                        return $data->fentrega != null ? $data->fentrega : 'sin fecha' ;
                    },
                    'filter'=> DatePicker::widget([
                        'model' => $csearchModel,
                        'attribute' => 'fentrega',
                        'type' => DatePicker::TYPE_BUTTON,
                        'options' => ['placeholder' => '0000-00-00'],
                        'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'yyyy-mm-dd'
                        ]
                    ])
                ],
                [
                    'label'=>'Versión del Equipo',
                    'attribute'=>'eqversion',
                    'filter'=> Html::activeDropDownList(
                        $csearchModel,'eqversion',
                        ArrayHelper::map($arrayversequipo,'nombcata','nombcata'),
                        ['prompt' => '','class' => 'form-control imput-md']
                    ),
                    'value'=> function($data){
                        return $data->eqversion;
                    }
                ],
                [
                    'label'=>'Status del Equipo',
                    'attribute'=>'eqstatus',
                    'filter'=> Html::activeDropDownList(
                        $csearchModel,'eqstatus',
                        [
                            'operativo'=>'Operativo',
                            'inoperativo'=>'Inoperativo',
                        ],
                        ['prompt' => '','class' => 'form-control imput-md']
                    ),
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
                    'label'=>'Estado de Entraga',
                    'attribute'=>'status',
                    'filter'=> Html::activeDropDownList(
                        $csearchModel,'status',
                        [
                            '1'=>'Entregado',
                            '0'=>'No entregado',
                        ],
                        ['prompt' => '','class' => 'form-control imput-md']
                    ),
                    'value'=> function($data){
                        return $data->status == true ? 'Entregado' : 'No entregado';
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header'=>'Acción',
                    'headerOptions'=>['width'=>'70'],
                    'template'=>'{marcar}{view}{update}{delete}',
                    'buttons'=> [
                        'marcar' => function($url,$model){
                            if ( \Yii::$app->user->can('administrador') && $model->status == false) {
                                return Html::a(
                                    Html::img('@web/fonts/checked.svg'),
                                    $url
                                );
                            }
                        },
                        'view' => function($url,$model){
                            return Html::a(
                                Html::img('@web/fonts/view.svg'),
                                $url
                            );
                        },
                        'update' => function($url,$model){
                            //if ( \Yii::$app->user->can('superadmin') ) {
                                return Html::a(
                                    Html::img('@web/fonts/pencil.svg'),
                                    $url
                                );
                            //}
                        },
                        'delete' => function($url,$model){
                            if ( \Yii::$app->user->can('superadmin') ) {
                                return Html::a(
                                    Html::img('@web/fonts/cross.svg'),
                                    $url
                                );
                            }
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
