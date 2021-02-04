<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.estado".
 *
 * @property int $idesta
 * @property string|null $nombest
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.estado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['idesta'],'required'],
            [['nombest'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idesta' => 'Estado',
			'nombest' => 'Estado',
        ];
    }
}
