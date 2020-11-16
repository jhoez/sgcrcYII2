<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $carousel frontend\models\Imagen */

$this->title = 'Actualizar Carousel: ' . $carousel->nombimg.'.'.$carousel->extension;
$this->params['breadcrumbs'][] = ['label' => 'Carousel', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizar';
?>
<div class="img-update">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'carousel' => $carousel,
    ]) ?>

</div>
