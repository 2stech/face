<?php
require_once __DIR__ . '/../vendor/autoload.php';


$face = new \Sankar\Face\Face();
$face->setConfig([
	'sources' => [
		'fullcontact' => ['apikey' => 'fea3e3d2824ab5a1'],
		'vibeapp' => ['apikey' => '9db7844007fb72201898775dafee49e0'],
		'gravatar' => [],
	]
	]);

$emails = array('sankar.suda@gmail.com','sankara.s@solutionsinfini.com','atmb4u@gmail.com');

foreach ($emails as $email) {
	$face->find('sankar.suda@gmail.com');
	echo '<img src="' . $face->getImage() . '" alt="'.$face->getSource().'"/>';
}

?>