<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use kartik\date\DatePicker;
use yii\bootstrap\Tabs;
//use yii\jui\Tabs;

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

    <br>

    <?php
    $canaimitas = Yii::$app->controller->renderPartial('_viewc',[
    'cdataProvider'=>$cdataProvider,
    'csearchModel'=>$csearchModel
    ]);
    $formatos = Yii::$app->controller->renderPartial('_viewf',[
        'fdataProvider'=>$fdataProvider,
        'fsearchModel'=>$fsearchModel,
        'actasArray'=>$actasArray
    ]);?>
    <div class="">
    <?php
    echo Tabs::widget([
        'items' => [
            [
                'label' => 'Canaimitas',
                'content' => $canaimitas,
                //'active' => true,
                'headerOptions' => ['role'=>'presentation'],// tag li
                'options' => ['id' => 'canaimitas','data-toggle'=>'tab'],//tag a
            ],
            [
                'label' => 'Formatos',
                'content' => $formatos,
                'headerOptions' => ['role'=>'presentation'],// tag li
                'options' => ['id' => 'formatos'],//tag a
                'itemOptions' => ['tag' => 'div'],
            ],
        ],
        //'options' => ['tag' => 'div'],
        //'itemOptions' => ['tag' => 'div'],
        'options'=>['class'=>'nav nav-pills'],
        //'clientOptions' => ['collapsible' => false],
    ]);
    ?>

</div>
