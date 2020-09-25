<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Multimedia */

$this->title = 'Create Multimedia';
$this->params['breadcrumbs'][] = ['label' => 'Multimedia', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multimedia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
