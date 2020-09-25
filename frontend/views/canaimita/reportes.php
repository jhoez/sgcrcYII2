<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

$this->title = 'Reportes';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Canaimitas registradas', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Registrar Canaimita',['/canaimita/create'],['class'=>'btn btn-primary']);?>
        <?= Html::a('Subir Formato',['/descargables/create'],['class'=>'btn btn-primary']);?>
    </p>
</div>
