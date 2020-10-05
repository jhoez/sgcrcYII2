<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Formato */

$this->title = 'Subir Formato';
$this->params['breadcrumbs'][] = ['label' => 'Canaimitas', 'url' => ['/canaimita/index']];
$this->params['breadcrumbs'][] = ['label' => 'Formatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="formato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'formato' => $formato,
    ]) ?>

</div>
