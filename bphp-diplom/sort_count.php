<?php
session_start();

$_SESSION['sort_by'] += 1;
if ($_SESSION['sort_by'] > 4) {
    $_SESSION['sort_by'] = 0;
}

if ($_SESSION['page'] === '') {
    header("Location: task_list.php");
} else {
    header('Location: task_list.php' ."?filterParam=" .$_SESSION['page']);
}