<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Imagen */

$this->title = 'Subir img Carousel';
$this->params['breadcrumbs'][] = ['label' => 'Carousel', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="img-create">
    <p>
        <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'carousel' => $carousel,
    ]) ?>

</div>
