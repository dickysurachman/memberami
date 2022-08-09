<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "costumer".
 *
 * @property int $id
 * @property string $nama
 * @property string $telp
 * @property string $alamat
 * @property string $person
 * @property string $person_c
 */
class Costumer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'costumer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'telp', 'alamat'], 'required'],
            [['nama', 'alamat', 'person'], 'string', 'max' => 100],
            [['telp'], 'string', 'max' => 50],
            [['id_user','id_city','id_segmen'], 'integer'],
            [['person_c'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => \Yii::t('yii', 'Name'),
            'telp' => \Yii::t('yii', 'Contact Number'),
            'alamat' => \Yii::t('yii', 'Address'),
            'id_city' => \Yii::t('yii', 'City'),
            'id_segmen' => \Yii::t('yii', 'Segment'),
            'id_user' => \Yii::t('yii', 'User'),
            'kotas'=>\Yii::t('yii', 'City'),//'Logo',
            'person' => 'Person',
            'person_c' => 'No Contact Person',
        ];
    }
    public function getKota()
    {
        return $this->hasOne(City::className(), ['id' => 'id_city']);
    }
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'id_city']);
    }
    public function getSegmen()
    {
        return $this->hasOne(Segment::className(), ['id' => 'id_segmen']);
    }
     public function getNamauser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

      public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord)   
            $this->id_user=Yii::$app->user->identity->id;
            return true;
        } else {
            return false;
        }
    }
}
