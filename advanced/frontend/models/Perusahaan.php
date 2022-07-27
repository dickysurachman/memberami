<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $id_user
 * @property string $nama
 * @property string $alamat
 * @property string $nama_d
 * @property string|null $npwp
 * @property int|null $id_kota
 * @property string|null $telp
 * @property string|null $logo
 * @property int $status
 */
class Perusahaan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'nama', 'alamat', 'nama_d'], 'required'],
            [['id_user', 'id_kota', 'status'], 'integer'],
            [['nama', 'nama_d'], 'string', 'max' => 100],
            [['alamat'], 'string', 'max' => 150],
            [['npwp'], 'string', 'max' => 30],
            [['telp'], 'string', 'max' => 20],
            [['logo'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'User',
            'nama' => 'Nama Perusahaan',
            'alamat' => 'Alamat',
            'nama_d' => 'Nama Direktur',
            'npwp' => 'NPWP Perusahaan',
            'id_kota' => 'Kota',
            'telp' => 'Telp',
            'logo' => 'Logo',
            'status' => 'Status',
        ];
    }
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'id_kota']);
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
