<?php
$config = CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),
    array(
        'components'=>array(
            'fixture'=>array(
                'class'=>'system.test.CDbFixtureManager',
            ),

            'db'=>array(
                'connectionString' => 'mysql:host=localhost;dbname=partner',
                'emulatePrepare' => true,
                'username' => 'root',
                'password' => '',
                'charset' => 'utf8',
            ),
        ),
    )
);

$config['preload'] = array('log');

return $config;
