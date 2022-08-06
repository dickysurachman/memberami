<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "demo".
 *
 * @property int $id
 * @property string $nama
 * @property string $tanggal
 * @property int $id_costumer
 * @property int $status
 * @property string|null $nama_ap
 * @property float|null $jumlah
 */
class Demo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'demo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal', 'id_costumer'], 'required'],
            [['id', 'id_costumer', 'status','id_user','id_project'], 'integer'],
            [['tanggal'], 'safe'],
            [['jumlah'], 'number'],
            [['nama', 'nama_ap','person'], 'string', 'max' => 100],
            [['person_c'], 'string', 'max' => 40],
            [['ket'], 'string'],
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
            'nama' => \Yii::t('yii', 'Name'),
            'tanggal' => \Yii::t('yii', 'Date'),
            'id_costumer' => \Yii::t('yii', 'Costumer'),
            'id_user' => \Yii::t('yii', 'User'),
            'status' => \Yii::t('yii', 'Status'),
            'nama_ap' => \Yii::t('yii', 'Application Name'),
            'jumlah' =>  \Yii::t('yii', 'Budget Total'),
            'id_project'=>\Yii::t('yii', 'Project Name'),
             'person' => \Yii::t('yii', 'Person Name'),
            'person_c' => \Yii::t('yii', 'Contact Number'),        ];
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
