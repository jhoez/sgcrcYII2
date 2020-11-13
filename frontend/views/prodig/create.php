<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Multimedia */

$this->title = 'Subir Proyecto Digital';
$this->params['breadcrumbs'][] = ['label' => 'Proyectos Digitales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prodig-create">
    <p>
        <?= Html::a('Proyectos Digitales', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Registros', ['registros'], ['class' => 'btn btn-primary']) ?>
    </p>

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'proyecto'	=> $proyecto,
        'multimedia'=> $multimedia
    ]) ?>

</div>
