<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usuario */

$this->title = 'Actualizar';
$this->params['breadcrumbs'][] = ['label' => 'Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-update">
    <p>
        <?= Html::a('Usuarios registrados', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'usuario' => $usuario,
    ]) ?>

</div>
