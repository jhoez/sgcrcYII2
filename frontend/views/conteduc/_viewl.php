<?php
use yii\helpers\Html;
?>

<h4 class="text-center">Lectura Sugerida</h4>
<div class="row clearfix">
	<?php foreach ($contenido as $value) { ?>
			<?php if($value->nivel == 'lectura'){	?>
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
									Html::img('@web/fonts/view.svg'),
									['/conteduc/verlib','param'=>$value->idlib],
									[
										'class' => 'btn btn-default',
										'data'=>['method'=>'post'],
										'target'=>'blank'
									]

								)?>
								<?= Html::a(
									Html::img('@web/fonts/download.svg'),
									['/conteduc/desclib','param'=>$value->idlib],
									[
										'class' => 'btn btn-default',
										'data'=>['method'=>'post']
									]
								)?>
							</p>
					   </div>
					</div>
			<?php }	?>
	<?php } ?>
</div>
