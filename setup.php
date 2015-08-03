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
<h4>Создайте <b>пустую</b> базу данных. Затем введите данные для подключения к ней в следующую форму:</h4>
<form method="post" action="setup.php">
    <label for="username">Имя пользователя</label>
    <input type="text" name="db_username" id="username">

    <label for="password">Пароль</label>
    <input type="password" name="db_password" id="password">

    <label for="server">Сервер</label>
    <input type="text" name="db_server" id="server">

    <label for="database">База данных</label>
    <input type="text" name="db_database" id="database">

    <br>
    <h4>Создание пользователя-администратора</h4>

    <label for="admin_username">Логик</label>
    <input type="text" name="admin_username" id="admin_username" value="admin">

    <label for="admin_pass">Пароль</label>
    <input type="text" name="admin_pass" id="admin_pass" value="admin">

    <input type="submit" value="Подтвердить" name="submit">
</form>

<?php
    }
    else
    { ?>
        База данных уже установлена.
        <a href="/">Перейти на главную</a>
  <?php  }
?>

<?php
function tryConnection ()
{
    //Проверяем подключение к базе по введённым данным
    $connection = mysqli_connect($_POST['db_server'], $_POST['db_username'], $_POST['db_password'], $_POST['db_database']);
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

        //Создаём таблицы и данные в базе
        $sql = file_get_contents(dirname(__FILE__) . '/dump/partner_structure.sql');
        $tables = "SHOW TABLES FROM " . $_POST['db_database'];
        $result = mysqli_query($connection, $tables);
        if ($result->num_rows == 0)
        {
            if (mysqli_multi_query($connection, $sql))
            {
                //Создаём администратора
                if ($_POST['admin_username'] && $_POST['admin_pass'])
                {
                    $adminsql = "INSERT INTO user(role, username, password, status) VALUES('admin','" . $_POST['admin_username'] . "','" . $_POST['admin_pass'] . "','VIP')";
                    mysqli_query($connection, $adminsql);
                }

                //Записываем версию партнёрки
                $version = file_get_contents(dirname(__FILE__) . '/meta.json');
                $version = json_decode($version, true);
                $version = $version['current_version'];
                $versionsql = "INSERT INTO versions(version) VALUES('" . $version . "')";
                mysqli_query($connection, $versionsql);

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
                    if ($config['params']['activation'] === 'activated')
                    {
                        header('Location: success.php');
                    }
                    else
                    {
                        header("Location: activate.php");
                    }
                }
            }
            else
            {
                echo "Запрос не выполнен.";
            }
        }
        else
        {
            echo "База данных имеет таблицы, выберите пустую.";
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