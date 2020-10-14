<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "sc.asistencia".
 *
 * @property int $idasis
 * @property int|null $fkuser
 * @property string|null $fecha
 * @property string|null $horain
 * @property string|null $horaout
 * @property string|null $observacion
 */
class Asistencia extends \yii\db\ActiveRecord
{
	public $fechain;
	public $fechaout;
	public $mes;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.asistencia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkuser'], 'default', 'value' => null],
            [['fkuser'], 'integer'],
			[['fechain', 'fechaout'],'string','max'=>10],
			[['mes'], 'string', 'max' => 2],// propiedad agregada, no esta en la base de datos.
            [['fecha', 'horain', 'horaout'], 'safe'],
            [['observacion'], 'string'],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fkuser' => 'iduser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idasis' => 'Idasis',
			'fkuser' => 'Usuario',
			'fecha' => 'Fecha',
			'horain' => 'Hora Entrada',
            'horaout' => 'Hora Salida',
            'observacion' => 'Observacion',
			'fechain'=>'Fecha inicio',
			'fechaout'=>'Fecha fin',
			'mes'=>'Reporte Mensual'
        ];
    }

	public function getFkusuario()
    {
		$usuario = Usuario::find()->where(['iduser'=>$this->fkuser])->one();
        return $usuario;
    }

    public function getfkuser()
    {
        return $this->hasOne(Usuario::className(), ['iduser' => 'fkuser']);
    }
}
