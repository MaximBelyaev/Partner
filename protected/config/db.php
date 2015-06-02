<?php

if ($_SERVER['SERVER_NAME'] == 'prt.loc') {
	return array(
		'connectionString' => 'mysql:host=localhost;dbname=partner',
		'emulatePrepare' => true,
		'username' => 'root',
		'password' => '',
		'charset' => 'utf8',
	);
} else {
	return array(
		'connectionString' => 'mysql:host=localhost;dbname=partner',
		'emulatePrepare' => true,
		'username' => 'root',
		'password' => 'bo0aszw7fa',
		'charset' => 'utf8',
	);
}
?>

