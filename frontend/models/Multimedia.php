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
 * @property int|null $fkpro
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
                //'skipOnEmpty'=>true,
                'uploadRequired'=>'No has seleccionado ningun Archivo multimedia',// error
                'maxSize'=>1024*1024*100,//100MB
                'tooBig'=>'El tamaño maximo permitido es de 100MB',// error
                'minSize'=>1024*1024*5,//5MB
                'tooSmall'=>'El tamaño minimo permitido son 5MB',// error
                'extensions'=>'mp4,mp3',
                //"mimeTypes" => "video/mp4,audio/mpeg3,audio/x-mpeg-3",
                'wrongExtension'=>'El archivo no contiene una extension permitida',
                //'maxFiles'=>4
                //'tooMany'=>'El maximo de archivos permitidos son {limit}',// error
            ],
            [['fkpro'], 'default', 'value' => null],
            [['fkpro'], 'integer'],
            [['nombmult', 'ruta'], 'string', 'max' => 255],
            [['extension', 'tipomult'], 'string', 'max' => 5],
            [['tamanio'], 'string', 'max' => 20],
            [['fkpro'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['fkpro' => 'idpro']],
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
			'mva' => 'Audio o Video',
			'fkpro' => 'proyecto'
        ];
    }

    /**
    *   @method upload guarda el file en un directorio
    *   @return boolean
    */
    public function uploadMultimedia()
    {
        if ( $this->tipomult == ('video' || 'audio') ) {
            $this->mva->saveAs($this->ruta.$this->mva->baseName.'.'.$this->mva->extension);
        }
    }
}
