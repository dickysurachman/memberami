<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "barang_po".
 *
 * @property int $id
 * @property string $tanggal
 * @property string $kode
 * @property string $dari
 * @property string $keterangan
 * @property int $id_perusahaan
 * @property int $id_user
 * @property int $status
 * @property int|null $add_who
 * @property string|null $add_date
 * @property int|null $edit_who
 * @property string|null $edit_date
 */
class Barangpo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang_po';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           //[['tanggal', 'kode', 'dari', 'keterangan', 'id_perusahaan', 'id_toko'], 'required'],
            [['tanggal', 'add_date', 'edit_date'], 'safe'],
            [['keterangan'], 'string'],
            [['id_perusahaan', 'status','id_user', 'add_who', 'edit_who','id_project'], 'integer'],
            [['curr'], 'string', 'max' => 10],
            [['kode'], 'string', 'max' => 15],
            [['nohp'], 'string', 'max' => 30],
            [['payment','term'], 'string', 'max' => 50],
            [['dari'], 'string', 'max' => 100],
            [['add_who'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['add_who' => 'id']],
            [['edit_who'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['edit_who' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => \Yii::t('yii', 'Date'),
            'kode' => \Yii::t('yii', 'PO Code'),
            'nohp' =>  \Yii::t('yii', 'Sales Mobile Number'),
            'payment' =>  \Yii::t('yii', 'Payment Type'),
            'term' =>  \Yii::t('yii', 'Term'),
            'curr' =>  \Yii::t('yii', 'Currency'),
            'dari' => \Yii::t('yii', 'Sales Name'),
            'keterangan' =>\Yii::t('yii', 'Description'),
            'id_perusahaan' => \Yii::t('yii', 'Company'),
            'id_project'=>\Yii::t('yii', 'Project Name'),
            //'id_toko' => 'User',
            'id_user' => \Yii::t('yii', 'Patner'),//'User',
            'status' => 'Status',
            'add_who' => 'Add Who',
            'add_date' => 'Add Date',
            'edit_who' => 'Edit Who',
            'edit_date' => 'Edit Date',
        ];
    }

    /**
     * Gets query for [[AddWho]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddWho()
    {
        return $this->hasOne(User::className(), ['id' => 'add_who']);
    }

    /**
     * Gets query for [[BarangIndetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarangdetails()
    {
        return $this->hasMany(Barangpodetails::className(), ['id_kode' => 'id']);
    }

    /**
     * Gets query for [[EditWho]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEditWho()
    {
        return $this->hasOne(User::className(), ['id' => 'edit_who']);
    }

    /**
     * Gets query for [[Perusahaan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNamapr()
    {
        $j=Costumer::findOne($this->id_perusahaan);
        if(isset($j)){
            return $j->nama;
        } else {
            return '';
        }


    }
    public function getPerusahaan()
    {
        return $this->hasOne(Costumer::className(), ['id' => 'id_perusahaan']);
    }

    /**
     * Gets query for [[Toko]].
     *
     * @return \yii\db\ActiveQuery
     */
   
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
     public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($this->isNewRecord) {
                $produksi1 = Barangpo::find()->count();
                if($produksi1==0 or $produksi1==""){
                            $produksi=1;
                }else{
                            $produksi=$produksi1+1;
                }
                $novo= "PO" . substr("000000000".$produksi, -8);
                $this->kode=$novo;
                $this->add_who = Yii::$app->user->identity->id;
                $this->add_date = date('Y-m-d H:i:s',time());
            } else {                
                $this->edit_who =Yii::$app->user->identity->id;
                $this->edit_date =  date('Y-m-d H:i:s',time());
            }
            return true;
        } else {
            return false;
        }
    }
}
