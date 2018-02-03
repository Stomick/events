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

$this->title                   = 'Hello Епта :))))';
$this->params['breadcrumbs'][] = $this->title;
/*
if(Yii::$app->user->isGuest){
	Yii::$app->response->redirect(Yii::$app->getHomeUrl());
	Yii::$app->getRequest()->redirect();
}
*/
?>

<div class="site-login">
    <h1><?= Html::encode( $this->title ) ?></h1>
	<?php $form = ActiveForm::begin( [
		'id'     => 'form-extend-signup',
		'action' => 'extend-signup.html',
		'method' => 'post'
	] ); ?>

	<?php echo $form->field( new UserOptions(), 'categoryes' )->checkboxList(
		\yii\helpers\ArrayHelper::map( app\models\Category::find()->all(),
			"category_id",
			"name"
		), [
		'item' =>
			function ( $index, $label, $name, $checked, $value ) {
				return Html::checkbox( $name, $checked, [
					'value'        => $value,
					'label'        => '<label for="' . $label . '">' . $label . '</label>',
					'labelOptions' => [
						'class' => 'ckbox ckbox-primary col-md-4',
					],
					//'id' => $label,
				] );
			},

		'separator' => false,
		'template'  => '<div class="item">{input}{label}</div>',
	] );
	?>
    <?php $form = ActiveForm::begin( [ 'options' => [ 'enctype' => 'multipart/form-data' ] ] );

	echo $form->field( new UploadForm(), 'image' )->widget( CropboxWidget::className(), [
		'croppedDataAttribute' => 'crop_info',
		'pluginOptions'        => [

			'variants'  => [
				[
					'width'     => 360,
					'height'    => 360,
					'minWidth'  => 360,
					'minHeight' => 360,
					'maxWidth'  => 360,
					'maxHeight' => 360,
				],
			],
		],
	] ); ?>
	<?php ActiveForm::end(); ?>
	<?php ActiveForm::end(); ?>
</div>
