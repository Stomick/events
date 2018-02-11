<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

//use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;
if (Yii::$app->user->isGuest) {
    Yii::$app->response->redirect(Yii::$app->getHomeUrl());
    //Yii::$app->getRequest()->redirect();
}
 //echo '<pre>'; print_r($page) ; echo '</pre>';
?>
<div class="container my_account">
    <?php
    $this->params['breadcrumbs'][] = $this->title;
    ?>
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <img class="avatar" src="<?= $account['userAvatar'] ? $account['userAvatar']: 'img/registration_avatar.png' ?>" alt="avatar"/>
            <span class="rank">Юнга</span>
            <div class="link_block">
                <a href="?personal">Личный кабинет</a>
                <a href="?interests">Мои интересы</a>
                <a href="?communities">Мои сообщества</a>
                <a href="?events">Мои события</a>
                <a href="?notice">Мои уведомления</a>
                <a href="?settings">Мои настройки</a>
                <a href="?search">Поиск</a>
                <a href="/logout">Выйти</a>
            </div>

            <h2>Не забудьте</h2>
            <hr/>
            <div class="reminder_block">
                <h3>Идём гулять в парк</h3>
                <hr/>
                <div class="when">
                    <span>Когда:</span>
                    <span>11.11.2018</span>
                </div>
                <div class="time">
                    <span>Во сколько:</span>
                    <span>17:00</span>
                </div>
                <div class="cost">
                    <span>Стоимость:</span>
                    <span>Бесплатно</span>
                </div>
                <div class="meeting_point">
                    <span>Место встречи:</span>
                    <span>Горьковский парк</span>
                </div>
                <a href="" class="more_info">
                    Подробнее
                </a>
            </div>

        </div>
        <div class="col-lg-9 col-md-9">
	        <?php include ''.$page.'.php'; ?>
        </div>
    </div>
</div>
