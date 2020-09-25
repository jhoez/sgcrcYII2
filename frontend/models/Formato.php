<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.formato".
 *
 * @property int $idf
 * @property string|null $opcion
 * @property string|null $nombf
 * @property string|null $extens
 * @property string|null $ruta
 * @property string|null $tamanio
 * @property string|null $status
 * @property string|null $create_at
 * @property int|null $update_at
 * @property int|null $fkuser
 */
class Formato extends \yii\db\ActiveRecord
{
    public $ftutor;
    public $nombuser;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.formato';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['ftutor'],'file',
                'skipOnEmpty'=>false,
                'extensions'=>'ods,xls,odt,docx',
                'maxFiles'=>4
            ],
            [['ftutor','opcion'], 'required'],
            [['create_at'], 'safe'],
            [['update_at', 'fkuser'], 'default', 'value' => null],
            [['update_at', 'fkuser'], 'integer'],
            [['opcion', 'nombf', 'ruta'], 'string', 'max' => 255],
            [['extens'], 'string', 'max' => 5],
            [['tamanio'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 1],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fkuser' => 'iduser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idf'		=> 'Acta',
			'opcion'	=> 'Opcion de formato',
			'nombf'		=> 'Nombre del formato',
			'extens'	=> 'Extension',
			'ruta'		=> 'Ruta',
			'tamanio'	=> 'Tamaño',
			'status'	=> 'Status',
			'create_at' => 'Fecha de enviado',
			'update_at' => 'Formato descargable',
			'fkuser'	=> 'Usuario',
			'ftutor'	=> 'Formato a subir',
        ];
    }

    /**
    *
    *
    */
    public function getiduser()
    {
        return $this->hasOne(Usuario::className(), ['iduser' => 'fkuser']);
    }
}
