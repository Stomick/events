<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
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
//			[ 'username', 'match', 'pattern' => '/^[А-я]\w*$/i'],
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
			['email', 'unique', 'targetClass'=> 'app\models\User' , 'message' => 'Такой емаил уже занят', ],
			[ 'email', 'string', 'max' => 50 ],
			[
				[ 'conf_password', 'password',  ],
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

		$user           = new User();

		if ( null != $user->findOne(['email' => $this->email]) || !$this->validate() ) {
			return null;
		}


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