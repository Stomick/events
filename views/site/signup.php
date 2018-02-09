<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

//use Yii;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\UserOptions;
use app\models\UploadForm;
use bupy7\cropbox\CropboxWidget;

//$this->title = 'Hello Епта :))))';
//$this->params['breadcrumbs'][] = $this->title;
/*
if(Yii::$app->user->isGuest){
	Yii::$app->response->redirect(Yii::$app->getHomeUrl());
	Yii::$app->getRequest()->redirect();
}
*/
?>
<div class="site-login site_login_pad_top">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">
        <!-- Indicators -->
        <ol class="carousel-indicators" id="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active">1</li>
            <li data-target="#carousel-example-generic" data-slide-to="1">2</li>
            <li data-target="#carousel-example-generic" data-slide-to="2">3</li>
            <li data-target="#carousel-example-generic" data-slide-to="3">4</li>
        </ol>
        <!-- Wrapper for slides -->
        <?php $form = ActiveForm::begin([
            'id' => 'form-extend-signup',
        ]); ?>
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h2>
                                Выберите категории которые Вам интересны
                            </h2>
                            <h3>
                                Каждый день вокруг вас происходят сотни событий. <br/>
                                Не упустите что-нибудь интересное - Подпишитесь на уведомления!
                            </h3>


                            <?php $userOptions = new UserOptions(); ?>
                            <?php echo $form->field($userOptions, 'userCategories')->checkboxList(
                                \yii\helpers\ArrayHelper::map(app\models\Category::find()->all(),
                                    "category_id",
                                    "name"
                                ), [
                                'item' =>
                                    function ($index, $label, $name, $checked, $value) {
                                        return Html::checkbox($name, $checked, [
                                            'value' => $value,
                                            'label' => $label,
                                            'labelOptions' => [
                                                'class' => 'ckbox ckbox-primary col-md-3',
                                            ],
                                            //'id' => $label,
                                        ]);
                                    },

                                'separator' => false,
                                'template' => '<div class="item">{input}{label}</div>',
                            ]);
                            ?>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 col-md-10">
                            <div class="progress_bar_indicator">
                                <span class="indicator indicator_short"></span>
                                <span class="indicator indicator_short"></span>
                                <span class="indicator indicator_short"></span>
                                <span class="indicator">|</span>
                                <span class="indicator indicator_short"></span>
                                <span class="indicator indicator_short"></span>
                                <span class="indicator indicator_short"></span>
                                <span class="indicator">|</span>
                                <span class="indicator indicator_short"></span>
                                <span class="indicator indicator_short"></span>
                                <span class="indicator indicator_short"></span>
                                <span class="indicator">|</span>
                                <span class="indicator indicator_short"></span>
                                <span class="indicator indicator_short"></span>
                                <span class="indicator indicator_short"></span>
                            </div>
                            <div class="progress-bar blue stripes">
                                <span data_p="6.25"></span>
                            </div>
                            <p id="test">test</p>

                            <script>
                                var progress_percent = document.querySelector('.progress-bar span').getAttribute('data_p');
                                var progress_percent_sum = +progress_percent + 6.25;

                                document.getElementById('test').onclick = function () {
                                    $('span').attr('data_p', progress_percent_sum);
                                    console.log(document.querySelector('.progress-bar span').getAttribute('data_p'));
                                }
                            </script>

                        </div>
                        <div class="col-lg-2 col-md-2">
                            <a class="right carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="next">
                                Следующий шаг
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h2>
                                Загрузите Ваше фото
                            </h2>
                            <h3>
                                Это повысит к Вам доверие
                            </h3>
                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);

                            echo $form->field($userOptions, 'userImage')->widget(CropboxWidget::className(), [
                                'croppedDataAttribute' => 'userAvatar',
                                'pluginOptions' => [

                                    'variants' => [
                                        [
                                            'width' => 190,
                                            'height' => 230,
                                            'minWidth' => 190,
                                            'minHeight' => 230,
                                            'maxWidth' => 190,
                                            'maxHeight' => 230,
                                        ],
                                    ],
                                ],
                            ]); ?>
                            <?php ActiveForm::end(); ?>

                            <script>
                                document.getElementById('uploadform-image').onclick = function () {
                                    //document.getElementById('demo_avatar').style.display = 'none';
                                }
                            </script>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <a class="right carousel-control" href="#carousel-example-generic" role="button"
                               data-slide="next">
                                Следующий шаг
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h2>
                                Расскажите немного о себе
                            </h2>
                            <h3>
                                Просто напишите пару строк о своей жизни и увлечениях;)<br/>
                                это поможет найти близких по духу людей
                            </h3>
                            <?php echo $form->field($userOptions, 'userInfo')->textarea([
                                'id' => 'signupTextarea',
                                'placeholder' => 'Начните писать тут',
                                'rows' => '8',
                                'maxlength' => "255",
                            ]);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <a hidden id="next_reg_step" class="right carousel-control" href="#carousel-example-generic"
                               role="button"
                               data-slide="next">
                                Следующий шаг
                            </a>
                        </div>

                        <input type="button" class="carousel-control" value="Завершить регистрацию" id="reg_complite"
                               onclick="nextStep()"/>

                        <script>
                            function nextStep() {
                                $.ajax({
                                    type: "POST",
                                    url: '/regcomplited',
                                    data: $('#form-extend-signup').serializeArray(),
                                    success: function () {
                                        $('#next_reg_step').click();
                                        document.getElementById('carousel-indicators').style.display = 'none';
                                    },
                                });

                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="item create_event_block">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <h2>
                                Не ждите, а действуйте!
                            </h2>
                            <h3>
                                Найдите или создайте свой первый ивент прямо сейчас
                            </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <button type="submit" class="btn btn-primary" name="" url="">
                                Найти компанию
                            </button>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <a class="create_event_2" href="">
                                Создать мероприятие
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Controls -->
        <!--        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">-->
        <!--            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>-->
        <!--            <span class="sr-only">Previous</span>-->
        <!--        </a>-->
        <?php ActiveForm::end(); ?>
    </div>


</div>
