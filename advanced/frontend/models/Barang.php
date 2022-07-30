<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "barang".
 *
 * @property int $id
 * @property string|null $kode
 * @property string|null $nama
 * @property string|null $ukuran
 * @property int|null $stok_awal
 * @property int|null $id_perusahaan
 * @property int|null $id_toko
 * @property int $status
 *
 * @property BarangIndetail[] $barangIndetails
 * @property BarangOutdetail[] $barangOutdetails
 * @property Perusahaan $perusahaan
 * @property TransferDetail[] $transferDetails
 */
class Barang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stok_awal', 'id_perusahaan', 'id_toko', 'status','harga'], 'integer'],
            [['kode'], 'string', 'max' => 25],
            [['nama'], 'string', 'max' => 250],
            [['ukuran'], 'string'],
            //[['id_perusahaan'], 'exist', 'skipOnError' => true, 'targetClass' => Perusahaan::className(), 'targetAttribute' => ['id_perusahaan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
            'harga' => 'Harga',
            'qtyin' => 'Qty In',
            'qtyout' => 'Qty Out',
            'sisaa' => 'Sisa',
            'ukuran' => 'Deskripsi',
            'stok_awal' => 'Stok Awal',
            'id_perusahaan' => 'Perusahaan',
            'id_toko' => 'Member',
            'status' => 'Status',
        ];
    }

   
   
    /**
     * Gets query for [[BarangIndetails]].
     *
     * @return \yii\db\ActiveQuery
     */
   

    /**
     * Gets query for [[BarangOutdetails]].
     *
     * @return \yii\db\ActiveQuery
     */

    /**
     * Gets query for [[Perusahaan]].
     *
     * @return \yii\db\ActiveQuery
     */

    /**
     * Gets query for [[TransferDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
     public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if($this->isNewRecord)
                    {
                        //$this->id_perusahaan=Yii::$app->user->identity->id_perusahaan;
                    }
                    else
                    {
                    }
            return true;
        } else {
            return false;
        }
    }
}