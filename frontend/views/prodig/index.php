<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MultimediaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Proyectos Digitales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodig-index">

    <p>
        <?= Html::a('Subir Multimedia', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Proyectos registrados', ['registros'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Subir img Carousel', ['/portadas/create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="">
        <?=Tabs::widget([
            'items' => [
                [
                    'label' => 'Videos',
                    'content' => $this->render('_viewv',['prodig'=>$prodig]),
                    'active' => true,
                    'headerOptions' => ['role'=>'presentation'],// tag li
                    'options' => ['id' => 'inicial','data-toggle'=>'tab'],//tag a
                ],
                [
                    'label' => 'Audioradial',
                    'content' => $this->render('_viewa',['prodig'=>$prodig]),
                    'headerOptions' => ['role'=>'presentation'],// tag li
                    'options' => ['id' => 'primaria','data-toggle'=>'tab'],//tag a
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

</div>
