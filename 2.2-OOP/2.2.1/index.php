<?php
    require './autoload.php';
    require './config/SystemConfig.php';
    $fileJSON = new JsonFileAccessModel('data');
    $content = $fileJSON->readJson();
    echo '<pre>';
    print_r($content);    
?>