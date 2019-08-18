<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Список пользователей</title>
  <style type="text/css">
    input {
		display: block;
		margin-top: 10px;
	}
	button {
		margin-top: 10px;
	}
  </style>
</head>
<body>

<?php
    require './autoload.php';
    require './config/SystemConfig.php';    
?>

<form action="./formActions/addUser.php" method="post">
  <input type="text" name="name" placeholder="Имя" required>
  <input type="text" name="password" placeholder="Пароль" required>
  <input type="text" name="email" placeholder="Эл. почта" required>
  <input type="text" name="rate" placeholder="Рейтинг" required>
  <button type="submit">Добавить пользователя</button>
</form>
</body>
</html>