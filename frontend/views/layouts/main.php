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
            ['label' => 'Contenido Educativo', 'url' => ['/conteduc/index']],
            ['label' => 'Proyectos Digitales', 'url' => ['/prodig/index']],
            ['label' => 'Realidad Aumentada', 'url' => ['/rea/index']],
            //['label' => 'Acerca de', 'url' => ['/site/about']],
            //['label' => 'Contactanos', 'url' => ['/site/contact']],
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
            ['label' => 'Usuario', 'url' => ['/usuario/index']],
            ['label' => 'Administrar Usuario', 'url' => ['/admin']],
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
      <div class="col-md-6 col-xl-6">
        <!-- Content -->
        <h6 class="text-uppercase">Dirección</h6>
        <p>
            Esq. de Salas a Caja de Agua, Edif.
            Sede del Ministerio del Poder Popular para la Educación (MPPE),
            Parroquia Altagracia, Dtto. Capital, Caracas- Venezuela,
            Teléfonos: (+58-212) 506.88.15 - RIF: G-20003142-5
        </p>

      </div>
      <!-- Grid column -->
      <div class="col-md-3 col-xl-6">
        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Acerca de Fundabit</h6>
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
      <div class="col-md-3 col-xl-6">
        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Coordinación Zonal Distrito Capital</h6>
        <p><i class=""></i> correo</p>
        <p><i class=""></i> numero</p>
        <p><i class=""></i> numero</p>
      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row -->
  </div>
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center">
    <p>© 2020 Copyright: Fundabit.</p>
  </div>
  <!-- Copyright -->
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
