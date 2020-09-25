<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.equipo".
 *
 * @property int $ideq
 * @property string|null $eqserial
 * @property string|null $frecepcion
 * @property string|null $fentrega
 * @property string|null $eqversion
 * @property string|null $eqstatus
 * @property int|null $idrep
 * @property string|null $diagnostico
 * @property string|null $observacion
 * @property string|null $status
 */
class Equipo extends \yii\db\ActiveRecord
{
    public $cedula;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.equipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['eqserial, eqversion, eqstatus'],'required'],
            [['frecepcion', 'fentrega'], 'safe'],
            [['idrep'], 'default', 'value' => null],
            [['idrep'], 'integer'],
            [['eqserial'], 'string', 'max' => 125],
            [['eqversion'], 'string', 'max' => 6],
            [['eqstatus'], 'string', 'max' => 11],
            [['diagnostico', 'observacion'], 'string', 'max' => 500],
            [['status'], 'string', 'max' => 1],
            [['idrep'], 'exist', 'skipOnError' => true, 'targetClass' => Representante::className(), 'targetAttribute' => ['idrep' => 'idrep']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ideq'          => 'ID',
            'eqserial'      => 'Serial del Equipo',
            'frecepcion'    => 'Fecha recepcion',
            'fentrega'      => 'Fecha entrega',
            'eqversion'     => 'Version del Equipo',
            'eqstatus'      => 'Status del Equipo',
            'idrep'         => 'Representante',
            'diagnostico'   => 'Diagnostico del Equipo',
            'observacion'   => 'Observacion del Equipo',
            'status'        => 'Status entrega',
            'cedula'        => 'Cedula',  // propiedad para filtro CGridView con relaciones
        ];
    }

    public function getCanrepresentante()
    {
        //return $this->hasOne(Representante::className(), ['idrep' => 'idrep'])->one();
        $representante = Representante::find()->where(['idrep'=>$this->idrep])->one();
        return $representante;
    }

    /**
    *   @method obtiene relacion para utilizarla en el search con joinWith()
    *
    */
    public function getidrep()
    {
        return $this->hasOne(Representante::className(), ['idrep' => 'idrep']);
    }
}
