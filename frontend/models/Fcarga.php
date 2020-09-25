<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.fcarga".
 *
 * @property int $idcarg
 * @property string|null $fcarg
 * @property int|null $ideq
 */
class Fcarga extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.fcarga';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ideq'], 'default', 'value' => null],
            [['ideq'], 'integer'],
            [['fcarg'], 'string', 'max' => 255],
            [['ideq'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['ideq' => 'ideq']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcarg' => 'Idcarg',
            'fcarg' => 'Fcarg',
            'ideq' => 'Ideq',
        ];
    }
}
