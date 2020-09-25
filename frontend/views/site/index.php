<?php

/* @var $this yii\web\View */

$this->title = 'SGCRC';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="col-md-4">
                            <a href="" class="carousel-item" href="#0">
                                <img src="<?=Yii::$app->request->baseUrl;?>/img/logo.jpg" alt="Lights" style="width:100%;">
                                <div class="caption">
                                    <p>Normas de convivencia comunal</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="col-md-4">
                            <a href="" class="carousel-item" href="#1">
                                <img src="<?=Yii::$app->request->baseUrl;?>/img/logo.jpg" alt="Lights" style="width:100%;">
                                <div class="caption">
                                    <p>Medicina Felina</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="item">
                        <div class="col-md-4">
                            <a href="" class="carousel-item" href="#2">
                                <img src="<?=Yii::$app->request->baseUrl;?>/img/logo.jpg" alt="Lights" style="width:100%;">
                                <div class="caption">
                                    <p>leishmaniosis en perros</p>
                                </div>
                            </a>
                        </div>
                    </div>
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

            <h3 class="">
                Fundación Bolivariana de Informática y Telemática, 
                ente adscrito al MPPE Impulsamos las políticas del 
                Sistema Educativo Nacional a través del uso de las TIC.
            </h3>
            <div class="col s12 l4">
                <a class="twitter-timeline" href="https://twitter.com/FundabitOficial" data-widget-id="302069386464870402">Tweets por @FundabitOficial</a>
            </div>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
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