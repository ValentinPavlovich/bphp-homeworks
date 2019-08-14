<?php
$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];

$fullName = mb_convert_case($firstName, MB_CASE_TITLE).' '.mb_convert_case($lastName, MB_CASE_TITLE).' '.mb_convert_case($middleName, MB_CASE_TITLE);
$fio = mb_convert_case(mb_substr($firstName, 0, 1), MB_CASE_TITLE).mb_convert_case(mb_substr($lastName, 0, 1), MB_CASE_TITLE).mb_convert_case(mb_substr($middleName, 0, 1), MB_CASE_TITLE);
$surnameAndInitials = mb_convert_case($firstName, MB_CASE_TITLE).' '.mb_convert_case(mb_substr($lastName, 0, 1), MB_CASE_TITLE).'.'.mb_convert_case(mb_substr($middleName, 0, 1), MB_CASE_TITLE).'.';

echo "Полное имя: '$fullName' <br>";
echo "Фамилия и инициалы: '$surnameAndInitials' <br>";
echo "Аббревиатура: '$fio'  <br>";
?>