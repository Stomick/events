<?php

/* @var $this \yii\web\View */

/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\SignupForm;
use yii\bootstrap\ActiveForm;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <?php

    NavBar::begin([
        'brandLabel' => Html::img('img/logo.png'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-fixed-top',
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [

            Yii::$app->user->isGuest ? (
            ['label' => 'Регистрация',
                'options' => ['class' => 'btn-md', 'data-toggle' => 'modal', 'data-target' => "#registration"],
            ]) : (''),

            Yii::$app->user->isGuest ? (
            ['label' => 'Войти',
                'options' => ['class' => 'btn-md btn-link', 'data-toggle' => 'modal', 'data-target' => "#login"]]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'get')
                . Html::submitButton(
                    'Выход (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar'],
        'items' => [
            ['label' => 'Как это работает', 'class' => 'nav_link', 'url' => ['#']],
        ],
    ]);

    NavBar::end();
    ?>

    <div class="container-fluid pad_0">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="registration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Зарегистрируйтесь с помощью соц. сетей</h4>
                <h4>Или пройдите обычную регистрация</h4>
                <?php $signmodel = new SignupForm(); ?>
                <?php $form = ActiveForm::begin(['id' => 'form-signup', 'action' => '/signup.html', 'method' => 'post']); ?>
                <?= $form->field($signmodel, 'gender')->radioList([
                    'мужской' => 'Мужчина',
                    'женский' => 'Женщина',
                ])->label(false); ?>
                <?= $form->field($signmodel, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Введите имя'])->label(false) ?>
                <?= $form->field($signmodel, 'surename')->textInput(['autofocus' => true, 'placeholder' => 'Введите фамилию'])->label(false) ?>
                <?= $form->field($signmodel, 'email')->input('email',['placeholder' => 'Введите Вашу почту'])->label(false) ?>
                <?= $form->field($signmodel, 'password')->passwordInput(['autofocus' => true, 'placeholder' => 'Введите пароль'])->label(false) ?>
                <?= $form->field($signmodel, 'conf_password')->passwordInput(['autofocus' => true, 'placeholder' => 'Введите пароль еше раз'])->label(false) ?>
                <?= $form->field($signmodel, 'birthday')->widget(\yii\jui\DatePicker::className(), [
                    'language' => 'ru',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'changeMonth' => true,
                        'changeYear'=> true,
                        ]
                ])->label(false) ?>
                <?= $form->field($signmodel, 'rememberMe')->checkbox()->label('Запомнить меня') ?>
                <div class="form-group">
                    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
                <span>
                    Регистрируясь через электронную почту, Facebook или VK, Вы принимаете наши
                    <a href="">
                        Условия использования
                    </a>и
                    <a href="">
                        Политику конфиденциальности.
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

<!-- Modal_2 -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h4>Или с помощью почты</h4>
                <?php $loginmodel = new \app\models\LoginForm(); ?>
                <?php $loginform = ActiveForm::begin(['id' => 'form-login', 'action' => '/login.html', 'method' => 'post']); ?>

                <?= $loginform->field($loginmodel, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Введите Вашу почту'])->label(false) ?>
                <?= $loginform->field($loginmodel, 'password')->passwordInput(['autofocus' => true, 'placeholder' => 'Введите пароль'])->label(false) ?>
                <?= $loginform->field($loginmodel, 'rememberMe')->checkbox()->label('Запомнить меня') ?>
                <div class="form-group">
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<!-- Modal_2 -->

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Skiper <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
