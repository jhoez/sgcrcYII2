<div class="wrap">
    <div class="container">
        <?php
        //$size = filesize('@web/'.$contenido->ruta.$contenido->nomblib.'.'.$contenido->extension);
        //header("Content-Type: application/force-download");
        //header("Content-Disposition: attachment; filename=$contenido->nomblib.'.'.$contenido->extension");
        //header("Content-Transfer-Encoding: binary");
        //header("Content-Lenght:". $size);
        //readfile($path);//descargar archivo
        return Yii::$app->controller->redirect('@web/'.$contenido->ruta.$contenido->nomblib.'.'.$contenido->extension);
        ?>
    </div>
</div>
