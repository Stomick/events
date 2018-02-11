<?php

use app\models\UserOptions;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\widgets\Alert;
use yii\widgets\MaskedInput;
use bupy7\cropbox\CropboxWidget;
$userOptionsModel = new UserOptions();

?>
<div class="row">
    <div class="col-xs-6">
        <?php $formForAvatar = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);
        echo $formForAvatar->field($userOptionsModel, 'userImage')->widget(CropboxWidget::className(), [
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
    </div>
	<?php $form = \yii\widgets\ActiveForm::begin([
		'options' => ['class' => 'form-horizontal', 'id' => 'userUpdateForm']
	]);$form->validateOnBlur ?>
    <div class="col-xs-6">
	<?= $form->field($userOptionsModel, 'userPhone')->widget(\yii\widgets\MaskedInput::className(), [
		'mask' => '+7(999)-999-9999',
	])  ?>
	<?= $form->field($userOptionsModel, 'OldPassword')->passwordInput(['autofocus' => true, 'placeholder' => 'Введите старый пароль'])->label(false) ?>
	<?= $form->field($userOptionsModel, 'NewPassword')->passwordInput(['autofocus' => true, 'placeholder' => 'Введите новый пароль'])->label(false) ?>
	<?= $form->field($userOptionsModel, 'ConfirmNewPassword')->passwordInput(['autofocus' => true, 'placeholder' => 'Подтвердите новый пароль'])->label(false) ?>
    </div>
    <div class="col-xs-12">
    <?php echo $form->field($userOptionsModel, 'userCategories')->checkboxList(
                                \yii\helpers\ArrayHelper::map(app\models\CategoryModel::find()->all(),
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
    <div class="col-xs-12">
        <div class="form-group">
		    <?= Html::Button('Обновить информацию', ['id'=> 'updateuserinfo' , 'class' => 'btn btn-primary', 'onclick' => 'updateInfo()',  'name' => 'signup-button']) ?>
            <script>
                function updateInfo() {
                    console.log($('#userUpdateForm').serializeArray());
                }
            </script>
        </div>
    </div>
	<?php $form->end(); ?>
</div>