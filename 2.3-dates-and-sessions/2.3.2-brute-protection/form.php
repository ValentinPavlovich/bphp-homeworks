<?php
$users = [
    'admin' => 'admin1234',
    'randomUser' => 'somePassword',
    'janitor' => 'nimbus2000'
];

// Авторизация
function login($users) {
    if (array_key_exists($_POST['login'], $users)) {
        if ($users[$_POST['login']] == $_POST['password']) {
            echo 'Вы успешно авторизировались!';
            return true;
        }
    }
    echo 'Неправильный логин или пароль.';
    return false;
}

// Проверка логина и пароля
function check($users) {
    if (login($users) === true) {
        exit;
    } else {
        $_SESSION['login'] = $_POST['login']; 
        $_SESSION['time'] = time();
        $_SESSION['counter'] = 1;
        return;
    }
}

// Запись в файл
function logFile() {
    $file = 'log.txt';
    $userFile = fopen($file, 'a');
    $str = $_POST['login'] . ': ' . date('j F Y, g:i a') . "\n";    
    fwrite($userFile, $str);
    fclose($userFile); 
}

// Основная функция
function bruteForce($users) {
    session_set_cookie_params(1800);
    session_start();
 
    // Первая попытка авторизации
    if (count($_SESSION) == 0) {
        check($users);
        return;
    } 
    
    // Не первая попытка авторизации, тот же логин
    if ($_SESSION['login'] == $_POST['login']) {       
        $_SESSION['counter']++;

        // Разница между двумя вводами пароля меньше чем 5 секунд
        if ((time() - $_SESSION['time']) <= 5) {            
            echo 'Превышено максимальное число попыток ввода пароля. Попробуйте еще раз через минуту.';
            logFile();

        // Авторизация в течении минуты
        } elseif ((time() - $_SESSION['time']) < 60) {
            $_SESSION['counter']++;

            // Пользователь вводит пароль три раза за минуту 
            if ($_SESSION['counter'] > 3) {
                $_SESSION['counter'] = 0;
                echo 'Превышено максимальное число попыток ввода пароля. Попробуйте еще раз через минуту.';
                logFile();

            } else {
                echo 'Неправильный логин или пароль.';
                return false;
            }
 
        // Прошло больше минуты        
        } else {
            $_SESSION = [];
            check($users);
            return;
        }
 
    // Новый логин
    } else {
        check($users);
        return;
    }
}
 
bruteForce($users);