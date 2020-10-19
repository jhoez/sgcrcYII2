<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Realaum */

$this->title = 'Crear Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos Realidad Aumentada', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rea-create">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'proyecto'=>$proyecto,
        'realidadaumentada'=>$realidadaumentada,
        'imag'=>$imag
    ]) ?>

</div>
