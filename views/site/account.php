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
?>
<!--<div class="site-login">-->
<!--       <h1>--><?
//= Html::encode($this->title)
?><!--</h1>-->
<!--</div>-->
<?php
// echo '<pre>'; print_r($account) ; echo '</pre>';
?>
<div class="container my_account">
    <?php
    $this->params['breadcrumbs'][] = $this->title;
    ?>
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <img class="avatar" src="<?= $account['userAvatar'] ?>" alt="avatar"/>
            <span class="rank">Юнга</span>
            <div class="link_block">
                <a href="">Личный кабинет</a>
                <a href="">Мои интересы</a>
                <a href="">Мои сообщества</a>
                <a href="">Мои события</a>
                <a href="">Мои уведомления</a>
                <a href="">Поиск</a>
                <a href="">Выйти</a>
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
            <div class="row name">
                <h1><?= $account['username'] . ' ' . $account['surename']  ?></h1>
                <span class="days_on_the_site">На шкипере уже 64 дня</span>
                <hr/>
            </div>
            <div class="row pad_0">
                <div class="col-lg-5 col-md-5 pad_0">
                    <div class="name_block">
                        <span>Имя:</span>
                        <span><?= $account['username']?></span>
                    </div>
                    <div class="surname_block">
                        <span>Фамилия:</span>
                        <span><?= $account['surename']?></span>
                    </div>
                    <div class="date_of_birth_block">
                        <span>Дата рождения:</span>
                        <span><?= date("d.m.Y", strtotime($account['birthday']));?></span>
                    </div>
                    <div class="city_block">
                        <span>Город:</span>
                        <span><?= $account['userCity'] ? $account['userCity'] : 'Не заполнено'?></span>
                    </div>
                    <div class="password_block">
                        <a href="">Изменить пароль</a>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 pad_0">
                    <div class="phone_block">
                        <span>Номер телефона:</span>
                        <span><?= $account['userPhone']? $account['userPhone'] : 'Не заполнено' ?></span>
                    </div>
                    <div class="email_block">
                        <span>E-mail:</span>
                        <span><?= $account['email']?></span>
                    </div>
                    <div class="send_notifications_block">
                        <label>
                            <input type="checkbox" checked>
                            Присылать уведомления на почту
                        </label>
                    </div>
                    <div class="share_my_events_block">
                        <label>
                            <input type="checkbox" checked>
                            Открыть доступ к моим событиям
                        </label>
                    </div>
                    <div class="share_my_communities_block">
                        <label>
                            <input type="checkbox" checked>
                            Открыть доступ к моим сообществам
                        </label>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 pad_0 social">
                    <a href="">1</a>
                    <a href="">2</a>
                    <a href="">3</a>
                    <a href="">4</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 pad_0">
                    <h2>Шкала опыта</h2>
                    <hr/>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 pad_0">
                    <h2>О себе:</h2>
                    <hr/>
                    <span>
                        <?= $account['userInfo']?>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 pad_0 notice">
                    <div class="notice_block">
                        <h2>Мои уведомления:</h2>
                        <a href="">Все уведомления</a>
                    </div>
                    <hr/>
                </div>
            </div>
        </div>
    </div>
</div>
