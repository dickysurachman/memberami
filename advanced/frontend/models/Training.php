<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "training".
 *
 * @property int $id
 * @property string $tanggal_r
 * @property int $status
 * @property string $keterangan
 * @property string $nama
 */
class Training extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'training';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal_r', 'keterangan'], 'required'],
            [['tanggal_r'], 'safe'],
            [['status','id_user','id_project','id_costumer'], 'integer'],
            [['keterangan','ket'], 'string'],
            [['nama','person'], 'string', 'max' => 100],
            [['person_c'], 'string', 'max' => 40],
        ];
    }

    public function getStatusnya(){
        if($this->status==0){
            return "REQUEST";
        } elseif($this->status==1){
            return "APPROVED";
        } elseif($this->status==2){
            return "REJECT";
        } else {
            return "RESCHEDULE";
        }
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ket'=>\Yii::t('yii', 'Mark'),
            'id_project'=>\Yii::t('yii', 'Project Name'),
            'id_costumer'=>\Yii::t('yii', 'Company'),
            'tanggal_r' => \Yii::t('yii', 'Date Request'),
            'status' => \Yii::t('yii', 'Status'),
            'keterangan' => \Yii::t('yii', 'Description'),
            'nama' => \Yii::t('yii', 'Subject'),
            'id_user' => \Yii::t('yii', 'User'),
            'person' => \Yii::t('yii', 'Person Name'),
            'person_c' => \Yii::t('yii', 'Contact Number'),            
        ];
    }
          public function getCostumer()
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
