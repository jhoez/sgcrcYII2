<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Formato */

$this->title = 'Actualizar Formato Subir: ' . $model->idf;
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = ['label' => 'Formatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idf, 'url' => ['view', 'id' => $model->idf]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="formato-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
