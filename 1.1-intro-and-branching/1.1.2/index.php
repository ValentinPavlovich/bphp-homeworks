<?php
date_default_timezone_set('Europe/Moscow');
$variable = date("H");
if($variable >= 6 && $variable < 11){
    $day = 'Доброе утро!';
    $image = 'img/morning.jpg';
} elseif($variable >= 11 && $variable < 18) {
    $day = 'Добрый день!';
    $image = 'img/day.jpg';
} elseif($variable >= 18 && $variable < 23) {
    $day = 'Добрый вечер!';
    $image = 'img/evening.jpg';
} else {
    $day = 'Доброй ночи!';
    $image = 'img/night.jpg';
}
 
switch (date("N")) :
    case 1: $time = 'Сегодня понедельник.'; break;    
    case 2: $time = 'Сегодня вторник.'; break;
    case 3: $time = 'Сегодня среда.'; break;
    case 4: $time = 'Сегодня четверг.'; break;
    case 5: $time = 'Сегодня пятница.'; break;
    case 6: $time = 'Сегодня суббота.'; break;
    case 7: $time = 'Сегодня воскресенье.'; break; 
    endswitch;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>bPHP - 1.1.2</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="img" style="background-image: url(<?= $image; ?>)">
        <div class="greeting">
            <h1><?= $day; ?><br><?= $time; ?></h1>
        </div>
    </div>
</body>
</html>