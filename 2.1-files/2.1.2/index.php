<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">    
    <title>Фотогалерея</title>
    <style type="text/css">
    input {
		display: block;
		margin-top: 10px;
	}	
  </style>
</head>
<body>

<form enctype="multipart/form-data" action="<?= $_SERVER['REQUEST_URI'];?>" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000">         
    Загрузить картинку: <input name="picture" type="file">
    <input type="submit" value="Отправить файл">
</form>

<div>
<?php        
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $dir = 'img/';
            if(!is_dir($dir)) {                
                mkdir($dir);
            }
            $valid_types =  array("gif","jpg", "png", "jpeg", "bmp");
            $ext = substr($_FILES['picture']['name'], 1 + strrpos($_FILES['picture']['name'], "."));

            if (in_array($ext, $valid_types) && move_uploaded_file($_FILES['picture']['tmp_name'], $dir . 
              $_FILES['picture']['name'])) {
                  echo 'File is valid, and was successfully uploaded.';
            } else {
                  echo 'There some errors!';
            } 
            
            $files = array_diff(scandir($dir), array('.', '..'));                
            foreach($files as $key => $value) {                    
                echo '<div>';                    
                echo "<img src='$dir$files[$key]' alt='' />";
                echo '</div>';
            }  
        }
    ?>
</div>

</body>
</html>