<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "podetail".
 *
 * @property string $tanggal
 * @property string $nama
 * @property string $kode
 * @property float|null $total
 */
class Podetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'podetail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal', 'nama', 'kode'], 'required'],
            [['tanggal'], 'safe'],
            [['total'], 'number'],
            [['nama'], 'string', 'max' => 100],
            [['kode'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tanggal' => Yii::t('app', 'Tanggal'),
            'nama' => Yii::t('app', 'Nama'),
            'kode' => Yii::t('app', 'Kode'),
            'total' => Yii::t('app', 'Total'),
        ];
    }
}
