<?php 

$config = include(dirname(__FILE__) . '/protected/config/main.php');
if (isset($_POST['submit']))
{
	tryConnection();
}

function tryConnection ()
{
    //Проверяем подключение к базе по введённым данным
    $connection = @mysqli_connect($_POST['db_server'], $_POST['db_username'], $_POST['db_password'], $_POST['db_database']);
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
            	// sleep нужен, так как mysqli_multi_query не успевает выполниться,
            	// когда начинают работать следующие запросы
            	sleep(3);
            	// открываем соединение заново, чтобы избежать ошибки
            	// Commands out of sync; you can't run this command now
                $connection = mysqli_connect($_POST['db_server'], $_POST['db_username'], $_POST['db_password'], $_POST['db_database']);
                //Создаём администратора
                if ($_POST['admin_username'] && $_POST['admin_pass'])
                {
                    $adminsql = "INSERT INTO 
                    	user(role, username, password, status) 
                    	VALUES(
                    		'admin',
                    		'" . $_POST['admin_username'] . "',
                    		'" . $_POST['admin_pass'] . "',
                    		'VIP')";
                    mysqli_query($connection, $adminsql);
                    echo mysqli_error($connection);
                }

                //Записываем версию партнёрки
                $version = file_get_contents(dirname(__FILE__) . '/version.txt');
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Установка базы данных</title>
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


<?php if ($config['params']['dbsetup'] !== "activated") { ?>

<form method="post" action="setup.php" class="block">

	<section>

		<h5>
			Создайте пустую базу данных. 
			Затем введите данные для подключения к ней в следующую форму:
		</h5>

		<label for="username">Имя пользователя</label>
		<input type="text" name="db_username" id="username">

		<label for="password">Пароль</label>
		<input type="password" name="db_password" id="password">

		<label for="server">Сервер</label>
		<input type="text" name="db_server" id="server">

		<label for="database">База данных</label>
		<input type="text" name="db_database" id="database">

		<br>

	</section>

	<section>

		<h5>Создание пользователя-администратора</h5>

		<label for="admin_username">Логин</label>
		<input type="text" name="admin_username" id="admin_username">

		<label for="admin_pass">Пароль</label>
		<input type="text" name="admin_pass" id="admin_pass">

		<div class="submit">
			<input type="submit" value="Подтвердить" name="submit">
		</div>		
		
	</section>

</form>

<?php } else { ?>
	База данных уже установлена.
	<a href="/">Перейти на главную</a>
<?php } ?>

</body>
</html>