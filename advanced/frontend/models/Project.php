<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $nama
 * @property int $id_costumer
 * @property string $tanggal
 * @property string $deskripsi
 * @property float $jumlah
 * @property int $status
 * @property string $tanggal_deadline
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'id_costumer', 'tanggal', 'deskripsi', 'jumlah', 'tanggal_deadline'], 'required'],
            [['id_costumer', 'status','id_user'], 'integer'],
            [['tanggal', 'tanggal_deadline'], 'safe'],
            [['deskripsi'], 'string'],
            [['jumlah'], 'number'],
            [['nama'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' =>  \Yii::t('yii', 'Project Name'),//'Nama Proyek',
            'id_costumer' => \Yii::t('yii', 'Company'),//'Costumer',
            'id_user' => \Yii::t('yii', 'User'),//'Nama User',
            'tanggal' => \Yii::t('yii', 'Beginning Date'),//'Tanggal Mulai',
            'deskripsi' => \Yii::t('yii', 'Description'),//'Deskripsi',
            'jumlah' => \Yii::t('yii', 'Total'),//'Jumlah',
            'status' => 'Status',
            'tanggal_deadline' => \Yii::t('yii', 'Deadline Date'),//'Tanggal Deadline',
        ];
    }

    public function getQuartal(){
        $month=(int) date('m',strtotime($this->tanggal));
        if($month>1 and $month<4){
            return "Q1";
            
        } elseif($month>3 and $month<7){
            return "Q2";
        
        } elseif($month>6 and $month<10){
            return "Q3";

        } else {
            return "Q4";

        }

    }
    public function getStatusnya(){
        if($this->status==0){
            return "Open";
        }elseif($this->status==1){
            return "Win";
        } else {
            return "Lose";
        }
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
