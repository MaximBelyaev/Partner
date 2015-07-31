<?php
$version = file_get_contents(dirname(__FILE__) . '/meta.json');
$version = json_decode($version, true);
$version = $version['current_version'];
var_dump($version);