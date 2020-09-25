<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Libros */

$this->title = 'Update Libros: ' . $model->idlib;
$this->params['breadcrumbs'][] = ['label' => 'Libros', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idlib, 'url' => ['view', 'id' => $model->idlib]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="libros-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
