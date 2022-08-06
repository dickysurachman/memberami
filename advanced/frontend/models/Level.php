<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_level".
 *
 * @property int $id
 * @property string|null $nama
 * @property float|null $diskon
 * @property int|null $status
 */
class Level extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_level';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['diskon'], 'number'],
            [['status'], 'integer'],
            [['nama'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('yii', 'ID'),
            'nama' => Yii::t('yii', 'Name'),
            'diskon' => Yii::t('yii', 'Diskon(%)'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }
}
