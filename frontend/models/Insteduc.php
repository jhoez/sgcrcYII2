<?php

namespace frontend\models;
use Yii;

/**
 * This is the model class for table "sc.insteduc".
 *
 * @property int $idinst
 * @property string|null $nombinst
 */
class Insteduc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.insteduc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombinst'],'required'],
            [['nombinst'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idinst' => 'ID',
			'nombinst' => 'Inst. Educativo'
        ];
    }
}
