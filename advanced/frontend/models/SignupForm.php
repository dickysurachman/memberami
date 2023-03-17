<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;
use app\models\Perusahaan;
use yii\web\UploadedFile;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $email_c;
    public $email_s;
    public $password;
    public $nama;
    public $alamat;
    public $nama_d;
    public $nama_s;
    public $telp;
    public $telp_s;
    public $telp_c;
    public $logo;
    public $akta;
    public $kemenkumham;
    public $nib;
    public $npwp;
    public $id_kota;
    public $npwp_f;
    public $status;
    public $id_user;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            [['email','email_c','email_s'], 'trim'],
            ['email', 'required'],
            [['email','email_c','email_s'], 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            [['nama', 'alamat', 'nama_d','akta','npwp_f','kemenkumham','nib','email_c','telp_c','telp','logo','npwp'], 'required'],
            [['id_user', 'id_kota', 'status'], 'integer'],
            [['nama', 'nama_d','nama_s','email_c','email_s'], 'string', 'max' => 100],
            [['alamat'], 'string', 'max' => 150],
            [['npwp'], 'string', 'max' => 30],
            [['telp'], 'string', 'max' => 20],
            [['telp_s','telp_c'], 'string', 'max' => 50],
            [['logo'], 'string', 'max' => 250],
            [['akta','npwp_f','kemenkumham','nib'], 'string', 'max' => 125],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => \Yii::t('yii', 'User'),
            'nama' => \Yii::t('yii', 'Company Name'),
            'alamat' => \Yii::t('yii', 'Address'),
            'nama_d' => \Yii::t('yii', 'CEO Name'),//'Nama Direktur',
            //'email' => \Yii::t('yii', 'CEO Email'),//'Nama Direktur',
            'email_s' => \Yii::t('yii', 'Sales Email'),//'Nama Direktur',
            'email_c' => \Yii::t('yii', 'CEO Email'),//'Nama Direktur',
            'nama_s' => \Yii::t('yii', 'Sales Name'),//'Nama Direktur',
            'npwp' => \Yii::t('yii', 'Company NPWP'),//'NPWP Perusahaan',
            'id_kota' => \Yii::t('yii', 'City'),//'Kota',
            'telp' => \Yii::t('yii', 'CEO Mobile Number'),//'Telp',
            'telp_s' => \Yii::t('yii', 'Sales Mobile Number'),//'Telp',
            'telp_c' => \Yii::t('yii', 'Company Mobile Number'),//'Telp',
            'logo' => \Yii::t('yii', 'Logo Picture'),//'Logo',
            'akta' => \Yii::t('yii', 'AKTA File'),//'Logo',
            'npwp_f' => \Yii::t('yii', 'NPWP File'),//'Logo',
            'kemenkumham' => \Yii::t('yii', 'KEMENKUMHAM File'),//'Logo',
            'nib' => \Yii::t('yii', 'NIB File'),//'Logo',
            'status' => 'Status',
           
        ];
    }
    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        //if (!$this->validate()) {
        //    return null;
        //}
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $user->save();
        $perusahaan = new Perusahaan();
        $perusahaan->id_user=$user->id;
        $perusahaan->nama=$this->nama;
        $perusahaan->telp_c=$this->telp_c;
        $perusahaan->telp_s=$this->telp_s;
        $perusahaan->nama_d=$this->nama_d;
        $perusahaan->nama_s=$this->nama_s;
        $perusahaan->telp=$this->telp;
        $perusahaan->email=$this->email_c;
        $perusahaan->email_s=$this->email_s;
        $perusahaan->id_kota=$this->id_kota;
        $perusahaan->npwp=$this->npwp;
        $perusahaan->alamat=$this->alamat;
        $perusahaan->logo = UploadedFile::getInstance($this, 'logo');
                if(isset($perusahaan->logo)){
                $namafile=rand(1000, 99999999);
                if(strpos(" jpg jpeg bmp gif png ",strtolower($perusahaan->logo->extension))){                
                    $file1= $namafile . '.' . $perusahaan->logo->extension;
                    $perusahaan->logo->saveAs('images/' . $file1,TRUE);
                } else {
                    $file1= $namafile . '.jpg' ;
                    $perusahaan->logo->saveAs('images/' . $file1,TRUE);
                }
                $perusahaan->logo=$file1;
                } 
             

                $perusahaan->akta = UploadedFile::getInstance($this, 'akta');
                if(isset($perusahaan->akta)){
                $namafile=rand(1000, 99999999);
                if(strpos(" pdf ",strtolower($perusahaan->akta->extension))){                
                    $file1= $namafile . '.' . $perusahaan->akta->extension;
                    $perusahaan->akta->saveAs('images/dll/' . $file1,TRUE);
                } else {
                    $file1= $namafile . '.jpg' ;
                    $perusahaan->akta->saveAs('images/dll/' . $file1,TRUE);
                }
                $perusahaan->akta=$file1;
                } 
                

                $perusahaan->nib = UploadedFile::getInstance($this, 'nib');
                if(isset($perusahaan->nib)){
                $namafile=rand(1000, 99999999);
                if(strpos(" pdf ",strtolower($perusahaan->nib->extension))){                
                    $file1= $namafile . '.' . $perusahaan->nib->extension;
                    $perusahaan->nib->saveAs('images/dll/' . $file1,TRUE);
                } else {
                    $file1= $namafile . '.jpg' ;
                    $perusahaan->nib->saveAs('images/dll/' . $file1,TRUE);
                }
                $perusahaan->nib=$file1;
                } 
               

                $perusahaan->npwp_f = UploadedFile::getInstance($this, 'npwp_f');
                if(isset($perusahaan->npwp_f)){
                $namafile=rand(1000, 99999999);
                if(strpos(" pdf ",strtolower($perusahaan->npwp_f->extension))){                
                    $file1= $namafile . '.' . $perusahaan->npwp_f->extension;
                    $perusahaan->npwp_f->saveAs('images/dll/' . $file1,TRUE);
                } else {
                    $file1= $namafile . '.jpg' ;
                    $perusahaan->npwp_f->saveAs('images/dll/' . $file1,TRUE);
                }
                    $perusahaan->npwp_f=$file1;
                } 
                

                $perusahaan->kemenkumham = UploadedFile::getInstance($this, 'kemenkumham');
                if(isset($perusahaan->kemenkumham)){
                $namafile=rand(1000, 99999999);
                if(strpos(" pdf ",strtolower($perusahaan->kemenkumham->extension))){                
                    $file1= $namafile . '.' . $perusahaan->kemenkumham->extension;
                    $perusahaan->kemenkumham->saveAs('images/dll/' . $file1,TRUE);
                } else {
                    $file1= $namafile . '.jpg' ;
                    $perusahaan->kemenkumham->saveAs('images/dll/' . $file1,TRUE);
                }
                $perusahaan->kemenkumham=$file1;
                } 
                
                $perusahaan->save();
        return $user;
        //return $user->save() && $this->sendEmail($user);
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
