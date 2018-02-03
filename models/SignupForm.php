<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model {

	public $username;
	public $surename;
	public $birthday;
	public $email;
	public $password;
	public $conf_password;
	public $gender;
	public $rememberMe;

	/**
	 * @inheritdoc
	 */

	public function attributeLabels() {
		return array(
			'email'         => 'E-mail адресс',
			'username'      => 'Ваше имя',
			'surename'      => 'Ваша фамилия',
			'password'      => 'Пароль',
			'conf_password' => 'Подтверждение пароля',
			'gender'        => 'Выберите пол',
			//'captcha'   => 'Введите код с картинки:',
		);
	}

	public function rules() {
		return [
			[ 'username', 'trim' ],
			[ 'username', 'required' ],
			[ 'username', 'string', 'min' => 2, 'max' => 25 ],
			[ 'surename', 'trim' ],
			[ 'surename', 'required' ],
			[ 'surename', 'string', 'min' => 2, 'max' => 25 ],
			[ [ 'birthday' ], 'required' ],
			[ [ 'birthday' ], 'safe' ],
			[ 'birthday', 'date', 'format' => 'yyyy-M-d' ],
			[ 'gender', 'required'],
			[ 'email', 'trim' ],
			[ 'email', 'email' ],
			[ 'email', 'string', 'max' => 25 ],
			[
				[ 'password', 'conf_password' ],
				'required',
				'when' => function ( $model ) {
					return ( $model->password == $model->conf_password );
				},
				'message' => 'Пароли не совпадают',
				'enableClientValidation' => false
			],
			[ 'password', 'compare', 'compareAttribute' => 'conf_password' ],
			[ [ 'password', 'conf_password' ], 'string', 'min' => 6 ],
		];
	}


	/**
	 * Signs user up.
	 *
	 * @return User|null the saved model or null if saving fails
	 */

	public function signup() {

		if ( null != User::findOne(['email' => $this->email]) || !$this->validate() ) {
			return null;
		}

		$user           = new User();
		$user->username = $this->username;
		$user->surename = $this->surename;
		$user->birthday = $this->birthday;
		$user->gender   = $this->gender;
		$user->email    = $this->email;
		$user->setPassword( $this->password );
		$user->generateAuthKey();

		return $user->save() ? $user : null;
	}

}