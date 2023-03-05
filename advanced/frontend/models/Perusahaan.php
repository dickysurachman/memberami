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
            [['nama', 'alamat', 'nama_d'], 'required'],
            [['id_user', 'id_kota', 'status'], 'integer'],
            [['nama', 'nama_d','nama_s','email','email_s'], 'string', 'max' => 100],
            [['alamat'], 'string', 'max' => 150],
            [['npwp'], 'string', 'max' => 30],
            [['telp'], 'string', 'max' => 20],
            [['telp_s','telp_c'], 'string', 'max' => 50],
            [['logo'], 'string', 'max' => 250],
            [['akta','npwp_f','kemenkumham','nib'], 'string', 'max' => 125],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => \Yii::t('yii', 'User'),
            'nama' => \Yii::t('yii', 'Company Name'),
            'alamat' => \Yii::t('yii', 'Address'),
            'nama_d' => \Yii::t('yii', 'CEO Name'),//'Nama Direktur',
            'email' => \Yii::t('yii', 'CEO Email'),//'Nama Direktur',
            'email_s' => \Yii::t('yii', 'Sales Email'),//'Nama Direktur',
            'nama_s' => \Yii::t('yii', 'Sales Name'),//'Nama Direktur',
            'npwp' => \Yii::t('yii', 'Company NPWP'),//'NPWP Perusahaan',
            'id_kota' => \Yii::t('yii', 'City'),//'Kota',
            'telp' => \Yii::t('yii', 'CEO Mobile Number'),//'Telp',
            'telp_s' => \Yii::t('yii', 'Sales Mobile Number'),//'Telp',
            'telp_c' => \Yii::t('yii', 'Company Mobile Number'),//'Telp',
            'logo' => \Yii::t('yii', 'Logo Picture'),//'Logo',
            'akta' => \Yii::t('yii', 'AKTA File'),//'Logo',
            'npwp_f' => \Yii::t('yii', 'NPWP File'),//'Logo',
            'kemenkumham' => \Yii::t('yii', 'KEMENKUMHAM File'),//'Logo',
            'nib' => \Yii::t('yii', 'NIB File'),//'Logo',
            'status' => 'Status',
           
        ];
    }
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'id_kota']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord)   
            if(!isset($this->id_user)) {
                $this->id_user=Yii::$app->user->identity->id;
            }
            return true;
        } else {
            
            return false;
        }
    }
}
