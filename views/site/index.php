<?php

/* @var $this yii\web\View */

use app\models\Category;
use yii\bootstrap\Dropdown;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Skiper';
$category = new Category();

?>
<div class="container-fluid index_head pad_0 over_hid">
    <h1>Шкипер. Найди своих!</h1>
    <h2>Поиск компании на любое мероприятие</h2>
    <div class="event_search">
        <?php $form = ActiveForm::begin(['id' => 'form_event_search', 'method' => 'post']); ?>

        <div class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Выберите катергорию<b class="caret"></b></a>
            <?php
            echo Dropdown::widget([
                'items' => $category->getList(),
//                'items' => $cat->getList(),
            ]);
            ?>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary', 'name' => 'signup-button', 'url' => ['/site/signup']]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
<div class="container recommendation_content">
    <div class="row">
        <h2>Ближайшие события</h2>
        <div class="col-lg-4 col-md-4 pad_0">
            <a href="#">
                <div class="card">
                    <img src="../img/recomend_test.jpg" alt="category_cover"/>
                    <h4>test</h4>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 pad_0">
            <a href="#">
                <div class="card">
                    <img src="../img/recomend_test.jpg" alt="category_cover"/>
                    <h4>test</h4>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-4 pad_0">
            <a href="#">
                <div class="card">
                    <img src="../img/recomend_test.jpg" alt="category_cover"/>
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

