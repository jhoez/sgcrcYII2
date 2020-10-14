<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Multimedia */

$this->title = 'Actualizar Proyectos Digitales: ' . $model->nombmult;
$this->params['breadcrumbs'][] = ['label' => 'Proyectos Digitales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodig-update">

    <p>
        <?= Html::a('Proyectos registrados', ['registros'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
