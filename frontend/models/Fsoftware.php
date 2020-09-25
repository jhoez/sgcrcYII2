<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.fsoftware".
 *
 * @property int $idsoft
 * @property string|null $fsoft
 * @property int|null $ideq
 */
class Fsoftware extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.fsoftware';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ideq'], 'default', 'value' => null],
            [['ideq'], 'integer'],
            [['fsoft'], 'string', 'max' => 255],
            [['ideq'], 'exist', 'skipOnError' => true, 'targetClass' => Equipo::className(), 'targetAttribute' => ['ideq' => 'ideq']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idsoft' => 'Idsoft',
            'fsoft' => 'Fsoft',
            'ideq' => 'Ideq',
        ];
    }
}
