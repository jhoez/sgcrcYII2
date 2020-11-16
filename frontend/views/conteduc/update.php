<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Libros */

$this->title = 'Actualizar Libro: ' . $contenido->nomblib;
$this->params['breadcrumbs'][] = ['label' => 'Contenido Educativo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contenido-update">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Subir libro', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'contenido' => $contenido,
        'img'=>$img
    ]) ?>

</div>
