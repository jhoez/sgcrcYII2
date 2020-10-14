<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Libros */

$this->title = 'Actualizar Libro: ' . $model->nomblib;
$this->params['breadcrumbs'][] = ['label' => 'Contenido Educativo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->tittle;
?>
<div class="contenido-update">

    <p>
        <?= Html::a('Subir libro', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
