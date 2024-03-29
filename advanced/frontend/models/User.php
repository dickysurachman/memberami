<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['username', 'password_hash', 'email'], 'required'],
            [['status', 'created_at', 'updated_at','hak','id_level'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'hak' => 'Role',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'id_level' => 'Level Patner',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
        ];
    }

    public function getLama(){

         
        $date1 = new \DateTime(\date('Y-M-d',$this->created_at));
        $date2 = new \DateTime();
        $interval = $date1->diff($date2);
        return  $interval->y . " ".\Yii::t('yii', 'years').", " . $interval->m." ".\Yii::t('yii', 'months').", ".$interval->d." ".\Yii::t('yii', 'days');
    }

       public function getLevel()
    {
        return $this->hasOne(Level::className(), ['id' => 'id_level']);
    }
       public function getPerusahaan()
    {
        return $this->hasOne(Perusahaan::className(), ['id' => 'id_user']);
    }
       public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

   
}
