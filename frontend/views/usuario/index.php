<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UsuarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="us-index">
    <p>
        <?= Html::a('Crear Usuario', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Roles y permisos', ['/admin'], ['class' => 'btn btn-primary']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
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
            /*[
                'label'=>'Llave autorización',
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
            ],*/
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
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Acción',
                'headerOptions'=>['width'=>'70'],
                'template'=>'{view}{update}{delete}',
                'buttons'=> [
                    'view' => function($url,$model){
                        return Html::a(
                            '<span class="glyphicon glyphicon-eye-open"></span>',
                            $url
                        );
                    },
                    'update' => function($url,$model){
                        if ( \Yii::$app->user->can('superadmin') ) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                $url
                            );
                        }
                    },
                    'delete' => function($url,$model){
                        if ( \Yii::$app->user->can('superadmin') ) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-remove"></span>',
                                $url
                            );
                        }
                    },
                ],
            ],
        ],
    ]); ?>


</div>
