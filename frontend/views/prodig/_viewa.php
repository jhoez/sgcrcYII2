<?php
use yii\helpers\Html;
?>

<h4 class="text-center">Audioradiales</h4>
<div class="row clearfix">
	<?php foreach ($prodig as $value): ?>
		<?php if($value->tipomult == 'audio'):	?>
			<div class="col-md-4">
				<div class="card text-center">
					<div align="center" class="embed-responsive embed-responsive-16by9">
						<audio controls class="embed-responsive-item">
							<source src="<?=Yii::$app->request->baseUrl.'/'.$value->ruta.$value->nombmult.'.'.$value->extension ?>" type="audio/mpeg">
						</audio>
					</div>
					<h1 class="text-center" style="overflow:hidden; font-size:14px;">
						<?=Html::encode($value->nombmult);?>
					</h1>
					<p>
						<?= Html::a(
							'Ver/Descargar',
							[
								'/prodig/descva',
								'param'=>$value->idmult
							],
							[
								'class' => 'btn btn-primary',
								'data'=>[
									'method'=>'post'
								],
								'target'=>'_blank'
							]
						)?>
					</p>
				</div>
			</div>
		<?php endif; ?>
		<?php endforeach; ?>
</div>
