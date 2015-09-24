<?php 

$data = array();
$varName = $_GET['varName'];

    $uploaddir = './img/';
    foreach($_FILES as $file)
    {
        if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
        {
            $value = $uploaddir .$file['name'];
        }
    }

    $success = "Файл успешно загружен";

    $config = json_decode(file_get_contents('config.json'));
    $config->$varName = $value;
    $config = json_encode($config, JSON_UNESCAPED_UNICODE);
    $fp = fopen('config.json', 'w');
    fwrite($fp, $config);
    fclose($fp);

echo json_encode(['varName' => $varName, 'source' => $value, 'success' => $success]);
?>