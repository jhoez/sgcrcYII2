<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Realaum */

$this->title = 'Subir Proyecto';
$this->params['breadcrumbs'][] = ['label' => 'Realidad Aumentada', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rea-create">
    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Realidad Aumentada', ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Registros', ['regrea'], ['class' => 'btn btn-primary']) ?>
        </p>
    <?php endif; ?>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'proyecto'=>$proyecto,
        'realidadaumentada'=>$realidadaumentada,
        'imag'=>$imag
    ]) ?>

</div>
