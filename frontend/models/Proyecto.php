<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.proyecto".
 *
 * @property int $idpro
 * @property string|null $nombpro
 * @property string|null $creador
 * @property string|null $colaboracion
 * @property string|null $descripcion
 * @property string|null $create_at
 * @property string|null $update_at
 * @property int|null $fkuser
 */
class Proyecto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.proyecto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombpro','creador'],'required'],
            [['create_at', 'update_at'], 'safe'],
            [['fkuser'], 'default', 'value' => null],
            [['fkuser'], 'integer'],
            [['nombpro', 'colaboracion'], 'string', 'max' => 255],
            [['creador'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 500],
            [['fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['fkuser' => 'iduser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpro' => 'ID',
			'nombpro' => 'Nombre del proyecto',
			'creador' => 'Centro Bolivariano de Informatica y Telematica',
			'colaboracion' => 'Colaboración',
			'descripcion' => 'Descripción',
			'create_at' => 'F Creación',
			'update_at' => 'F Modificado',
			'fkuser' => 'Usuario'
        ];
    }

    public function getUsuario()
    {
        $usuario = Usuario::find()->where(['iduser'=>$this->fkuser])->one();
        return $usuario;
    }
}
