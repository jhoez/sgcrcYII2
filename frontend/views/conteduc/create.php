<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Libros */

$this->title = 'Subir Libro';
$this->params['breadcrumbs'][] = ['label' => 'Contenido Educativo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contenido-create">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Contenido Educativo', ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Registros', ['registros'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'contenido' => $contenido,
        'img'=>$img
    ]) ?>

</div>
