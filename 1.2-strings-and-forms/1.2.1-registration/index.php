<?php

$login = $_POST['text'];
$password = $_POST['password'];
$email = $_POST['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$middleName = $_POST['middleName'];
$code = $_POST['code'];
$codeWord = 'nd82jaake';

if (preg_match('/\W/', $login)) {
    $text = "Поле логин не должно содержать символы @/*?,;:";
} elseif (strlen($password) < 8) {
    $text = "Длина пароля должна быть минимум 8 символов";
} elseif (!preg_match('/\A[^@]+@([^@\.]+\.)+[^@\.]+\z/', $email)) {
    $text = "Почта должна быть формата почта@домен.доменнаязона";
} elseif (strlen($firstName) === 0) {
    $text = "Поле Имя обязательно к заполнению";
} elseif (strlen($lastName) === 0) {
    $text = "Поле Фамилия обязательно к заполнению";
} elseif (strlen($middleName) === 0) {
    $text = "Поле Отчество обязательно к заполнению";
} elseif ($code !== $codeWord) {
    $text = "Неверное кодовое слово";
} else {
    $text = 'Вы успешно зарегистрировались!';
}
echo $text;

?>