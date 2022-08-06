<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "costumer_p".
 *
 * @property int $id
 * @property string $nama
 * @property string $telp
 * @property string $email
 * @property int|null $id_costumer
 * @property int|null $id_user
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'costumer_p';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'telp', 'email'], 'required'],
            [['id_costumer', 'id_user'], 'integer'],
            [['nama', 'email'], 'string', 'max' => 100],
            [['telp'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => \Yii::t('yii', 'Name'),//'Nama',
            'telp' => \Yii::t('yii', 'Contact Number'),//'Telp',
            'email' => \Yii::t('yii', 'Email'),
            'id_costumer' => \Yii::t('yii', 'Company'),
            'id_user' => \Yii::t('yii', 'User'),//'Id User',
        ];
    }

    public function getPerusahaan()
    {
        return $this->hasOne(Costumer::className(), ['id' => 'id_costumer']);
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
