<!DOCTYPE html>
<html>
<head>
    <title>Конфигурация базы данных</title>
</head>
<body>

<form method="post" action="setup.php">
    <label for="username">Имя пользователя</label>
    <input type="text" name="db_username" id="username">

    <label for="password">Пароль</label>
    <input type="password" name="db_password" id="password">

    <label for="server">Сервер</label>
    <input type="text" name="db_server" id="server">

    <label for="database">База данных</label>
    <input type="text" name="db_database" id="database">

    <input type="submit" value="click" name="submit"> <!-- assign a name for the button -->
</form>

<?php
function tryConnection ()
{
$connection = mysqli_connect($_POST['db_server'], $_POST['db_username'], $_POST['db_password']);
    if (!$connection)
    {
        $_SESSION['isConfiguredDatabase'] = false;
        die("Соединение с базой данных не установлено: " . mysqli_connect_error());
    }
    else {
        //Сохраняем старые значения конфига
        $config = include(dirname(__FILE__) . '/protected/config/main.php');
        $defaultUsername = $config['components']['db']['username'];
        $defaultPassword = $config['components']['db']['password'];
        $defaultConnectionString = $config['components']['db']['connectionString'];

        //Заменяем старые значения на ввод пользователя
        if ($_POST['db_username'] != '' and $_POST['db_server'] != '' and $_POST['db_database'] != '') {
            $path_to_file = dirname(__FILE__) . '/protected/config/main.php';
            $file_contents = file_get_contents($path_to_file);
            $file_contents = str_replace($defaultUsername, $_POST['db_username'], $file_contents);
            $file_contents = str_replace($defaultPassword, $_POST['db_password'], $file_contents);
            $file_contents = str_replace($defaultConnectionString, "mysql:host=" . $_POST['db_server'] .
                ";dbname=" . $_POST['db_database'], $file_contents);
            file_put_contents($path_to_file, $file_contents);
        }
        $_SESSION['isConfiguredDatabase'] = true;
        header('Location: /activate.php');
    }

}
    if (isset($_POST['submit']))
    {
        tryConnection();
    }
?>
</body>
</html>