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
                'extensions'=>'png',
                'maxFiles'=>1
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
}
