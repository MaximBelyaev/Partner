<!DOCTYPE html>
<html>
<head>
    <title>Активация</title>
</head>
<body>

<form method="post" action="activate.php">
    <label for="username">Лицензионный код</label>
    <input type="text" name="license_code" id="license">

    <input type="submit" value="Активировать лицензию" name="submit"> <!-- assign a name for the button -->
</form>

<?php
function tryActivate ()
{

}
if (isset($_POST['submit']))
{
    tryActivate();
}
?>
</body>
</html>