<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Realaum */

$this->title = 'Update Realaum: ' . $model->idra;
$this->params['breadcrumbs'][] = ['label' => 'Realaums', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idra, 'url' => ['view', 'id' => $model->idra]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="realaum-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
