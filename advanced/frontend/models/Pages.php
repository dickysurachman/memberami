<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string $judul
 * @property string $konten
 * @property int|null $status
 * @property string $slug
 * @property string $created
 */
class Pages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['judul', 'konten', 'slug'], 'required'],
            [['konten'], 'string'],
            [['status'], 'integer'],
            [['created'], 'safe'],
            [['judul'], 'string', 'max' => 100],
            [['slug'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'judul' => \Yii::t('yii', 'Title'),
            'konten' => \Yii::t('yii', 'Content'),
            'status' => \Yii::t('yii', 'Status'),
            'slug' => \Yii::t('yii', 'Slug'),
            'created' => \Yii::t('yii', 'Created')
        ];
    }
}
