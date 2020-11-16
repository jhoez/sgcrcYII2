<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.libros".
 *
 * @property int $idlib
 * @property string|null $nomblib
 * @property string|null $extension
 * @property string|null $ruta
 * @property string|null $coleccion
 * @property string|null $nivel
 * @property string|null $tamanio
 * @property int|null $fkimag
 */
class Libros extends \yii\db\ActiveRecord
{
    public $files;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.libros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['files'],'file',
                'skipOnEmpty'=>true,
                'uploadRequired'=>'No has seleccionado ningun Archivo',// error
                'maxSize'=>1024*1024*300,//10MB
                'tooBig'=>'El tamaño maximo permitido es de 300MB',// error
                'minSize'=>4,
                'tooSmall'=>'El tamaño minimo permitido son 4Byte',// error
                'extensions'=>'pdf',
                'wrongExtension'=>'El archivo no contiene una extension permitida',
                //'maxFiles'=>4,
                //'tooMany'=>'El maximo de archivos permitidos son {limit}',// error
            ],
            [['coleccion'],'required'],
            [['fkimag'], 'default', 'value' => null],
            [['fkimag'], 'integer'],
            [['nomblib', 'ruta', 'coleccion'], 'string', 'max' => 255],
            [['extension'], 'string', 'max' => 5],
            [['nivel'], 'string', 'max' => 11],
            [['tamanio'], 'string', 'max' => 50],
            [['fkimag'], 'exist', 'skipOnError' => true, 'targetClass' => Imagen::className(), 'targetAttribute' => ['fkimag' => 'idimag']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idlib' => 'Idlib',
			'nomblib' => 'Nomblib',
			'extension' => 'Extension',
			'ruta' => 'Ruta',
			'coleccion' => 'Coleccion',
			'nivel' => 'Nivel Educativo',
			'tamanio' => 'Size',
			'fkimag' => 'Imagen',
			'files' => 'Archivo a subir'
        ];
    }

    /**
    *   @method upload valida y guarda el file en un directorio
    *   @return boolean
    */
    public function getimagen()
    {
        $imagen = Imagen::find()->where(['idimag'=>$this->fkimag])->one();
        return $imagen;
    }

    /**
    *   @method uploadArchivo
    *   @return boolean
    */
    public function uploadArchivo()
    {
        if ( $this->coleccion == 'coleccionBicentenaria' ) {
            $this->files->saveAs("coleccionLibros/$this->coleccion/$this->nivel/".$this->files->baseName.'.'.$this->files->extension);
        }elseif ( $this->coleccion == ('coleccionMaestros' || 'lectura') ) {
            $this->files->saveAs("coleccionLibros/$this->coleccion/".$this->files->baseName.'.'.$this->files->extension);
        }
    }

}
