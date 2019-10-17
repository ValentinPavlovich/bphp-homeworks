<?php
header('Content-type: text/html;charset=utf-8');
session_start();

//рандомная строка
define('SALT', 'W6vw9CgWTP3zSoGYiixDYPX8wMUlv1uP');

function getPassword($password) {   //функция получения зашифрованного пароля
    return md5($password.SALT);
}

$users = require_once 'config/config.php';

if(!isset($_SESSION['user']) && isset($_COOKIE['login']) && isset($_COOKIE['password'])
    && isset($users[$_COOKIE['login']]) && getPassword($users[$_COOKIE['login']]['password']) == $_COOKIE['password']) {

    //если нет сессии пользователя, но есть куки с пользовательским логином и паролем проходится аторизация
    $_SESSION['user'] = $_COOKIE['login'];
    $_SESSION['role'] = $users[$_SESSION['user']]['role'];       
}

define('AUTH', isset($_SESSION['user']) && isset($users[$_SESSION['user']])); //флаг аторизован или нет
$user = AUTH ? $users[$_SESSION['user']] : null;
$_SESSION['authorized'] = AUTH;

$message = '';
if(!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>