<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.sedeciat".
 *
 * @property int $idciat
 * @property string|null $sede
 */
class Sedeciat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.sedeciat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sede'], 'required'],
            [['sede'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idciat' => 'ID',
            'sede' => 'CIAT',
        ];
    }
}
