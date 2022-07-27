<?php
namespace frontend\models;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class Bahasa extends Model
{
    public $bahasa;


    /**
     * @inheritdoc
     */

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function rules()
    {
        return [
            [['bahasa'], 'string'],
        ];
    }
    public function attributeLabels()
    {
        
        if(isset(Yii::$app->session['lang'])){
            $en=Yii::$app->session['lang'];
            if($en=='en'){
                  return [
                            'bahasa' => 'Language',
                        ];
            }else{
                  return [
                            'bahasa' => 'Setting Bahasa',
                        ];            
            }


        } else{            
        return [
            'bahasa' => 'Language',
        ];
        }
    }
	 
}