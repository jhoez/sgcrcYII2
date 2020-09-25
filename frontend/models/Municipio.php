<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.municipio".
 *
 * @property int $idmunc
 * @property string|null $municipio
 * @property int|null $idesta
 */
class Municipio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.municipio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idmunc'],'required'],
            [['idesta'], 'default', 'value' => null],
            [['idesta'], 'integer'],
            [['municipio'], 'string', 'max' => 255],
            [['idesta'], 'exist', 'skipOnError' => true, 'targetClass' => Estado::className(), 'targetAttribute' => ['idesta' => 'idesta']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmunc' => 'Municipio',
            'municipio' => 'Municipio',
            'idesta' => 'Idesta',
        ];
    }
}
