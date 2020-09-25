<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.realaum".
 *
 * @property int $idra
 * @property string|null $nra
 * @property string|null $exten
 * @property string|null $ruta
 * @property int|null $fk_pro
 * @property int|null $fkimag
 */
class Realaum extends \yii\db\ActiveRecord
{
    public $creador;
	public $nombpro;
	public $raimg;// imagen de RA
	public $fileglb;// archivo GLB
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.realaum';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['fileglb'],'file',
                'skipOnEmpty'=>false,
                'extensions'=>'glb',
                'maxFiles'=>1
            ],
            [['fileglb'],'required'],
            [['fk_pro', 'fkimag'], 'default', 'value' => null],
            [['fk_pro', 'fkimag'], 'integer'],
            [['nra', 'ruta'], 'string', 'max' => 255],
            [['exten'], 'string', 'max' => 5],
            [['fkimag'], 'exist', 'skipOnError' => true, 'targetClass' => Imagen::className(), 'targetAttribute' => ['fkimag' => 'idimag']],
            [['fk_pro'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['fk_pro' => 'idpro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idra' => 'Idra',
			'nra' => 'Nra',
			'exten' => 'Exten',
			'ruta' => 'Ruta',
			'fk_pro' => 'fk_pro',
			'fkimag' => 'Fkimag',
			'fileglb' => 'Patron de Realidad Aumentada',
        ];
    }
}
