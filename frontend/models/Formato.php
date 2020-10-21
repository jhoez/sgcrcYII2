<?php

namespace frontend\models;
use Yii;
use yii\web\UploadedFile;

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
 * @property int|null $statusacta
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
                'uploadRequired'=>'No has seleccionado ningun ARCHIVO',// error
                'maxSize'=>1024*1024*10,//10MB
                'tooBig'=>'El tamaño permitido es de 10MB',// error
                'minSize'=>4,
                'tooSmall'=>'El tamaño permitido son 4Byte',// error
                'extensions'=>'ods,xls,odt,docx,doc',
                'wrongExtension'=>'El archivo no contiene una extension permitida ods,xls,odt,docx,doc',
                //'maxFiles'=>4,
                //'tooMany'=>'El maximo de archivos permitidos son {limit}',// error
            ],
            [['opcion'], 'required'],
            [['create_at'], 'safe'],
            [['fkuser'], 'default', 'value' => null],
            [['fkuser'], 'integer'],
            [['opcion', 'nombf', 'ruta'], 'string', 'max' => 255],
            [['extens'], 'string', 'max' => 5],
            [['tamanio'], 'string', 'max' => 50],
            [['status', 'statusacta'], 'boolean'],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fkuser' => 'iduser']],
        ];
    }

    /**
    *   @method upload valida y guarda el file en un directorio
    *   @return boolean
    */
    public function uploadArchivo()
    {
        if ($this->statusacta == true) {
            $this->ftutor->saveAs('archivos/fd/'.$this->nombf.'.'.$this->extens);
        }

        if($this->statusacta == false){
            $this->ftutor->saveAs('archivos/'.$this->nombf.'.'.$this->extens);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idf'		=> 'ID',
			'opcion'	=> 'Opcion de formato',
			'nombf'		=> 'Nombre del formato',
			'extens'	=> 'Extension',
			'ruta'		=> 'Ruta',
			'tamanio'	=> 'Tamaño',
			'status'	=> 'Status',
			'create_at' => 'Fecha de enviado',
			'statusacta' => 'Formato descargable',
			'fkuser'	=> 'Usuario',
			'ftutor'	=> 'Formato a subir',
        ];
    }

    /**
    *   @method getiduser
    *
    */
    public function getiduser()
    {
        return $this->hasOne(Usuario::className(), ['iduser' => 'fkuser']);
    }
}
