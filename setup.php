<!DOCTYPE html>
<html>
<head>
    <title>Конфигурация базы данных</title>
</head>
<body>
<?php
    $config = include(dirname(__FILE__) . '/protected/config/main.php');
    if ($config['params']['dbsetup'] !== "activated")
    {
?>
<form method="post" action="setup.php">
    <label for="username">Имя пользователя</label>
    <input type="text" name="db_username" id="username">

    <label for="password">Пароль</label>
    <input type="password" name="db_password" id="password">

    <label for="server">Сервер</label>
    <input type="text" name="db_server" id="server">

    <label for="database">База данных</label>
    <input type="text" name="db_database" id="database">

    <input type="submit" value="Подтвердить" name="submit"> <!-- assign a name for the button -->
</form>

<?php
    }
    else echo "База данных уже установлена"
?>

<?php
function tryConnection ()
{
    //Проверяем подключение к базе по введённым данным
$connection = mysqli_connect($_POST['db_server'], $_POST['db_username'], $_POST['db_password']);
    if (!$connection)
    {
        die("Соединение с базой данных не установлено: " . mysqli_connect_error());
    }
    else
    {
        //Сохраняем старые значения конфига
        $config = include(dirname(__FILE__) . '/protected/config/main.php');
        $defaultUsername = $config['components']['db']['username'];
        $defaultPassword = $config['components']['db']['password'];
        $defaultConnectionString = $config['components']['db']['connectionString'];
        $defaultDbStatus = $config['params']['dbsetup'];

        //Переменная для записи в конфиг (если БД установлена)
        $newDbStatus = 'activated';

        //Заменяем старые значения на ввод пользователя
        if ($_POST['db_username'] != '' and $_POST['db_server'] != '' and $_POST['db_database'] != '')
        {
            $path_to_file = dirname(__FILE__) . '/protected/config/main.php';
            $file_contents = file_get_contents($path_to_file);
            $file_contents = str_replace($defaultUsername, $_POST['db_username'], $file_contents);
            $file_contents = str_replace($defaultPassword, $_POST['db_password'], $file_contents);
            $file_contents = str_replace($defaultConnectionString, "mysql:host=" . $_POST['db_server'] .
                ";dbname=" . $_POST['db_database'], $file_contents);
            $file_contents = str_replace($defaultDbStatus, $newDbStatus, $file_contents);
            file_put_contents($path_to_file, $file_contents);
        }
    }
}
    if (isset($_POST['submit']))
    {
        tryConnection();
    }
?>
</body>
</html>