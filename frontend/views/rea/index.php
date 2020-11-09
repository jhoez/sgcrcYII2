<?php

use yii\helpers\Html;

$this->title = 'Proyectos Realidad Aumentada';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rea-index">

    <p>
        <?= Html::a('Subir Proyecto', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Registros', ['regrea'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

</div>


<div class="row clearfix">
    <?php foreach ($realidadaumentada as $value): ?>
        <div class="col-md-2">
            <div class="card text-center">
                <?= Html::img(
                    Yii::$app->request->baseUrl.'/'.$value->getRaImagen()->ruta.$value->getRaImagen()->nombimg.'.'.$value->getRaImagen()->extension,
                    ['id' => '','width'=>160]
                ); ?>
                <h1 class="text-center" style="overflow:hidden; font-size:14px;">
                <?=Html::encode($value->getRaImagen()->nombimg);?>
                </h1>
                <p>
                    <?= Html::a(
                        'Ver libro',
                        [
                            '/rea/ra',
                            'param'=>$value->idra
                        ],
                        [
                            'class' => 'btn btn-primary',
                            /*'data'=>[
                                'method'=>'post'
                            ],*/
                            'target'=>'_blank'
                        ]
                    )?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>
