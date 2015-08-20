<?php

	$config = include(dirname(__FILE__) . '/protected/config/main.php');
	if ($config['params']['dbsetup'] !== "activated")
	{
		header('Location: /setup.php');
	}
	if ($config['params']['activation'] === 'activated')
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
		$data = file_get_contents($activateURL);

		if ($data === "success")
		{
			$path_to_file 	= dirname(__FILE__) . '/protected/config/main.php';
			$file_contents 	= file_get_contents($path_to_file);
			$file_contents 	= str_replace($activation, $activatedState, $file_contents);
			file_put_contents($path_to_file, $file_contents);
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
	<form method="post" action="activate.php">
		<label for="license">Лицензионный код</label>
		<input type="text" name="license_code" id="license">
		<input type="submit" value="Активировать лицензию" name="submit">
	</form>
</body>
</html>
