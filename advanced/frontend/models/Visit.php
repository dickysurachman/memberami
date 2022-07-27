<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visit".
 *
 * @property int $id
 * @property string $nama
 * @property string $tanggal
 * @property int $id_costumer
 * @property int $status
 * @property string|null $nama_ap
 * @property float|null $jumlah
 */
class Visit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'required'],
            [['tanggal'], 'safe'],
            [['id_costumer', 'status','id_user','id_project'], 'integer'],
            [['jumlah'], 'number'],
            [['nama', 'nama_ap'], 'string', 'max' => 100],
            [['person_c'], 'string', 'max' => 20],
            [['person'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'id_project'=>'Project',
            'tanggal' => 'Tanggal Visit',
            'id_costumer' => 'Costumer',
            'status' => 'Status',
            'nama_ap' => 'Nama Aplikasi',
            'jumlah' => 'Jumlah',
            'person' => 'Person',
            'person_c' => 'No Contact Person',
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
     public function getCostumer()
    {
        return $this->hasOne(Costumer::className(), ['id' => 'id_costumer']);
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
