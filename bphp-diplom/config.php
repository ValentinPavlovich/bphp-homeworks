<?php
header('Content-type: text/html;charset=utf-8');
session_start();

//рандомная строка
define('SALT', 'W6vw9CgWTP3zSoGYiixDYPX8wMUlv1uP');

function getPassword($password)
{   //функция получения зашифрованного пароля
    return md5($password.SALT);
}

$admin= 'admin';
$users = array(
    //пароль = getPassword('password')
    $admin => array('password' => '81315e6cb0188f36c9dfad8adbda2538', 'name' => 'Менеджер'),

    //пароль = getPassword('password1')
    'user1' => array('password' => 'c78d398f896f720d068871052a34ce40', 'name' => 'Переводчик1'),

    //пароль = getPassword('password2')
    'user2' => array('password' => '9d1a475c5ca48cbbe5ec1b429497a999', 'name' => 'Переводчик2'),
    
    //пароль = getPassword('password3')
    'user3' => array('password' => '004644e3a5e70645550bd62df949fe6f', 'name' => 'Переводчик3'),
);

if(!isset($_SESSION['user']) && isset($_COOKIE['login']) && isset($_COOKIE['password'])
    && isset($users[$_COOKIE['login']]) && getPassword($users[$_COOKIE['login']]['password']) == $_COOKIE['password']) {

    //если нет сессии пользователя, но есть куки с пользовательским логином и паролем проходится аторизация
    $_SESSION['user'] = $_COOKIE['login'];
}

define('AUTH', isset($_SESSION['user']) && isset($users[$_SESSION['user']])); //флаг аторизован или нет
$user = AUTH ? $users[$_SESSION['user']] : null;

$message = '';
if(!empty($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>