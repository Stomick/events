<?php

namespace app\controllers;

use app\models\CategoryModel;
use app\models\UserOptions;
use app\models\UserSave;
use app\models\User;
use app\models\AccountModel;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SignupForm;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\base\UnknownClassException;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'signup' , 'category' , 'regcomplited'],
                'rules' => [
                    [
                        'actions' => ['login' , 'signup' , 'account' , 'regcomplited'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'login' ,'signup', 'regcomplited', 'account' , 'category'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actionIndex()
    {
        return $this->render('index' , ['index' => true]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */


    public function actionCategory()
    {
        $model = new CategoryModel();
        if(intval(Yii::$app->request->get()) > 0){
          $model->getOneCategory(Yii::$app->request->get());
        }
        return $this->render('category', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            if($model->username == null)
            {
                $model->username = $model->getName($model->email);
            }
            if(!$model->login()) {
                return $this->goBack();
            }
        }

        return $this->redirect('account');
    }

    public function actionRegcomplited()
    {
        $model = new UserOptions();
        foreach (Yii::$app->request->post()['UserOptions'] as $k => $v){
            $model[$k] = $v;
        }
        $model['user_id'] = Yii::$app->user->getId();
        echo $model->complited();

    }


    public function actionAccount(){
	    if (!Yii::$app->user->getId()) {
		    return $this->goHome();
	    }else {
		    $account = (new \yii\db\Query())
			    ->from('user')
			                ->select(
			                	[	'user.user_id' ,
					                'userAvatar' ,
					                'username',
					                'surename' ,
					                'birthday',
					                'userCity',
					                'userPhone',
					                'email',
					                'userInfo'
					                ]
			                )
		                    ->where([
							    'user.user_id' => Yii::$app->user->getId(),
							    'status' => User::STATUS_ACTIVE,
						    ])->join(	'inner join',
				    'user_details',
				    'user_details.user_id = user.user_id')
		    ->one();
	    }
	    $inc = [];
	    foreach ( Yii::$app->request->get() as $item => $value ) {
			    $inc[$item] = $value;
	    }

	    if(key($inc) == 'id'){
	    	$gust_acc = $account = (new \yii\db\Query())
			    ->from('user')
			    ->select(
			    	[	'user.user_id' ,
				    'userAvatar' ,
				    'username',
				    'surename' ,
				    'birthday',
				    'userCity',
				    'userPhone',
				    'email',
				    'userInfo'
			    ])
			    ->where([
				    'user.user_id' => intval($inc['id']),
				    'status' => User::STATUS_ACTIVE,
			    ])->join(	'inner join',
				    'user_details',
				    'user_details.user_id = user.user_id')
			    ->one();
		    return $this->render( 'account/main', [
			    'account'   => $account,
			    'page'      => 'guest',
			    'guest_acc' => $gust_acc
		    ] );
	    }
	    else {
		    return $this->render( 'account/main', [
			    'account'   => $account,
			    'page'      => count( $inc ) == 0 ? 'personal' : key( $inc ),
			    'item_page' => $inc
		    ] );
	    }
    }

	public function actionUpload()
	{
		$model = new UploadForm();

		if (Yii::$app->request->isPost) {
			$model->imageFile = UploadedFile::getInstance($model, 'imageFile');
			if ($model->upload()) {
				// file is uploaded successfully
				return;
			}
		}
		return $model;
		//return $this->render('upload', ['model' => $model]);
	}
    public function actionSignup()
    {

        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (!Yii::$app->getUser()->login($user) || $user == null) {
                	var_dump($user);
                    return $this->goHome();
                }
            }
            else{
	            return $this->goHome();
            }
        }else{
	        return $this->goHome();
        }

        if(!UserSave::find()
            ->where(['user_id' => Yii::$app->user->getId()])
            ->one()){
	        $options = new UserSave();
	        $options->user_id = Yii::$app->user->getId();
	        $options->save();
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
