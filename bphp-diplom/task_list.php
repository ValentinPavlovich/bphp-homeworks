<?php
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