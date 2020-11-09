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
<body class="imgcuerpo">
<?php $this->beginBody() ?>


<!-- BANNER DE FUNDABIT -->
<div class="">
    <?= Html::img(Yii::$app->request->baseUrl."/img/bannerfundabit.png", ['width' =>'100%']); ?>
</div>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-inverse',
            //'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems = [
            ['label' => 'Contenido Educativo', 'url' => ['/conteduc/index']],
            ['label' => 'Proyectos Digitales', 'url' => ['/prodig/index']],
            ['label' => 'Realidad Aumentada', 'url' => ['/rea/index']],
            ['label' => 'Iniciar Session', 'url' => ['/site/login']],
            //['label' => 'Crear Cuenta', 'url' => ['/site/signup'],'visible'=>!Yii::$app->user->isGuest],
        ];
    } else {
        $menuItems = [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Contenido Educativo', 'url' => ['/conteduc/index']],
            ['label' => 'Proyectos Digitales', 'url' => ['/prodig/index']],
            ['label' => 'Realidad Aumentada', 'url' => ['/rea/index']],
            ['label' => 'Tutor', 'url' => ['/canaimita/index']],
            ['label' => 'Administrar Usuarios', 'url' => ['/usuario/index']],
        ];
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Cerrar Session (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        //'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>


    <div class="wrapper">
        <div class="container">
            <?php if (!Yii::$app->user->isGuest): ?>
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
            <?php endif; ?>
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer" style="background-color:#000;height:31%;color:#c6b9b9;">
  <div class="container text-left">
      <div class="col-md-6 col-xl-6">
          <h6 class="text-uppercase" style="color:#2855c7;">Dirección</h6>
          <hr style="border-color:#28c74b;">
          <p>
              Esq. de Salas a Caja de Agua, Edif.
              Sede del Ministerio del Poder Popular para la Educación (MPPE),
              Parroquia Altagracia, Dtto. Capital, Caracas- Venezuela,
              Teléfonos: (+58-212) 506.88.15 - RIF: G-20003142-5
          </p>
      </div>
      <div class="col-md-3 col-xl-6">
          <h6 class="text-uppercase"  style="color:#2855c7;">Acerca de Fundabit</h6>
          <hr style="border-color:#28c74b;">
          <p><?=Html::a('Misión y Vision',['site/mv'], ['class'=>''] ); ?></p>
          <p><?=Html::a('Objetivos',['site/obj'], ['class'=>''] ); ?></p>
          <p><?=Html::a('Valores',['site/v'], ['class'=>''] ); ?></p>
      </div>
      <div class="col-md-3 col-xl-6">
          <h6 class="text-uppercase" style="color:#2855c7;">Coordinación Zonal Distrito Capital</h6>
          <hr style="border-color:#28c74b;">
          <p><i class="glyphicon glyphicon-envelope"></i> correo</p>
          <p><i class="glyphicon glyphicon-phone-alt"></i> numero</p>
          <p><i class="glyphicon glyphicon-phone-alt"></i> numero</p>
      </div>
  </div>
  <!-- Copyright -->
  <div class="footer-copyright text-center">
    <p>© 2020 Copyright: Fundabit.</p>
  </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
