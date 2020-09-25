<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="row clearfix">
	<div class="col-md-offset-2 col-md-8 col-md-offset-2">
		<div class="well">
			<h2>Inicio de Session</h2>
			<img src="<?=Yii::$app->request->baseUrl;?>/img/logo.jpg">
			<?php $form=ActiveForm::begin([
				'id'=>'form'
			]);?>
			<div class="form-group">
				<?=$form->field($model,'username')->textInput(['autofocus' => true,'class' => 'form-control imput-md']);?>
			</div>
			<div class="form-group">
				<?=$form->field($model,'password')->passwordInput(['class' => 'form-control imput-md']);?>
			</div>
			<div class="form-group">
				<?=Html::submitButton('Ingresar',['class'=>'btn btn-primary']);?>
			</div>
			<?php $form->end();?>
		</div>
	</div>
</div>