<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Libros */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
        <div class="contenido-form">
            <?php $form = ActiveForm::begin([
                'id'=>'contenidoform',
                'enableClientValidation'=>true,
                //'enableAjaxValidation' => true,
                'options'=>['enctype' => 'multipart/form-data']
            ]); ?>
            <?php if(!$contenido->isNewRecord){
        		$select = [
                    'prompt' => '---- Seleccione ----',
        			'class' => 'form-control imput-md'
        		];
        	}else {
        		$select = [
        			'prompt' => '---- Seleccione ----',
        			'onchange' => 'obtenerValorForUpdate()',
        			'class' => 'form-control imput-md'
        		];
        	} ?>

            <h3 class="text-center">Formulario</h3>

            <div class="form-group">
                <?= Html::label('Coleccion', 'coleccion', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $contenido,'coleccion',
                        [
                            'coleccionBicentenaria'		=>	'Coleccion Bicentenaria',
        	                'coleccionMaestros'			=>	'Coleccion Maestro',
        	                'lectura'					=>	'Lectura Sugerida'
                        ],
                        $select
                    )?>
                </div>
            </div>

            <div class="form-group" id="selectlist" style="display:none">
                <?= Html::label('Nivel', 'nivel', ['class' => ''])?>
                <div class="">
                    <?= Html::activeDropDownList(
                        $contenido,'nivel',
                        [
                            'inicial'	=>	'Inicial',
        	                'primaria'	=>	'Primaria',
        	                'media'		=>	'Media'
                        ],
                        ['prompt' => '---- Seleccione ----','class' => 'form-control imput-md']
                    )?>
                </div>
            </div>

            <!-- IMAGEN -->
            <div class="form-group">
                <?php	if (!$img->isNewRecord) {?>
                    <div class="">
                            <?php echo "Portada a ser reemplazada: " . $img->nombimg;?>
                    </div>
                <?php } ?>
                <div class="">
                    <?=$form->field($img,'imagen')->fileInput() ?>
                </div>
                <div id="divimg" style="display:none">
                    <img id="imgSalida" width="200" height="200">
                </div>
            </div>
            <!-- ARCHIVO PDF -->
            <div class="form-group">
                <?php	if (!$contenido->isNewRecord) {?>
                    <div class="">
                            <?php	echo "Libro a ser reemplazado: " . $contenido->nomblib;?>
                    </div>
                <?php } ?>
                <div class="">
                    <?= $form->field($contenido, 'files')->fileInput(); ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Subir Libro', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

    </div>
</div>

<script type="text/javascript">
	function obtenerValorForUpdate(){
		var select = document.getElementById('libros-coleccion');
		var valor = select.options[select.selectedIndex].value;
		//alert(valor);
		//var valor = select.options[select.selectedIndex].innerText;// devuelve la opción del select no el valor
		if (valor == 'coleccionBicentenaria') {
			document.getElementById('selectlist').style.display = 'block';
		}else {
			document.getElementById('selectlist').style.display = 'none';
		}
	}

    // captura el evento del primer selector
	window.addEventListener('load',function(){
		var select = document.getElementById('libros-coleccion');
		var valor = select.options[select.selectedIndex].value;
		//alert(valor);
		//var valor = select.options[select.selectedIndex].innerText;// devuelve la opción del select no el valor
		if (valor == 'coleccionBicentenaria') {
			document.getElementById('selectlist').style.display = 'block';
		}else {
			document.getElementById('selectlist').style.display = 'none';
		}
	});

    // Cargar la imagen
    // Obtener referencia al input y a la imagen
    const $divimg = document.getElementById('divimg');
    const $imgselec = document.querySelector("#input-file");
    const $viewimagen = document.querySelector("#imgSalida");

    // Escuchar cuando cambie
    $imgselec.addEventListener('change', () => {
        $divimg.style.display= 'block';
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = $imgselec.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            $viewimagen.src = "";
            return;
        }
        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        $viewimagen.src = objectURL;
    });
</script>
