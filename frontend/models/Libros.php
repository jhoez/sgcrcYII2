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
 * @property int|null $idfkimag
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
                'skipOnEmpty'=>false,
                'extensions'=>'pdf',
                'maxFiles'=>1
            ],
            [['coleccion','files'],'required'],
            [['idfkimag'], 'default', 'value' => null],
            [['idfkimag'], 'integer'],
            [['nomblib', 'ruta', 'coleccion'], 'string', 'max' => 255],
            [['extension'], 'string', 'max' => 5],
            [['nivel'], 'string', 'max' => 11],
            [['tamanio'], 'string', 'max' => 50],
            [['idfkimag'], 'exist', 'skipOnError' => true, 'targetClass' => Imagen::className(), 'targetAttribute' => ['idfkimag' => 'idimag']],
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
			'idfkimag' => 'Imagen',
			'files' => 'Archivo a subir'
        ];
    }
}
