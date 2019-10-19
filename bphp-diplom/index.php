<?php
include __DIR__.'/auth.php'; 
include 'pages/header.php';

if(AUTH) { //если авторизирован 
    $_SESSION['page'] = 'not_task';
    include 'pages/menu.php';
?>

<div class="container__wrapper form__inner">    
  <div class="container__form-inner">
        <h1>Привет, <?php echo $user['name']; ?>!</h1>
  </div> 
</div>

<?php } else { //если не авторизирован  ?>
<header><h1>Информационная система «Бюро переводов»</h1></header>
<div class="modal">    
    <form enctype="multipart/form-data" class="login-form" action="login.php" method="post" name="login">
        <div class="form-field email">
            <label for="login">
                <input type="text" name="login" placeholder="Login" required>
            </label>
        </div>
        <div class="form-field password">
            <label for="password">
                <input type="password" name="password" placeholder="Password" required>
            </label>
        </div>
        <div class="form-field btn-submit">
            <button class="btn" type="submit" name="submit">
                <p class="btn-text">Sign in</p>
            </button>
        </div>
    </form>
</div>

<?php } 

include 'pages/footer.php';
?>