<?php
$login = $_POST['login'];
$password = $_POST['password'];
$email = $_POST['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$middleName = $_POST['middleName'];
$code = $_POST['code'];
$codeWord = 'nd82jaake';
$value = 0;

if (preg_match('/\W/', $login)) {
    echo 'Поле логин не должно содержать символы @/*?,;: <br>';
    $value = 1;
} 
if (strlen($password) < 8) {
    echo 'Длина пароля должна быть минимум 8 символов<br>';
    $value = 1;
}
if (!preg_match('/\A[^@]+@([^@\.]+\.)+[^@\.]+\z/', $email)) {
    echo 'Почта должна быть формата почта@домен.доменнаязона <br>';
    $value = 1;
}
if (strlen($firstName) === 0) {
    echo 'Поле Имя обязательно к заполнению <br>';
    $value = 1;
}
if (strlen($lastName) === 0) {
    echo 'Поле Фамилия обязательно к заполнению <br>';
    $value = 1;
}
if (strlen($middleName) === 0) {
    echo 'Поле Отчество обязательно к заполнению <br>';
    $value = 1;
}
if ($code !== $codeWord) {
    echo 'Неверное кодовое слово <br>';
    $value = 1;
}

if ($value === 0) {
    echo 'Вы успешно зарегистрировались! <br>';
}
?>