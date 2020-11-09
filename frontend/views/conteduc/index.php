<?php

use yii\helpers\Html;
use yii\bootstrap\Tabs;
//use yii\jui\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\LibrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contenido Educativo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contenido-index">

    <p>
        <?= Html::a('Subir libro', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Registros', ['registros'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="">
        <?=Tabs::widget([
            'items' => [
                [
                    'label' => 'Inicial',
                    'content' => $this->render('_viewi',['contenido'=>$contenido]),
                    'active' => true,
                    'headerOptions' => ['role'=>'presentation'],// tag li
                    'options' => ['id' => 'inicial','data-toggle'=>'tab'],//tag a
                ],
                [
                    'label' => 'Primaria',
                    'content' => $this->render('_viewp',['contenido'=>$contenido]),
                    'headerOptions' => ['role'=>'presentation'],// tag li
                    'options' => ['id' => 'primaria','data-toggle'=>'tab'],//tag a
                    'itemOptions' => ['tag' => 'div'],
                ],
                [
                    'label' => 'Media',
                    'content' => $this->render('_viewm',['contenido'=>$contenido]),
                    'headerOptions' => ['role'=>'presentation'],// tag li
                    'options' => ['id' => 'media','data-toggle'=>'tab'],//tag a
                    'itemOptions' => ['tag' => 'div'],
                ],
                [
                    'label' => 'Maestro',
                    'content' => $this->render('_viewma',['contenido'=>$contenido]),
                    'headerOptions' => ['role'=>'presentation'],// tag li
                    'options' => ['id' => 'maestro','data-toggle'=>'tab'],//tag a
                    'itemOptions' => ['tag' => 'div'],
                ],
                [
                    'label' => 'Lectura',
                    'content' => $this->render('_viewl',['contenido'=>$contenido]),
                    'headerOptions' => ['role'=>'presentation'],// tag li
                    'options' => ['id' => 'lectura','data-toggle'=>'tab'],//tag a
                    'itemOptions' => ['tag' => 'div'],
                ],
            ],
            //'options' => ['tag' => 'div'],
            //'itemOptions' => ['tag' => 'div'],
            'options'=>['class'=>'nav nav-pills  nav-justified'],
            //'clientOptions' => ['collapsible' => false],
        ]);
        ?>
    </div>

</div>
