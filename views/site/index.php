<?php

/* @var $this yii\web\View */

use app\models\CategoryModel;
use yii\bootstrap\Dropdown;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Skiper';
$category = new CategoryModel();

?>
<div class="container-fluid index_head pad_0 over_hid">
    <div class="row">
        <div class="col-lg-3 col-md-3"></div>
        <div class="col-lg-6 col-md-6">
            <h1>Шкипер. Найди своих!</h1>
            <h2>Поиск компании на любое мероприятие</h2>
            <div class="event_search">
                <?php $form = ActiveForm::begin(['id' => 'form_event_search', 'method' => 'post']); ?>

<!--                <div class="dropdown">-->
<!--                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">-->
<!--                        Выберите катергорию<b class="caret"></b>-->
<!--                    </a>-->
<!--                </div>-->

                <div class="row marg_bottom_30">
                    <div class="col-lg-6 col-md-6">
                        <span class="category_btn"
                              onclick="openbox('category_block'); return false">Выберите категорию<b class="caret"></b></span>
<!--                        <ul id="category_block" style="display: none;">-->
<!--                            <li>1</li>-->
<!--                            <li>2</li>-->
<!--                            <li>3</li>-->
<!--                            <li>4</li>-->
<!--                            <li>5</li>-->
<!--                            <li>1</li>-->
<!--                            <li>2</li>-->
<!--                            <li>3</li>-->
<!--                            <li>4</li>-->
<!--                            <li>5</li>-->
<!--                            <li>1</li>-->
<!--                            <li>2</li>-->
<!--                            <li>3</li>-->
<!--                            <li>4</li>-->
<!--                            <li>5</li>-->
<!--                        </ul>-->
                        <?php
                        echo Dropdown::widget([
                            'items' => $category->getList(),
                            'id' =>  'category_block',
                        ]);
                        ?>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <span class="city_btn" onclick="openbox('city_block'); return false">Выберите город<b
                                    class="caret"></b></span>
                        <ul id="city_block" style="display: none;">
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                        </ul>
                    </div>
                </div>

                <script type="text/javascript">
                    function openbox(id) {
                        display = document.getElementById(id).style.display;

                        if (display == 'none') {
                            document.getElementById(id).style.display = 'block';
                        } else {
                            document.getElementById(id).style.display = 'none';
                        }
                    }
                </script>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <?= Html::submitButton('Найти событие', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'url' => ['/site/signup']]) ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <a class="create_event" href="">
                            Создать событие
                        </a>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="col-lg-3 col-md-3"></div>
    </div>
</div>
<div class="container recommendation_content">
    <div class="row">
        <h2>Ближайшие события</h2>
        <div class="col-lg-4 col-md-4 pad_0">
            <a href="#">
                <div class="card">
                    <img class="img_bg" src="../img/recomend_test.jpg" alt="category_cover"/>
                    <div class="category">
                        <span>Категория:</span>
                        <span>Кино</span>
                    </div>
                    <div class="time_date">
                        <img class="calendar" src="../img/card_calendar.png" alt="">
                        <span>18.09.2017 / 21:00</span>
                    </div>
                    <div class="location">
                        <img class="calendar" src="../img/card_position.png" alt="">
                        <span>Кинотеатр Cinema Park, ул. Ленина, тц. Планета</span>
                    </div>
                    <div class="cost">
                        <img class="calendar" src="../img/card_cost.png" alt="">
                        <span>Стоимость:</span>
                        <span>300</span>
                        <span>р.</span>
                    </div>
                    <h4>test</h4>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 pad_0">
            <a href="#">
                <div class="card">
                    <img class="img_bg" src="../img/recomend_test.jpg" alt="category_cover"/>
                    <div class="category">
                        <span>Категория:</span>
                        <span>Кино</span>
                    </div>
                    <div class="time_date">
                        <img class="calendar" src="../img/card_calendar.png" alt="">
                        <span>18.09.2017 / 21:00</span>
                    </div>
                    <div class="location">
                        <img class="calendar" src="../img/card_position.png" alt="">
                        <span>Кинотеатр Cinema Park, ул. Ленина, тц. Планета</span>
                    </div>
                    <div class="cost">
                        <img class="calendar" src="../img/card_cost.png" alt="">
                        <span>Стоимость:</span>
                        <span>300</span>
                        <span>р.</span>
                    </div>
                    <h4>test</h4>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 pad_0">
            <a href="#">
                <div class="card">
                    <img class="img_bg" src="../img/recomend_test.jpg" alt="category_cover"/>
                    <div class="category">
                        <span>Категория:</span>
                        <span>Кино</span>
                    </div>
                    <div class="time_date">
                        <img class="calendar" src="../img/card_calendar.png" alt="">
                        <span>18.09.2017 / 21:00</span>
                    </div>
                    <div class="location">
                        <img class="calendar" src="../img/card_position.png" alt="">
                        <span>Кинотеатр Cinema Park, ул. Ленина, тц. Планета</span>
                    </div>
                    <div class="cost">
                        <img class="calendar" src="../img/card_cost.png" alt="">
                        <span>Стоимость:</span>
                        <span>300</span>
                        <span>р.</span>
                    </div>
                    <h4>test</h4>
                </div>
            </a>
        </div>
    </div>
</div>


<div class="container index_content">
    <h2>Интересы</h2>
    <div class="row">
        <?php foreach ($category->getAllCategory() as $cat) { ?>
            <div class="col-lg-3 col-md-3">
                <a href="#">
                    <div class="card">
                        <img src="<?= $cat['urlimg']; ?>" alt="category_cover"/>
                        <h4><?= $cat['name']; ?></h4>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>

<div class="container-fluid index_footer pad_0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <h2>
                    Загрузи наше приложение - <br/>
                    так гораздо удобнее!
                </h2>
                <h3>
                    Скачайте наше приложение и пользуйтесь Skipper, где бы вы ни находились.
                </h3>
                <a href="">
                    <img src="../img/app_store_btn.png" alt="app"/>
                </a>
                <a href="">
                    <img src="../img/google_play_btn.png" alt="app"/>
                </a>
            </div>
            <div class="col-lg-6 col-md-6">

            </div>
        </div>
    </div>
</div>

