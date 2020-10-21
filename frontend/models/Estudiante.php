<?php

namespace frontend\models;
use Yii;
use frontend\models\Niveleduc;

/**
 * This is the model class for table "sc.estudiante".
 *
 * @property int $idestu
 * @property string|null $nombestu
 * @property int|null $fkrep
 * @property int|null $fkinst
 */
class Estudiante extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sc.estudiante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fkrep', 'fkinst'], 'default', 'value' => null],
            [['fkrep', 'fkinst'], 'integer'],
            [['nombestu'], 'string', 'max' => 255],
            [['fkinst'], 'exist', 'skipOnError' => true, 'targetClass' => Insteduc::className(), 'targetAttribute' => ['fkinst' => 'idinst']],
            [['fkrep'], 'exist', 'skipOnError' => true, 'targetClass' => Representante::className(), 'targetAttribute' => ['fkrep' => 'idrep']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idestu' => 'ID',
            'nombestu' => 'Nombre Estudiante',
            'fkrep' => 'Rep',
            'fkinst' => 'Inst',
        ];
    }

    public function getEstNiveleduc()
    {
        $niveleduc = Niveleduc::find()->where(['fkestu'=>$this->idestu])->one();
        return $niveleduc;
    }
}
