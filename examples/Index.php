<?php
require_once __DIR__ . '/../vendor/autoload.php';

echo '<pre>';
print_r($_REQUEST);

$face = new \Sankar\Face\Face();
$face->setConfig([
	'sources' => [
		'facebook' => ['appid'=>'249199871932396',
		'secret' => '50b31c51a280d2523836cc3280da9d04'
		],
		//'gravatar' => []
	]
	]);
$face->find('sankar.suda@gmail.com');

echo '<img src="' . $face->getImage() . '" />';
?>