<?php
use yii\helpers\Html;
?>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-6 col-md-offset-3">
            <?php if (!Yii::$app->user->isGuest): ?>
                <p>
                    <?= Html::a('Misión y Visión', ['mv'], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Objetivos', ['obj'], ['class' => 'btn btn-primary']) ?>
                </p>
            <?php endif; ?>
            <h4 class="text-center">Valores</h4>
            <p class="text-left">
                <b>Excelencia:</b> Preocupación constante por la calidad del trabajo que se ejecuta, tras imprimirle eficacia al ejercicio profesional. Cumplimiento de los compromisos adquiridos con la mayor calidad, en función de la misión y teniendo como norte la visión de la institución.
                <br><br>
                Mantener una actitud de superación, mediante el reconocimiento de los propios errores, con la visión de corregirlos, optimizando la actividad.
                <br><br>
                <b>Responsabilidad:</b> Cumplir de manera oportuna y eficaz con aquellas labores inherentes al ejercicio de una profesión.
                <br><br>
                Compromiso de asumir las actividades hasta su culminación, atendiendo a todas sus implicaciones.
                <br><br>
                Capacidad y disposición para responder de los actos propios y en algunos casos de los ajenos.
            </p>
        </div>
    </div>
</div>
