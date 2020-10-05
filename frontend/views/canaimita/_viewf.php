<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<div class="">

<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
        <div class="descargables-form">
            <?php $form = ActiveForm::begin([
                'id'=>'descargables',
                //'method' => 'post',
                'action'=>Url::toRoute('/descargables/index'),
                'enableClientValidation'=>true,
                //'enableAjaxValidation' => true,
            ]);?>

            <h3 class="text-center">Actas descargables</h3>
            <div class="form-group">
                <?= Html::label('Actas', 'idf', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $fsearchModel,'idf',
                        ArrayHelper::map($actasArray, 'idf', 'nombf'),
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Descargar', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<h3 class="text-center">Registros de Formatos</h3>
<?= GridView::widget([
    'id'=>'fgrid',
    'dataProvider' => $fdataProvider,
    'filterModel' => $fsearchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label'=>'ID',
            'attribute'=>'idf',
            'value'=>function($data){
                return $data->idf;
            }
        ],
        [
            'label'=>'F subido',
            'attribute'=>'create_at',
            'value'=>function($data){
                return $data->create_at;
            }
        ],
        [
            'label'=>'Opcion',
            'attribute'=>'opcion',
            'value'=>function($data){
                return $data->opcion;
            }
        ],
        [
            'label'=>'Por ver/visto',
            'attribute'=>'nombf',
            'value'=>function($data){
                return $data->nombf;
            }
        ],
        [
            'label'=>'Extensión',
            'attribute'=>'extens',
            'value'=>function($data){
                return $data->extens;
            }
        ],
        [
            'label'=>'Tamaño File',
            'attribute'=>'tamanio',
            'value'=>function($data){
                return $data->tamanio;
            }
        ],
        [
            'label'=>'Status',
            'attribute'=>'status',
            'value'=>function($data){
                return $data->status == true ? 'Visto' : 'Por ver';
            },
            'filter'=>[
                '0'=>'Por ver',
                '1'=>'Visto'
            ]
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header'=>'Action',
            'headerOptions'=>['width'=>'60'],
            'template'=>'{view}{update}{delete}{download}{marcar}',
            'buttons'=> [
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
                'download' => function($url,$model){
                    //formato/verformato
                    return Html::a(
                        '<span class="glyphicon glyphicon-download"></span>',
                        $url
                        //Url::to(["product/download", "id" => implode($id)])
                    );
                },
                'marcar' => function($data){
                    //formato/updatestatus
                    return Html::a(
                        '<span class="glyphicon glyphicon-ok-circle"></span>',
                        $data
                    );
                },
            ],
        ],
    ],
]); ?>

</div>
