<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "barang_podetail".
 *
 * @property int $id
 * @property int $id_barang
 * @property int $qty
 * @property int $id_kode
 * @property int $status
 *
 * @property Barang $barang
 */
class Barangpodetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barang_podetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_barang', 'qty', 'id_kode'], 'required'],
            [['harga_d', 'harga_m'], 'number'],
            [['id_barang', 'qty', 'id_kode', 'status'], 'integer'],
            [['id_barang'], 'exist', 'skipOnError' => true, 'targetClass' => Barang::className(), 'targetAttribute' => ['id_barang' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_barang' =>\Yii::t('yii', 'Commodity'),
            'qty' => \Yii::t('yii', 'Qty'),
            'id_kode' => \Yii::t('yii', 'Code'),
            'status' => \Yii::t('yii', 'Status'),
            'harga_d' => Yii::t('app', 'Harga Dasar'),
            'harga_m' => Yii::t('app', 'Harga Member'),
        ];
    }

    /**
     * Gets query for [[Barang]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBarang()
    {
        return $this->hasOne(Barang::className(), ['id' => 'id_barang']);
    }
}
