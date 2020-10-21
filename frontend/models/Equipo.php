<?php

namespace frontend\models;
use Yii;
use frontend\models\Fsoftware;
use frontend\models\Fpantalla;
use frontend\models\Ftarjetamadre;
use frontend\models\Fteclado;
use frontend\models\Fcarga;
use frontend\models\Fgeneral;

/**
 * This is the model class for table "sc.equipo".
 *
 * @property int $ideq
 * @property string|null $eqserial
 * @property string|null $frecepcion
 * @property string|null $fentrega
 * @property string|null $eqversion
 * @property string|null $eqstatus
 * @property int|null $fkrep
 * @property string|null $diagnostico
 * @property string|null $observacion
 * @property string|null $status
 */
class Equipo extends \yii\db\ActiveRecord
{
    public $fallas;
	public $mes;
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
            [['eqserial', 'eqversion', 'eqstatus'],'required'],
            [['mes'], 'string', 'max' => 2],// propiedad agregada, no esta en la base de datos.
            [['frecepcion', 'fentrega'], 'safe'],
            [['fkrep'], 'default', 'value' => null],
            [['fkrep'], 'integer'],
            [['eqserial'], 'string', 'max' => 125],
            [['eqversion'], 'string', 'max' => 6],
            [['eqstatus'], 'string', 'max' => 11],
            [['diagnostico', 'observacion'], 'string', 'max' => 500],
            [['status'], 'boolean'],
            [['fkrep'], 'exist', 'skipOnError' => true, 'targetClass' => Representante::className(), 'targetAttribute' => ['fkrep' => 'idrep']],
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
            'fkrep'         => 'Representante',
            'diagnostico'   => 'Diagnostico del Equipo',
            'observacion'   => 'Observacion del Equipo',
            'status'        => 'Status entrega',
            'cedula'        => 'Cedula',  // propiedad para filtro CGridView con relaciones
            'fallas'		=> 'Reporte de fallas',
			'mes'			=> 'Reporte Mes',
        ];
    }

    public function getCanrepresentante()
    {
        $representante = Representante::find()->where(['idrep'=>$this->fkrep])->one();
        return $representante;
    }

    /**
    *   @method obtiene relacion para utilizarla en el search con joinWith()
    *
    */
    public function getfkrep()
    {
        return $this->hasOne(Representante::className(), ['idrep' => 'fkrep']);
    }

    /**
    *   @method
    *
    */
    public function getCanfsoftware()
    {
        $fsoftware = Fsoftware::find()->where(['fkeq'=>$this->ideq])->one();
        return $fsoftware;
    }

    /**
    *   @method
    *
    */
    public function getCanfpantalla()
    {
        $fpantalla = Fpantalla::find()->where(['fkeq'=>$this->ideq])->one();
        return $fpantalla;
    }

    /**
    *   @method
    *
    */
    public function getCanftarjetamadre()
    {
        $ftarjetamadre = Ftarjetamadre::find()->where(['fkeq'=>$this->ideq])->one();
        return $ftarjetamadre;
    }

    /**
    *   @method
    *
    */
    public function getCanfteclado()
    {
        $fteclado = Fteclado::find()->where(['fkeq'=>$this->ideq])->one();
        return $fteclado;
    }

    /**
    *   @method
    *
    */
    public function getCanfcarga()
    {
        $fcarga = Fcarga::find()->where(['fkeq'=>$this->ideq])->one();
        return $fcarga;
    }

    /**
    *   @method
    *
    */
    public function getCanfgeneral()
    {
        $fgeneral = Fgeneral::find()->where(['fkeq'=>$this->ideq])->one();
        return $fgeneral;
    }
}
