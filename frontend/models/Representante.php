<?php

namespace frontend\models;
use Yii;
use frontend\models\Estudiante;

/**
 * This is the model class for table "sc.representante".
 *
 * @property int $idrep
 * @property string|null $cedula
 * @property string|null $nombre
 * @property string|null $telf
 * @property string|null $docente
 * @property int|null $idciat
 * @property int|null $idinst
 * @property int|null $fkuser
 */
class Representante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.representante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre','cedula','telf'], 'required'],
            [['fkciat', 'fkinst', 'fkuser'], 'default', 'value' => null],
            [['fkciat', 'fkinst', 'fkuser'], 'integer'],
            [['cedula'], 'string', 'max' => 8],
            [['nombre'], 'string', 'max' => 50],
            [['telf'], 'string', 'max' => 12],
            [['docente'], 'boolean'],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fkuser' => 'iduser']],
            [['fkinst'], 'exist', 'skipOnError' => true, 'targetClass' => Insteduc::className(), 'targetAttribute' => ['fkinst' => 'idinst']],
            [['fkciat'], 'exist', 'skipOnError' => true, 'targetClass' => Sedeciat::className(), 'targetAttribute' => ['fkciat' => 'idciat']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idrep' => 'ID',
			'cedula' => 'Cedula',
			'nombre' => 'Representante',
			'telf' => 'Telefono',
			'idciat' => 'ciat',
			'fkuser' => 'Usuario',
			'docente' => 'Docente',
			'idinst' => 'inst',
        ];
    }

    public function getRepInstituto()
    {
        $instituto = Insteduc::find()->where(['idinst'=>$this->fkinst])->one();
        return $instituto;
    }

    public function getRepSedeciat()
    {
        $sedeciat = Sedeciat::find()->where(['idciat'=>$this->fkciat])->one();
        return $sedeciat;
    }

    public function getRepEstudiante()
    {
        $estudiante = Estudiante::find()->where(['idrep'=>$this->idrep])->one();
        return $estudiante;
    }
}
