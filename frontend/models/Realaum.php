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
 * @property int|null $idpro
 * @property int|null $fkimag
 */
class Realaum extends \yii\db\ActiveRecord
{
    public $creador;
	public $nombpro;
    public $usuario;
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
                'skipOnEmpty'=>true,
                'uploadRequired'=>'No has seleccionado ningun Archivo',// error
                'maxSize'=>1024*1024*100,//10MB
                'tooBig'=>'El tamaño maximo permitido es de 100MB',// error
                'minSize'=>4,
                'tooSmall'=>'El tamaño minimo permitido son 4Byte',// error
                'extensions'=>'glb',
                'wrongExtension'=>'El archivo no contiene una extension permitida',
                //'maxFiles'=>4,
                //'tooMany'=>'El maximo de archivos permitidos son {limit}',// error
            ],
            [['fkpro', 'fkimag'], 'default', 'value' => null],
            [['fkpro', 'fkimag'], 'integer'],
            [['nra', 'ruta'], 'string', 'max' => 255],
            [['exten'], 'string', 'max' => 5],
            [['fkimag'], 'exist', 'skipOnError' => true, 'targetClass' => Imagen::className(), 'targetAttribute' => ['fkimag' => 'idimag']],
            [['fkpro'], 'exist', 'skipOnError' => true, 'targetClass' => Proyecto::className(), 'targetAttribute' => ['fkpro' => 'idpro']],
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
			'exten' => 'Extension',
			'ruta' => 'Ruta',
			'fkpro' => 'pro',
			'fkimag' => 'Fkimag',
			'fileglb' => 'Patron de Realidad Aumentada',
        ];
    }

    /**
    *   @method uploadArchivo
    *   @return boolean
    */
    public function uploadRa()
    {
        $this->fileglb->saveAs($this->ruta.$this->nra.'.'.$this->exten);
    }

    /**
    *
    *
    */
    public function getRaProyecto()
    {
        $proyecto = Proyecto::find()->where(['idpro'=>$this->fkpro])->one();
        return $proyecto;
    }

    /**
    *
    *
    */
    public function getRaImagen()
    {
        $imagen = Imagen::find()->where(['idimag'=>$this->fkimag])->one();
        return $imagen;
    }

    /**
    *
    *
    */
    public function getidpro()
    {
        return $this->hashOne(Proyecto::className(), ['idpro'=>'fkpro']);
    }

    /**
    *
    *
    */
    public function getfkimag()
    {
        return $this->hashOne(Imagen::className(), ['idimag'=>'fkimag']);
    }
}
