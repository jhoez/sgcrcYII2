<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Imagen */

$this->title = 'Update Imagen: ' . $model->idimag;
$this->params['breadcrumbs'][] = ['label' => 'Imagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idimag, 'url' => ['view', 'id' => $model->idimag]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="imagen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
