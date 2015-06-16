<!DOCTYPE html>
<html>
<head>
    <title>Активация</title>
</head>
<body>
<?php
    $config = include(dirname(__FILE__) . '/protected/config/main.php');
    if ($config['params']['dbsetup'] !== "activated")
    {
        header('Location: /setup.php');
    }
    if ($config['params']['activation'] !== "activated")
    {
?>
<form method="post" action="activate.php">
    <label for="license">Лицензионный код</label>
    <input type="text" name="license_code" id="license">
    <input type="submit" value="Активировать лицензию" name="submit">
</form>

    <?php
    }
    else
    { ?>
        Лицензия уже активирована.
        <a href="/">Перейти на главную</a>
    <?php  }
?>

<?php
function tryActivate ()
{
    //Сохраняем старое значение (неактивированная лицензия)
    $config = include(dirname(__FILE__) . '/protected/config/main.php');
    $activation = $config['params']['activation'];
    $activatedState = "activated";

    //Получаем код и ссылку
    $licenseCode = file_get_contents("license.txt");
    $zipFileURL = 'http://prtserver.shvets.net/api/check/' . $licenseCode;
    var_dump($zipFileURL);
    $data = file_get_contents($zipFileURL);

    //Проверяем, совпадает ли код с кодом из файла и по базе данных админки с лицензиями
    if ($_POST['license_code'] === $licenseCode and $data === "exists")
    {
        //Заменяем строку в конфиге
        $path_to_file = dirname(__FILE__) . '/protected/config/main.php';
        $file_contents = file_get_contents($path_to_file);
        $file_contents = str_replace($activation, $activatedState, $file_contents);
        file_put_contents($path_to_file, $file_contents);
        header("Location: success.php");
    }
    else echo "Неверный код";
}

if (isset($_POST['submit']))
{
    tryActivate();
}
?>
</body>
</html>
