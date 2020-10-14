<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
		<h1 class="text-center">
			<strong>!!</strong> <i class="glyphicon glyphicon-warning"></i>
		</h1>
	</div>
</div>
<script type="text/javascript">
	<?php if(Yii::$app->session->hasFlash('error')){ ?>
		window.addEventListener('load', function(){
			Swal.fire({
				icon: 'error',
				title: "<?php echo Yii::$app->session->hasFlash('error')?>",
                //text: "<?//php echo Yii::$app->session->hasFlash('error')?>",
				showConfirmButton: false,
				timer: 3500 // es ms (mili-segundos)
			});
		});
	<?php } ?>
</script>
