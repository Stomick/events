<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */
//use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Hello Епта :))))';
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->user->isGuest){
    Yii::$app->response->redirect(Yii::$app->getHomeUrl());
    //Yii::$app->getRequest()->redirect();
}
?>
<div class="site-login">
       <h1><?= Html::encode($this->title) ?></h1>
</div>
