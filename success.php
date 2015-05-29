<!DOCTYPE html>
<html>
<head>
    <title>Активация</title>
</head>
<body>
<?php
$config = include(dirname(__FILE__) . '/protected/config/main.php');
if ($config['params']['activation'] === "activated")
{
?>
        Код лицензии успешно подтверждён. </br>
        <a href="/admin">Перейти в админку</a>
</body>
<?php } ?>
</html>