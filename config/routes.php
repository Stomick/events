<?php

return [
	'enablePrettyUrl' => false,
	'enableStrictParsing' => true,
	'showScriptName' => false,
	'suffix' => '',
	'rules' => [
		[
			'class' => 'yii\rest\UrlRule',
			'controller' => 'site',
			'extraPatterns' => [
				'GET index' => 'index',
			],
		],
		[
			'class' => 'yii\rest\UrlRule',
			'controller' => 'user',
		],
		[
			'class' => 'yii\rest\UrlRule',
			'controller' => 'accaunt',
		],
		[
			'class' => 'yii\rest\UrlRule',
			'controller' => 'login',
			'prefix' => '.html',
		],
	]
];

