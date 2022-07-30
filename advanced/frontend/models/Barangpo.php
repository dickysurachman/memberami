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
            [['id_perusahaan', 'status','id_user', 'add_who', 'edit_who'], 'integer'],
            [['kode'], 'string', 'max' => 15],
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
            'tanggal' => 'Tanggal',
            'kode' => 'Kode',
            'dari' => 'Dari',
            'keterangan' => 'Keterangan',
            'id_perusahaan' => 'Perusahaan',
            //'id_toko' => 'User',
            'id_user' => 'User',
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
    public function getPerusahaan()
    {
        return $this->hasOne(Perusahaan::className(), ['id' => 'id_perusahaan']);
    }

    /**
     * Gets query for [[Toko]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getToko()
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
                            $produksi++;
                }
                $novo= "PO" . substr("000000000".$produksi, -8);
                $this->kode=$novo;
                //$produksi1->urutbon=$produksi;
                //$produksi1->save();
                //$this->id_perusahaan=Yii::$app->user->identity->id_perusahaan;
                //$this->id_toko=Yii::$app->user->identity->id_toko;
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