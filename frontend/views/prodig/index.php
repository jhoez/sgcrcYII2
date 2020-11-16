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
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Subir Proyecto', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Registros', ['registros'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="">
        <?=Tabs::widget([
            'items' => [
                [
                    'label' => 'Proyectos Audioviasuales',
                    'content' => $this->render('_viewv',['prodig'=>$prodig]),
                    'active' => true,
                    'headerOptions' => ['role'=>'presentation'],// tag li
                    'options' => ['id' => 'audiovisual','data-toggle'=>'tab'],//tag a
                ],
                [
                    'label' => 'Micros Audioradiales',
                    'content' => $this->render('_viewa',['prodig'=>$prodig]),
                    'headerOptions' => ['role'=>'presentation'],// tag li
                    'options' => ['id' => 'microaudiovisual','data-toggle'=>'tab'],//tag a
                    'itemOptions' => ['tag' => 'div'],
                ],
                [
                    'label' => 'Tutoriales',
                    'content' => $this->render('_viewt',['prodig'=>$prodig]),
                    'headerOptions' => ['role'=>'presentation'],// tag li
                    'options' => ['id' => 'tutoriales','data-toggle'=>'tab'],//tag a
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
