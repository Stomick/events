<?php
/**
 * Created by PhpStorm.
 * User: Stomick
 * Date: 03.02.2018
 * Time: 20:18
 */

namespace app\models;

use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


class UserOptions extends ActiveRecord {

	public $categoryes;
	public $user;

	public static function tableName()
	{
		return '{{%user_to_category}}';
	}

	public function attributeLabels() {
		return array(
			'categoryes' => ''
			//'captcha'   => 'Введите код с картинки:',
		);
	}
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			TimestampBehavior::className(),
		];
	}
}