<?php

use yii\helpers\Html;

$this->title = 'Realidad Aumentada';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rea-index">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Subir Proyecto', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Registros', ['regrea'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

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
                        Html::img('@web/fonts/ra3.svg'),
                        ['/rea/ra','param'=>$value->idra],
                        ['class' => 'btn btn-default','target'=>'_blank']
                    )?>
                    <?= Html::a(
                        Html::img('@web/fonts/download.svg'),
                        ['/rea/descra','param'=>$value->idra],
                        ['class' => 'btn btn-default']
                    )?>
                </p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>
