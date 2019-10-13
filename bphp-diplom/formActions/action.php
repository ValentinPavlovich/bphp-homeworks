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
$replaced_translator = NULL;

if (isset($_POST['translator'])) {
    $translator = $_POST['translator'];
}
if (isset($_POST['client'])) {
    $client = $_POST['client'];
}
if (isset($_POST['original'])) {
    $original = $_POST['original'];
}
if (isset($_POST['translate'])) {
    $translate = $_POST['translate'];
}
if (isset($_POST['text'])) {
    $text = $_POST['text'];
}
if (isset($_POST['text_translate'])) {
    $text_translate = $_POST['text_translate'];
}
if (isset($_POST['date'])) {
    $date = $_POST['date'];
}
if (isset($_POST['status'])) {
    $status = $_POST['status'];
}
if (isset($_POST['guid'])) {
    $guid = $_POST['guid'];
}

if (in_array(NULL, array($translator, $client, $original, $translate, $text, $text_translate, $date, $status))) {    
    header("Location:javascript://history.back()");
} else {
    $modelJson = new JsonFileAccessModel('projects');
    $arr = $modelJson->readJson();

if (isset($arr->dataArray->$guid->translator)) {
    $replaced_translator = $arr->dataArray->$guid->translator;
}   

if (isset($replaced_translator) && $translator !== $replaced_translator && $status !== 'rejected_new') {
    $replace = new Translators($translator, $replaced_translator);
    $replace->changeCounter();
}
    $add = new Project($translator, $client, $original, $translate, $text, $text_translate, $date, $status, $guid);    
    $add->addFromForm();

$add_translator = new Translators($translator);

if ($status === 'new' || $status === 'rejected_new') {  
    $add_translator->addCounter();
} elseif ($status === 'done') {    
    $add_translator->delCounter();
}

    header('HTTP/1.1 200 OK');    
    header("Location:../task_list.php");
}