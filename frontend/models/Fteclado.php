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
            [['ideq'], 'default', 'value' => null],
            [['ideq'], 'integer'],
            [['ftec'], 'string', 'max' => 255],
            [['ideq'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['ideq' => 'ideq']],
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
            'ideq' => 'Ideq',
        ];
    }
}
