<?php

/* @var $this yii\web\View */
use yii\bootstrap\Carousel;
use yii\helpers\Html;
$this->title = 'SGCRC';
?>

<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-9">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php for ($i=0; $i < (int)$contador; $i++): ?>
                            <?php if ($i === 0): ?>
                                <li data-target="#myCarousel" data-slide-to="<?=$i ?>" class="active"></li>
                            <?php else: ?>
                                <li data-target="#myCarousel" data-slide-to="<?=$i ?>"></li>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" style="height:500px">
                        <?php for($i = 0; $i < (int)$contador; $i++): ?>
                            <?php if ($i === 0): ?>
                                <div class="item active">
                                    <div class="col-md-12">
                                        <a href="" class="carousel-item" href="#<?=$i ?>">
                                            <img src="<?=\Yii::$app->request->baseUrl.'/'.$carousel[$i]->ruta.$carousel[$i]->nombimg.'.'.$carousel[$i]->extension ?>" alt="Lights" style="width:100%;">
                                        </a>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="item">
                                    <div class="col-md-12">
                                        <a href="" class="carousel-item" href="#<?=$i ?>">
                                            <img src="<?=\Yii::$app->request->baseUrl.'/'.$carousel[$i]->ruta.$carousel[$i]->nombimg.'.'.$carousel[$i]->extension ?>" alt="Lights" style="width:100%;">
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <h3 class="col-lg-12">
                    Fundación Bolivariana de Informática y Telemática,
                    ente adscrito al MPPE Impulsamos las políticas del
                    Sistema Educativo Nacional a través del uso de las TIC.
                </h3>
            </div>

            <div class="col-lg-3">
                <a class="twitter-timeline" href="https://twitter.com/Fundabit_" data-widget-id="302069386464870402">Tweets por @FundabitOficial</a>
            </div>
        </div>

    </div>
</div>


<script type="text/javascript">
// twitter
document.addEventListener('DOMContentLoaded', function() {
    !function(d,s,id){
        var js,fjs=d.getElementsByTagName(s)[0];
        if(!d.getElementById(id)){
            js=d.createElement(s);
            js.id=id;
            js.src="//platform.twitter.com/widgets.js";
            fjs.parentNode.insertBefore(js,fjs);
        }
    }(document,"script","twitter-wjs");
});
</script>
