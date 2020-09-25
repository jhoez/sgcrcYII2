<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.parroquia".
 *
 * @property int $idpar
 * @property string|null $parroquia
 * @property int|null $idmunc
 */
class Parroquia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.parroquia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idpar'],'required'],
            [['idmunc'], 'default', 'value' => null],
            [['idmunc'], 'integer'],
            [['parroquia'], 'string', 'max' => 255],
            [['idmunc'], 'exist', 'skipOnError' => true, 'targetClass' => Municipio::className(), 'targetAttribute' => ['idmunc' => 'idmunc']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idpar' => 'Parroquia',
            'parroquia' => 'Parroquia',
            'idmunc' => 'Idmunc',
        ];
    }
}
