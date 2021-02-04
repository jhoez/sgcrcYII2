<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<div class="formulario">
	<?=Html::img(Yii::$app->request->baseUrl."/img/logo.jpg",['class'=>'logofb']) ?>
	<?php $form=ActiveForm::begin([
		'id'=>'logon-form',
	]);?>
		<div class="form-group">
			<div class="col-md-12">
				<?=$form->field($loginform,'username')->textInput(['autofocus' => true,'class' => 'form-control imput-md']);?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-12">
				<?=$form->field($loginform,'password')->passwordInput(['class' => 'form-control imput-md']);?>
			</div>
		</div>

		<!--<div class="form-group">
			<div class="col-md-12">
				<?//= $form->field($loginform, 'rememberMe')->checkbox() ?>
			</div>
			<div class="col-md-12" style="color:#999;margin:1em 0">
	            Cambiar tu contraseña
	            <?//= Html::a('Aqui', ['site/request-password-reset']) ?>.
	            <br>
	            Verifica tu correo
	            <?//= Html::a('Aqui', ['site/resend-verification-email'])?>
	        </div>
	    </div>-->

		<div class="form-group">
			<div class="col-md-12">
				<?=Html::submitButton('Ingresar',['class'=>'btn btn-primary']);?>
			</div>
		</div>
	<?php $form->end();?>
</div>
