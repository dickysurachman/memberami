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
            //[['kode'], 'unique'],
            [['stok_awal', 'id_perusahaan', 'id_toko', 'status','harga'], 'safe'],
            [['kode'], 'string', 'max' => 25],
            [['nama'], 'string', 'max' => 250],
            [['ukuran'], 'safe'],
            //[['id_perusahaan'], 'exist', 'skipOnError' => true, 'targetClass' => Perusahaan::className(), 'targetAttribute' => ['id_perusahaan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */


    public function getState(){
        if($this->status==0) {
            return 'Indent';
        } else {
            return 'Ready';

        }

    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => Yii::t('yii', 'Code'),
            'nama' => Yii::t('yii', 'Name'),
            'harga' => Yii::t('yii', 'Price'),
            'qtyin' => Yii::t('yii', 'Qty In'),
            'qtyout' => Yii::t('yii', 'Qty Out'),
            'sisaa' => Yii::t('yii', 'Qty Total'),
            'ukuran' => Yii::t('yii', 'Description'),
            'stok_awal' => Yii::t('yii', 'Beginning Stock'),
            'id_perusahaan' =>Yii::t('yii', 'Company'),
            'id_toko' => Yii::t('yii', 'Partner'),
            'status' => Yii::t('yii', 'Status'),
        ];
    }

    public function getHargamember(){
        $userd=User::findOne(Yii::$app->user->identity->id);    
        $user=Level::findOne($userd->id_level);
        if(isset($user)) {
            $harga =$this->harga - ($this->harga * $user->diskon/100);
            return number_format($harga);
        } else {
            return 'price did not set';
        }
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
