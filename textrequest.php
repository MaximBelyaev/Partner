<?php
	$config = json_decode(file_get_contents('config.json'));
	$config->$_REQUEST['varName'] = $_REQUEST['value'];
	$config = json_encode($config, JSON_UNESCAPED_UNICODE);
	$fp = fopen('config.json', 'w');
	fwrite($fp, $config);
	fclose($fp);
?>