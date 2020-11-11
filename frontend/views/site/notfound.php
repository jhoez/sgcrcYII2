<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row clearfix">
    <div class="col-md-offset-3 col-md-6">
		<h1 class="text-center">
			<strong><?php if(!empty($msj)) echo $msj; ?>!!</strong> <i class="glyphicon glyphicon-warning"></i>
		</h1>
        <div class="text-center">
            <?= Html::a(
                Html::img('@web/fonts/left.svg'),
                Url::to(['index']),
                ['class' => 'btn btn-primary',]
            );
            ?>
        </div>
	</div>
</div>
