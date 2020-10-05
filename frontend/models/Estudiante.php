<?php

namespace frontend\models;
use Yii;
use frontend\models\Niveleduc;

/**
 * This is the model class for table "sc.estudiante".
 *
 * @property int $idestu
 * @property string|null $nombestu
 * @property int|null $idrep
 * @property int|null $idinst
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
            [['idrep', 'idinst'], 'default', 'value' => null],
            [['idrep', 'idinst'], 'integer'],
            [['nombestu'], 'string', 'max' => 255],
            [['idinst'], 'exist', 'skipOnError' => true, 'targetClass' => Insteduc::className(), 'targetAttribute' => ['idinst' => 'idinst']],
            [['idrep'], 'exist', 'skipOnError' => true, 'targetClass' => Representante::className(), 'targetAttribute' => ['idrep' => 'idrep']],
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
            'idrep' => 'Rep',
            'idinst' => 'Inst',
        ];
    }

    public function getEstNiveleduc()
    {
        $niveleduc = Niveleduc::find()->where(['idestu'=>$this->idestu])->one();
        return $niveleduc;
    }
}
