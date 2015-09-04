<?php

	$config = include(dirname(__FILE__) . '/protected/config/main.php');
	$first = file_get_contents("license.txt");
	$second = str_replace('.', '',$_SERVER['SERVER_NAME']);
	$str = $first . 'hostname' . $second;
	if ($first)
	{
		$request = 'http://prtserver.shvets.net/api/check/' . $str;
	}
	$status = '';
	if ($request)
	{
		$status = file_get_contents($request);
	}
	if ($config['params']['dbsetup'] !== "activated")
	{
		header('Location: /setup.php');
	}
	if ($status === 'exists')
	{
		header('Location: /');
	}

	if (isset($_POST['submit']))
	{
		tryActivate();
	}

	function tryActivate ()
	{
		//Сохраняем старое значение (неактивированная лицензия)
		$config 		= include(dirname(__FILE__) . '/protected/config/main.php');
		$prtserver 		= $config['params']['updateServer'];
		$activation 	= $config['params']['activation'];
		$activatedState = 'activated';

		//Получаем код и ссылку
		$baseUrl 		= str_replace('.', '', $_SERVER['SERVER_NAME']);
		$licenseString 	= $_POST['license_code'] . 'hostname' . $baseUrl;
		$activateURL 	= $prtserver . 'activate/' . $licenseString;
		$data 			= file_get_contents($activateURL);

		if ($data === "success")
		{
			$path_to_file 	= dirname(__FILE__) . '/protected/config/main.php';
			$file_contents 	= file_get_contents($path_to_file);
			$file_contents 	= str_replace($activation, $activatedState, $file_contents);
			file_put_contents($path_to_file, $file_contents);
			$licenseFile = fopen("license.txt", "w");
			fwrite($licenseFile, $_POST['license_code']);
			fclose($licenseFile);
			header("Location: success.php");
		}
		else
		{
			echo "Данный код лицензии уже используется";
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Активация</title>
</head>
<body>
	<style type="text/css">
@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,400,500,600,700&subset=latin,cyrillic-ext,cyrillic);
* {
	box-sizing: border-box;
	color: #3a4453;
	font-family: 'Open Sans';
}
html {
	background: #F0F3F7;
	height: 100%;
	min-height: 100%;
}
body {
	background: #F0F3F7;
	height: 100%;
	min-height: 100%;
}
.block {
	background-color: #FFF;
	box-shadow: 0px 0px 6px rgba(139, 157, 175, 0.1);
	padding: 30px;
	width: 90%;
	margin: 0 auto;
}
h5 {
	color: #697887;
	font: 600 19px 'Open Sans';
	margin: 0 0 15px 0;
	overflow: hidden;
	text-align: left;
}
.block section {
	margin-bottom: 15px;
}
.block section:last-child {
	margin-bottom: 0;
}
label {
	color: #8694a4;
	display: block;
	font: 400 15px "Open Sans";
	margin: 5px 0 7px;
}
textarea, input[type="text"], input[type="password"],  
input[type="number"], input[type="email"] {
	display: inline-block;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    padding: 5px 10px;
    border: 1px solid #dfe3e8;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    font: normal 13px/normal "Open Sans", Helvetica, sans-serif;
    outline: none;
    -o-text-overflow: clip;
    text-overflow: clip;
    background: #FFF;
    box-shadow: none;
    margin-bottom: 5px;
    -webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
    -moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
    -o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
    transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
    width: 40%;
}
textarea:hover, input[type="text"]:hover, input[type="password"]:hover,  
input[type="number"]:hover, input[type="email"]:hover {
	border: 1px solid #BABDC0;
}
textarea:active, input[type="text"]:active, input[type="password"]:active,  
input[type="number"]:active, input[type="email"]:active {
	border: 1px solid #BABDC0;
}
textarea:focus, input[type="text"]:focus, input[type="password"]:focus,  
input[type="number"]:focus, input[type="email"]:focus {
	border: 1px solid #BABDC0;
}
input[type="submit"], button, .btn {
    border: 1px solid transparent;
	background-color: #3aace2;
	background: #3aace2;
    border-radius: 2px;
    box-shadow: none;
    color: #FFF;
    cursor: pointer;
    font: 500 14px 'Open Sans';
    padding: 10px 20px;
    outline: none;
    text-shadow: none;
    -webkit-transition: all 0.25s ease-in;
    -moz-transition: all 0.25s ease-in;
    transition: all 0.25s ease-in;
}    
input[type="submit"]:active, input[type="submit"]:hover, input[type="submit"]:focus, 
button:active, button:hover, button:focus,
.btn:active, .btn:hover, .btn:focus {
    background: #52bdf1;
}
input[type="submit"]:active,
button:active,
.btn:active {
	box-shadow: inset 0 2px 4px rgba(0,0,0,.15), 0 1px 2px rgba(0,0,0,.05);
}
.submit {
	margin-top: 25px;
}
</style>
	<form method="post" action="activate.php" class="block">
		<section>
			<h5>
				Лицензионный код
			</h5>
			<input type="text" name="license_code" id="license">
			<div class="submit">
				<input type="submit" value="Активировать лицензию" name="submit">			
			</div>	
		</section>
	</form>
</body>
</html>
