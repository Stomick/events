<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
/**
 * Signup form
 */

class IndividualForm extends Model
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