<?php
include '../autoload.php';
include '../config/SystemConfig.php';

$translator = NULL;
$client = NULL;
$original = NULL;
$translate = NULL;
$text = NULL;
$text_translate = NULL;          
$date = NULL;
$status = NULL;
$guid = NULL;

if (isset($_POST['translator'])) {
    $translator = $_POST['translator'];
}
if (isset($_GET['obj'])) {
    $guid = $_GET['obj'];
}

$del = new Project($translator, $client, $original, $translate, $text, $text_translate, $date, $status, $guid);
$del->delFromForm();

$del_translator = new Translators($translator);
$del_translator->delCounter();

header('HTTP/1.1 200 OK');
header("Location:../task_list.php");