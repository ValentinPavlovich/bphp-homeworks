<?php
include '../autoload.php';
include '../config/SystemConfig.php';

$client = NULL;
$original = NULL;
$translate = NULL;
$text = NULL;
$text_translate = NULL;          
$date = NULL;

$translator = isset($_POST['translator']) ? $_POST['translator'] : null;
$status = isset($_POST['status']) ? $_POST['status'] : null;
$guid = isset($_GET['obj']) ? $_GET['obj'] : null;

$del = new Project($translator, $client, $original, $translate, $text, $text_translate, $date, $status, $guid);
$del->delFromForm();

if (substr($status, 0, 4) !== 'done') {
    $del_translator = new Translators($translator);
    $del_translator->delCounter();
}

header('HTTP/1.1 200 OK');
header("Location: ../task_list.php");