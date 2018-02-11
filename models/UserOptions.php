<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\imagine\Image;
use yii\helpers\Json;
use yii\helpers\FileHelper;
use app\models\UserSave;
/**
 * UserOptions model
 *
* @property $userCategories [];
* @property $userInfo string;
* @property $userAvatar url image;
* @property $userImage url image;
* @property $user_id int;
* @property $image string;
* @property $imageFile file;
* @property $userPhone;
* @property $userCity;
* @property $userVK;
* @property $userFB;
* @property $userInstagram;
* @property $userTwitter;
 */

class UserOptions extends Model
{

    public $userCategories;
    public $userInfo;
    public $userAvatar;
    public $userImage;
    public $user_id;
    public $image;
    public $imageFile;
	public $userPhone;
	public $userCity;
	public $userVK;
	public $userFB;
	public $userInstagram;
	public $userTwitter;
	public $OldPassword;
	public $NewPassword;
	public $ConfirmNewPassword;

	public function attributeLabels() {
		return array(
			'userCategories'         => 'Мои категории',
			'userInfo'           => '',
			'user_id'           => '',
			'userAvatar'       => '',
			'userImage'         => 'Изменить Аватар',
			'OldPassword'       => 'Текущий пароль',
			'NewPassword'       => 'Новый пароль',
			'ConfirmNewPassword' => 'Подтверждение пароля',
			'userPhone'          => 'Номер телефона'

		);
	}

	public function rules()
	{
		return [
			[

				[ 'NewPassword', 'ConfirmNewPassword' ],
				'required',
				'when' => function ( $model ) {
					return ( $model->password == $model->conf_password );
				},
				'message' => 'Пароли не совпадают',
				'enableClientValidation' => true
			],
			[ 'ConfirmNewPassword', 'compare', 'compareAttribute' => 'NewPassword' ,'message' => 'Пароли не совпадают',],
			[ [ 'NewPassword', 'ConfirmNewPassword' ], 'string', 'min' => 6 ],

			['OldPassword' , 'validatePassword'],
			['userPhone', 'string','min'=> 16, 'max'=> 16],
			['userPhone', 'match', 'pattern' => '/(+7(\[0-9]{6})|0)[-]?[0-9]{7}/'],
			['user_id', 'integer'],
			[['userImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
			[
				'userImage',
				'image',
				'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
				'mimeTypes' => ['image/jpeg', 'image/pjpeg', 'image/png', 'image/gif'],
			],
			['crop_info', 'safe'],
			//['user_id' , 'integer' , 'notnull']
		];
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

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('img/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function base64ToImage($imageData , $user_id){

        $dir = 'img/user_' . $user_id;

        list($type, $imageData['image']) = explode(';', $imageData['image']);
        list(,$extension) = explode('/',$type);
        list(,$imageData['image'])      = explode(',', $imageData['image']);
	    $img_n = imagecreatefromstring(base64_decode($imageData['image']));
        if(!is_dir( $dir)){
            mkdir($dir, 0755,true);
        }
	    $fileName =  $dir . '/avatar_'.$user_id .'.'. $extension ;
	    $img_o = imagecreatetruecolor($imageData['width'], $imageData['height']);
        imagecopy($img_o, $img_n, 0, 0,  $imageData['x'], $imageData['x'], $imageData['dWidth'], $imageData['dHeight']);
	    imagepng($img_n, $fileName  , 0);
        //file_put_contents($fileName, $img_o);
        return $fileName;
    }

    public function afterSave($insert, $changedAttributes)
    {

        // open image
        if(Image::getImagine()->open($this->image->tempName)) {
            $image = Image::getImagine()->open($this->image->tempName);

            // rendering information about crop of ONE option
            $cropInfo = Json::decode($this->crop_info)[0];
            $cropInfo['dWidth'] = (int)$cropInfo['dWidth']; //new width image
            $cropInfo['dHeight'] = (int)$cropInfo['dHeight']; //new height image
            $cropInfo['x'] = $cropInfo['x']; //begin position of frame crop by X
            $cropInfo['y'] = $cropInfo['y']; //begin position of frame crop by Y
            // Properties bolow we don't use in this example
            //$cropInfo['ratio'] = $cropInfo['ratio'] == 0 ? 1.0 : (float)$cropInfo['ratio']; //ratio image.
            //$cropInfo['width'] = (int)$cropInfo['width']; //width of cropped image
            //$cropInfo['height'] = (int)$cropInfo['height']; //height of cropped image
            //$cropInfo['sWidth'] = (int)$cropInfo['sWidth']; //width of source image
            //$cropInfo['sHeight'] = (int)$cropInfo['sHeight']; //height of source image

            //delete old images
            $oldImages = FileHelper::findFiles(Yii::getAlias('@path/to/save/image'), [
                'only' => [
                    $this->id . '.*',
                    'thumb_' . $this->id . '.*',
                ],
            ]);
            for ($i = 0; $i != count($oldImages); $i++) {
                @unlink($oldImages[$i]);
            }

            //saving thumbnail
            $newSizeThumb = new Box($cropInfo['dWidth'], $cropInfo['dHeight']);
            $cropSizeThumb = new Box(200, 200); //frame size of crop
            $cropPointThumb = new Point($cropInfo['x'], $cropInfo['y']);
            $pathThumbImage = Yii::getAlias('@path/to/save/image')
                . '/thumb_'
                . $this->id
                . '.'
                . $this->image->getExtension();

            $image->resize($newSizeThumb)
                ->crop($cropPointThumb, $cropSizeThumb)
                ->save($pathThumbImage, ['quality' => 100]);

            //saving original
            $this->image->saveAs(
                Yii::getAlias('@path/to/save/image')
                . '/'
                . $this->id
                . '.'
                . $this->image->getExtension()
            );
        }
    }
    /**
     * @inheritdoc
     */


    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        // TODO: Implement getId() method.
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, $this->password_hash);
	}

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function complited() {

        $test = null;
    try {
        if($userDetails = UserSave::find()
		    ->where(['user_id' => Yii::$app->user->getId()])
		    ->one()) {
	        $userDetails->userCategories = json_encode( $this->userCategories );
	        $userDetails->userAvatar     = $this->base64ToImage( json_decode( $this->userAvatar, true )[0], $this->user_id );
	        $userDetails->userInfo       = $this->userInfo;
	        $test                        = $userDetails->update();
        }
        else{
	        $userDetails = new UserSave();
	        $userDetails->user_id        = intval( $this->user_id );
	        $userDetails->userCategories = json_encode( $this->userCategories );
	        $userDetails->userAvatar     = $this->base64ToImage( json_decode( $this->userAvatar, true )[0], $this->user_id );
	        $userDetails->userInfo       = $this->userInfo;
	        $test                        = $userDetails->update();
        }
    }catch (\Exception $e){
        print_r($e->getMessage());
    }
        //$userDetails->validate(true);
        return   $test ? true :false;
    }
}