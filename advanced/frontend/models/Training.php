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
            [['keterangan'], 'string'],
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
            'id_project'=>'Project',
            'id_costumer'=>'Company',
            'tanggal_r' => 'Tanggal Request',
            'status' => 'Status',
            'keterangan' => 'Keterangan',
            'nama' => 'Subject',
            'id_user' => 'User',
            'person' => 'Person',
            'person_c' => 'No Contact Person',
        ];
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
