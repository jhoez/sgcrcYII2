<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.ftarjetamadre".
 *
 * @property int $idtarj
 * @property string|null $ftarj
 * @property int|null $ideq
 */
class Ftarjetamadre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.ftarjetamadre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkeq'], 'default', 'value' => null],
            [['fkeq'], 'integer'],
            [['ftarj'], 'string', 'max' => 255],
            [['fkeq'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['fkeq' => 'ideq']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtarj' => 'Idtarj',
            'ftarj' => 'Ftarj',
            'fkeq' => 'Ideq',
        ];
    }
}
