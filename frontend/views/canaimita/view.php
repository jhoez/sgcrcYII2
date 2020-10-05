<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $canaimita frontend\models\Equipo */

$this->title = $canaimita->eqversion;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="equipo-view">

    <h1>Version del equipo: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar registro', ['update', 'id' => $canaimita->ideq], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar registro', ['delete', 'id' => $canaimita->ideq], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $canaimita,
        'attributes' => [
            [
                'label'=>'ID',
                'attribute'=>'ideq',
                'value'=>function($data){
                    return $data->ideq;
                }
            ],
            [
                'label'=>'CIAT',
                'attribute'=>'sede',
                'value'=>function($data){
                    return $data->getCanrepresentante()->getRepSedeciat()->sede;
                }
            ],
            [
                'label'=>'Instituto',
                'attribute'=>'nombinst',
                'value'=>function($data){
                    return $data->getCanrepresentante()->getRepInstituto()->nombinst;
                }
            ],[
                'label'=>'Representante',
                'attribute'=>'nombre',
                'value'=>function($data){
                    return $data->getCanrepresentante()->nombre;
                }
            ],
            [
                'label'=>'Cedula',
                'attribute'=>'cedula',
                'value'=>function($data){
                    return $data->getCanrepresentante()->cedula;
                }
            ],
            [
                'label'=>'Docente',
                'attribute'=>'docente',
                'value'=>function($data){
                    return $data->getCanrepresentante()->docente == true ? 'Si' : 'No';
                }
            ],
            [
                'label'=>'Telefono',
                'attribute'=>'telf',
                'value'=>function($data){
                    return $data->getCanrepresentante()->telf;
                }
            ],
            [
                'label'=>'Estudiante',
                'attribute'=>'nombestu',
                'value'=>function($data){
                    return $data->getCanrepresentante()->getRepEstudiante()->nombestu;
                }
            ],
            [
                'label'=>'Grado',
                'attribute'=>'nivel',
                'value'=>function($data){
                    return $data->getCanrepresentante()->getRepEstudiante()->getEstNiveleduc()->nivel;
                }
            ],
            [
                'label'=>'Graduado',
                'attribute'=>'graduado',
                'value'=>function($data){
                    return $data->getCanrepresentante()->getRepEstudiante()->getEstNiveleduc()->graduado == true ? 'Si' : 'No';
                }
            ],
            [
                'label'=>'Equipo',
                'attribute'=>'eqversion',
                'value'=>function($data){
                    return $data->eqversion;
                }
            ],
            [
                'label'=>'Serial Equipo',
                'attribute'=>'eqseial',
                'value'=>function($data){
                    return $data->eqserial;
                }
            ],
            [
                'label'=>'Status',
                'attribute'=>'eqstatus',
                'value'=>function($data){
                    return $data->eqstatus;
                }
            ],
            [
                'label'=>'Diagnostico',
                'attribute'=>'diagnostico',
                'value'=>function($data){
                    return $data->diagnostico;
                }
            ],
            [
                'label'=>'Observacion',
                'attribute'=>'observacion',
                'value'=>function($data){
                    return $data->observacion;
                }
            ],
            [
                'label'=>'Fecha recibido',
                'attribute'=>'frecepcion',
                'value'=>function($data){
                    return $data->frecepcion;
                }
            ],
            [
                'label'=>'Fecha entrega',
                'attribute'=>'fentrega',
                'value'=>function($data){
                    return $data->fentrega != null ? $data->fentrega : 'sin fecha' ;
                }
            ],
            [
                'label'=>'F software',
                'attribute'=>'fsoft',
                'value'=>function($data){
                    return $data->getCanfsoftware()->fsoft != null ? $data->getCanfsoftware()->fsoft : 'vacio';
                }
            ],
            [
                'label'=>'F pantalla',
                'attribute'=>'fpant',
                'value'=>function($data){
                    return $data->getCanfpantalla()->fpant != null ? $data->getCanfpantalla()->fpant : 'vacio';
                }
            ],
            [
                'label'=>'F tarjeta madre',
                'attribute'=>'ftarj',
                'value'=>function($data){
                    return $data->getCanftarjetamadre()->ftarj != null ? $data->getCanftarjetamadre()->ftarj : 'vacio';
                }
            ],
            [
                'label'=>'F teclado',
                'attribute'=>'ftec',
                'value'=>function($data){
                    return $data->getCanfteclado()->ftec != null ? $data->getCanfteclado()->ftec : 'vacio';
                }
            ],
            [
                'label'=>'F carga',
                'attribute'=>'fcarg',
                'value'=>function($data){
                    return $data->getCanfcarga()->fcarg != null ? $data->getCanfcarga()->fcarg : 'vacio';
                }
            ],
            [
                'label'=>'F general',
                'attribute'=>'fgen',
                'value'=>function($data){
                    return $data->getCanfgeneral()->fgen != null ? $data->getCanfgeneral()->fgen : 'vacio';
                }
            ],
        ],
    ]) ?>

</div>
