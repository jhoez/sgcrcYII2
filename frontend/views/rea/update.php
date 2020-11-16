<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Realaum */

$this->title = 'Actualizar: ' . $model->nra;
$this->params['breadcrumbs'][] = ['label' => 'Realidad Aumentada', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rea-update">
    <?php if (!Yii::$app->user->isGuest): ?>
        <?= Html::a('Realidad Aumentada', ['index'], ['class' => 'btn btn-primary']) ?>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
