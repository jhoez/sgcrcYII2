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
            ['label' => 'Iniciar Session', 'url' => ['/site/login']],
            //['label' => 'Crear Cuenta', 'url' => ['/site/signup']],
        ];
    } else {
        $menuItems = [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Contenido Educativo', 'url' => ['/conteduc/index']],
            ['label' => 'Proyectos Digitales', 'url' => ['/prodig/index']],
            ['label' => 'Realidad Aumentada', 'url' => ['/rea/index']],
            ['label' => 'Tutor', 'url' => ['/canaimita/index']],
            ['label' => 'Administrar Usuario', 'url' => ['/admin']],
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
  <!-- Footer Links -->
  <div class="container text-center">
    <!-- Grid row -->
    <div class="row">
      <!-- Grid column -->
      <div class="col-md-3 col-lg-6 col-xl-3">
        <!-- Content -->
        <h6 class="text-uppercase">Dirección</h6>
        <hr>
        <p>
            Esq. de Salas a Caja de Agua, Edif.
            Sede del Ministerio del Poder Popular para la Educación (MPPE),
            Parroquia Altagracia, Dtto. Capital, Caracas- Venezuela,
            Teléfonos: (+58-212) 506.88.15 - RIF: G-20003142-5
        </p>

      </div>
      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2">
        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Acerca de Fundabit</h6>
        <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p>
          <?=Html::a('Misión y Vision',['site/mv'], ['class'=>'dark-grey-text'] ); ?>
        </p>
        <p>
          <?=Html::a('Objetivos',['site/obj'], ['class'=>'dark-grey-text'] ); ?>
        </p>
        <p>
          <?=Html::a('Valores',['site/v'], ['class'=>'dark-grey-text'] ); ?>
        </p>

      </div>
      <!-- Grid column -->
      <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-md-0 mb-4">
        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Contact</h6>
        <hr class="teal accent-3 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
        <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
        <p><i class="fas fa-envelope mr-3"></i> info@example.com</p>
        <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
        <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row -->
  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center text-black-50 py-3">
    <p>© 2020 Copyright: Fundabit.</p>
  </div>
  <!-- Copyright -->
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
