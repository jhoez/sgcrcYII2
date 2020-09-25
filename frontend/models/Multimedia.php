<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.multimedia".
 *
 * @property int $idmult
 * @property string|null $nombmult
 * @property string|null $extension
 * @property string|null $tipomult
 * @property string|null $tamanio
 * @property string|null $ruta
 * @property int|null $fkidpro
 */
class Multimedia extends \yii\db\ActiveRecord
{
    public $nombpro;
	public $creador;
	public $mva;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.multimedia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['mva'],'file',
                'skipOnEmpty'=>false,
                'extensions'=>'mp4,mp3',
                'maxFiles'=>1
            ],
            [['mva'],'required'],
            [['fkidpro'], 'default', 'value' => null],
            [['fkidpro'], 'integer'],
            [['nombmult', 'ruta'], 'string', 'max' => 255],
            [['extension', 'tipomult'], 'string', 'max' => 5],
            [['tamanio'], 'string', 'max' => 20],
            [['fkidpro'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['fkidpro' => 'idpro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmult' => 'ID',
			'nombmult' => 'Nombre Archivo',
			'extension' => 'Extension',
			'tipomult' => 'Tipo de archivo',
			'tamanio' => 'Tamaño del archivo',
			'ruta' => 'Ruta',
			'mva' => 'Archivo multimedia a subir',
			'fkidpro' => 'proyecto'
        ];
    }
}
