<?php

namespace app\form;

use Yii;
use yii\base\Model;
/**
 * Signup form
 */

class AccountForm extends Model
{
    public $user;
    /**
     * @inheritdoc
     */

    public function attributeLabels() {
        return array();
    }

    public function getUser($id){
        return User::find()
            ->where(['user_id' => $id])
            ->one();
    }

    public function rules()
    {
        return [ ];
    }

}