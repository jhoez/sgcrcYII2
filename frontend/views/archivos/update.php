<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Formato */

$this->title = 'Actualizar Archivo: ' . Html::encode($archivos->nombf.'.'.$archivos->extens);
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = ['label' => 'Archivos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="archivo-update">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Archivos registrados', ['index'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'archivos' => $archivos,
    ]) ?>

</div>
