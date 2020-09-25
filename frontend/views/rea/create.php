<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Realaum */

$this->title = 'Create Realaum';
$this->params['breadcrumbs'][] = ['label' => 'Realaums', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="realaum-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
