<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.imagen".
 *
 * @property int $idimag
 * @property string|null $nombimg
 * @property string|null $extension
 * @property string|null $ruta
 * @property string|null $tamanio
 * @property string|null $tipoimg
 * @property int|null $fkuser
 */
class Imagen extends \yii\db\ActiveRecord
{
    public $imagen;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.imagen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['imagen'],'file',
                'skipOnEmpty'=>false,
                'uploadRequired'=>'No has seleccionado ninguna Imagen',// error
                'maxSize'=>1024*1024*10,//10MB
                'tooBig'=>'El tamaño maximo permitido es de 10MB',// error
                'minSize'=>4,
                'tooSmall'=>'El tamaño minimo permitido son 4Byte',// error
                'extensions'=>'png',
                'wrongExtension'=>'El archivo no contiene una extension permitida',
                //'maxFiles'=>4,
                //'tooMany'=>'El maximo de archivos permitidos son {limit}',// error
            ],
            [['fkuser'], 'default', 'value' => null],
            [['fkuser'], 'integer'],
            [['nombimg', 'tamanio'], 'string', 'max' => 50],
            [['extension'], 'string', 'max' => 5],
            [['ruta'], 'string', 'max' => 255],
            [['tipoimg'], 'string', 'max' => 7],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fkuser' => 'iduser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idimag'	=> 'Id',
			'nombimg'	=> 'Nombre imagen',
			'extension' => 'Extension',
			'ruta'		=> 'Ruta',
			'tamanio'	=> 'Tamanio',
			'tipoimg'	=> 'Tipoimg',
			'imagen'	=> 'Imagen',
            'fkuser'    => 'Fkuser',
        ];
    }

    /**
    *   @method getusuario()
    *
    */
    public function getusuario()
    {
        $usuario = Usuario::find()->where(['iduser'=>$this->fkuser])->one();
        return $usuario;
    }

    /**
    *   @method upload valida y guarda el file en un directorio
    *   @return boolean
    */
    public function uploadArchivo()
    {
        $this->imagen->saveAs($this->ruta.$this->imagen->baseName.'.'.$this->imagen->extension);
    }
}
