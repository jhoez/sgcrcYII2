<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Realaum */

$this->title = 'Subir Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos Realidad Aumentada', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rea-create">
    <p>
        <?= Html::a('Proyectos Realidad Aumentada', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Registros', ['regrea'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'proyecto'=>$proyecto,
        'realidadaumentada'=>$realidadaumentada,
        'imag'=>$imag
    ]) ?>

</div>
