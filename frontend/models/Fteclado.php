<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.fteclado".
 *
 * @property int $idtec
 * @property string|null $ftec
 * @property int|null $ideq
 */
class Fteclado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.fteclado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkeq'], 'default', 'value' => null],
            [['fkeq'], 'integer'],
            [['ftec'], 'string', 'max' => 255],
            [['fkeq'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['fkeq' => 'ideq']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtec' => 'Idtec',
            'ftec' => 'Ftec',
            'fkeq' => 'eq',
        ];
    }
}
