<?php
session_start();

if (!isset($_SESSION['authorized']) || !($_SESSION['authorized'])) {
  header("Location: index.php");
  exit;
}
$_SESSION['page'] = isset($_GET['filterParam']) ? $_GET['filterParam'] : '';

include 'pages/header.php';
include 'pages/menu.php';
?>

<div class="wrap">

<?php
  include 'autoload.php';  
  include 'config/SystemConfig.php';
  $page = new Projects;
  $page->displayPage();
?>

</div>

<?php
include 'pages/footer.php';
?>