<?php
use yii\helpers\Html;
?>

<h4 class="text-center">Coleccion Bicentenaria Media</h4>
<div class="row clearfix">
	<?php foreach ($contenido as $value) { ?>
			<?php if($value->nivel == 'media'){	?>
					<div class="col-md-2">
						<div class="card text-center">
							<?= Html::img(
								Yii::$app->request->baseUrl.'/'.$value->getimagen()->ruta.$value->getimagen()->nombimg.'.'.$value->getimagen()->extension,
								['id' => '','width'=>160]
							); ?>
							<h1 class="text-center" style="overflow:hidden; font-size:14px;">
								<?=Html::encode($value->nomblib);?>
							</h1>
							<p>
								<?= Html::a(
									'Ver libro',
									[
										'/conteduc/desclib',
										'param'=>$value->idlib
									],
									[
										'class' => 'btn btn-primary',
										'data'=>[
											'method'=>'post'
										],
										//'target'=>'_blank'
									]
								)?>
							</p>
					   </div>
					</div>
			<?php }	?>
	<?php } ?>
</div>
