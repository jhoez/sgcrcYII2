<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- BANNER DE FUNDABIT 
<div class="row">
   Html::img(Yii::$app->request->baseUrl."/img/bannerfundabit.png", ['width' =>'100%']);
</div>
-->

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems = [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Contenido Educativo', 'url' => ['/conteduc/index']],
            ['label' => 'Proyectos Digitales', 'url' => ['/prodig/index']],
            ['label' => 'Realidad Aumentada', 'url' => ['/rea/index']],
            ['label' => 'Acerca de', 'url' => ['/site/about']],
            ['label' => 'Contactanos', 'url' => ['/site/contact']],
            ['label' => 'Iniciar Session', 'url' => ['/site/login']]
        ];
    } else {
        $menuItems = [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Contenido Educativo', 'url' => ['/conteduc/index']],
            ['label' => 'Proyectos Digitales', 'url' => ['/prodig/index']],
            ['label' => 'Realidad Aumentada', 'url' => ['/rea/index']],
            ['label' => 'Tutor', 'url' => ['/canaimita/index']],
            //['label' => 'Crear Cuenta', 'url' => ['/site/signup']],
        ];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Salir (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">
            Esq. de Salas a Caja de Agua, Edif.
            Sede del Ministerio del Poder Popular para la Educación (MPPE),
            Parroquia Altagracia, Dtto. Capital, Caracas- Venezuela,
            Teléfonos: (+58-212) 506.88.15 - RIF: G-20003142-5
        </p>
        <p class="pull-right">
            <ul>
                <li><?=Html::a('Misión y Vision',['site/mv'], ['class'=>'white-text'] ); ?></li>
                <li><?=Html::a('Objetivos',['site/obj'], ['class'=>'white-text'] ); ?></li>
                <li><?=Html::a('Valores',['site/v'], ['class'=>'white-text'] ); ?></li>
            </ul>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
