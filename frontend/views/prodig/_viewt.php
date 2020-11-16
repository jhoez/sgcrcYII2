<?php
use yii\helpers\Html;
use buttflattery\videowall\Videowall;
?>

<h4 class="text-center">Tutoriales</h4>
<div class="row clearfix">
	<?php foreach ($prodig as $value): ?>
		<?php if($value->tipomult == 'tutorial'):	?>
			<div class="col-md-4">
				<div class="card text-center">
					<div align="center" class="embed-responsive embed-responsive-16by9">
						<video controls class="embed-responsive-item">
							<source src="<?=Yii::$app->request->baseUrl.'/'.$value->ruta.$value->nombmult.'.'.$value->extension ?>" type="video/mp4">
						</video>
					</div>
					<h1 class="text-center" style="overflow:hidden; font-size:14px;">
						<?=Html::encode($value->nombmult);?>
					</h1>
					<p>
						<?= Html::a(
							Html::img('@web/fonts/download.svg'),
							['/prodig/descva','param'=>$value->idmult],
							['class' => 'btn btn-default']
						)?>
					</p>
				</div>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
