<?php
include '../autoload.php';
include '../config/SystemConfig.php';

$replaced_translator = NULL;

$translator = isset($_POST['translator']) ? $_POST['translator'] : null;
$client = isset($_POST['client']) ? $_POST['client'] : null;
$original = isset($_POST['original']) ? $_POST['original'] : null;
$translate = isset($_POST['translate']) ? $_POST['translate'] : null;
$text = isset($_POST['text']) ? $_POST['text'] : null;
$text_translate = isset($_POST['text_translate']) ? $_POST['text_translate'] : null;
$date = isset($_POST['date']) ? $_POST['date'] : null;
$status = isset($_POST['status']) ? $_POST['status'] : null;
$guid = isset($_POST['guid']) ? $_POST['guid'] : null;

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