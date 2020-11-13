<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Usuario */

$this->title = 'Detalles';
$this->params['breadcrumbs'][] = ['label' => 'Administrar Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuario-view">

    <p>
        <?= Html::a('Registros', ['index'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1 class="text-center">Usuario: <?= Html::encode($usuario->username) ?></h1>

    <?= DetailView::widget([
        'model' => $usuario,
        'attributes' => [
            [
                'label'=>'Usuario',
                'attribute'=>'username',
                'value'=>function($data){
                    return $data->username;
                },
            ],
            [
                'label'=>'Contraseña',
                'attribute'=>'password',
                'value'=>function($data){
                    return $data->password;
                },
            ],
            [
                'label'=>'Llave de autorización',
                'attribute'=>'auth_key',
                'value'=>function($data){
                    return $data->auth_key;
                },
            ],
            [
                'label'=>'Password Reset Token',
                'attribute'=>'password_reset_token',
                'value'=>function($data){
                    return $data->password_reset_token;
                },
            ],
            [
                'label'=>'Email',
                'attribute'=>'email',
                'value'=>function($data){
                    return $data->email;
                },
            ],
            [
                'label'=>'Status',
                'attribute'=>'status',
                'value'=>function($data){
                    return $data->status == 1 ? 'Activo' : 'Inactivo';
                },
            ],
            [
                'label'=>'F. Creado',
                'attribute'=>'created_at',
                'value'=>function($data){
                    return $data->created_at;
                },
            ],
            [
                'label'=>'F. Actualizado',
                'attribute'=>'updated_at',
                'value'=>function($data){
                    return $data->updated_at;
                },
            ],
            //'verification_token',
        ],
    ]) ?>

</div>
