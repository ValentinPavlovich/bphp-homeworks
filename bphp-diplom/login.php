<?php
include __DIR__.'/auth.php';

if(!AUTH) {
  //не авторизован
  if(!empty($_POST['login']) && !empty($_POST['password']) && isset($users[$_POST['login']])) {
    
      //передал данные для входа и логин существует
      if($users[$_POST['login']]['password'] == getPassword($_POST['password'])) {

        // $status = getPassword($_POST['password']);
        // exit ($status);

          //пароль совпадает
          $_SESSION['user'] = $_POST['login'];
          $_SESSION['role'] = $users[$_SESSION['user']]['role'];
          $_SESSION['authorized'] = 1;          

          setcookie('login', $_POST['login'], time() + 3600 * 24 * 365, '/');
          setcookie('password', getPassword($users[$_POST['login']]['password']), time() + 3600 * 24 * 365, '/');          
      }
  }
  if(!isset($_SESSION['user']) || $_SESSION['user'] != $_POST['login']) {

    // $status = getPassword($_POST['password']);
    // exit ($status);

    //авторизация не прошла, сохраняется ошибка
    $_SESSION['message'] = 'Неверный логин или пароль';
  }
} else {
    if(isset($_GET['logout'])) { //выход из системы
        unset($_SESSION['user']);
        unset($_SESSION['role']);
        unset($_SESSION['authorized']);

        setcookie('login', '', time() - 3600 * 24 * 365, '/');
        setcookie('password', '', time() - 3600 * 24 * 365, '/');
    }
}

header('Location: index.php'); //переход на главную страницу
?>