<?php
/**
 * Created by PhpStorm.
 * User: Stomick
 * Date: 09.02.2018
 * Time: 21:22
 */

namespace app\models;


use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;

class UserSave extends ActiveRecord {
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{user_details}}';
	}
	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}
	public static function getAvatar($id){
		return static::find()
		             ->select('userAvatar')
		             ->where(['user_id' => $id])
		             ->one();
	}

}