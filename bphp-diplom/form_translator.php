<?php
include "pages/header.php";
include "pages/menu.php";

$arr_lang = array("RU", "EN", "DE", "FR", "IT", "ESP");

if (isset($_POST['translator'])) {
    $translator = $_POST['translator'];
}
if (isset($_POST['client'])) {
    $client = $_POST['client'];
}
if (isset($_POST['original'])) {
    $original = $_POST['original'];
}
if (isset($_POST['translate'])) {
    $translate = $_POST['translate'];
}
if (isset($_POST['text'])) {
    $text = $_POST['text'];
}  

$arr_translate = explode(" ", $translate);

for($i = 0; $i < count($arr_lang); $i++) {
        $key = $arr_lang[$i];
       if(isset($_POST["text_translate"][$key])) {                                  
                            $data_text[$i] = $_POST["text_translate"][$key];
       }
}

if (isset($_POST['date'])) {
    $date = $_POST['date'];
}
if (isset($_POST['status'])) {
    $status = $_POST['status'];
}  

if (isset($_POST["form_to_translator"])) {
    $guid = $_POST["form_to_translator"];
    } 
?>

<div class="container__wrapper">
    <div class="form__container">
        <div class="button__wrapper close">
            <a class="link" href="javascript:history.back()">Close</a>
        </div>

        <form action="formActions/action.php" method="post">
            <div class="container__wrapper space">
                <div>                
                    <p>Язык оригинала:</p>

<?php
        echo "
                    <p>$original</p>
                </div>
                <div>
                    <p>Языки перевода:</p>
                    <p>$translate</p>
                </div>
                <div>
                    <p>Крайний срок:</p>
                    <p>$date</p>
                </div>
            </div>";

echo "
            <input type=\"hidden\" name=\"translator\" value=\"$translator\">
            <input type=\"hidden\" name=\"client\" value=\"$client\">
            <input type=\"hidden\" name=\"original\" value=\"$original\">";

            for($i = 0; $i < count($arr_translate); $i++) {
               $key = $arr_translate[$i];

                 echo "
                 <input type=\"hidden\" name=\"translate[]\" value=\"$key\">
                 ";
            }

echo "
            <label for=\"i21\"></label>
            <textarea id=\"i21\" class=\"default\" name=\"text\" readonly>$text</textarea>";

            for($i = 0; $i < count($arr_lang); $i++) {                           
                $key_lang = $arr_lang[$i];
                
                if (in_array($key_lang, $arr_translate)) {

                    echo "
                    <label for=\"i20\" class=\"label__textarea\">"
                    . $key_lang                
                    . "</label>"
                    . "<textarea class=\"translate\" name=\"text_translate["
                    . $key_lang
                    . "]\">$data_text[$i]</textarea>                                                                                          
                    ";

                  } else {

                    echo                                

                    "<input name=\"text_translate["
                    . $key_lang
                    . "]\" type=\"hidden\" value=\"$data_text[$i]\"> ";

                  }
            }
            
echo "
            <input type=\"hidden\" name=\"date\" value=\"$date\">            
            
            <div class=\"footer\">
                <div class=\"footer__elem\">";

                    if ($status !== 'done'&& $status !== 'done_manager' && $status !== 'done_translator') {
                        echo "<button class=\"button_done send\" type=\"submit\" name=\"status\" value=\"resolved\">Resolved</button>";
                    } else {
                        echo "<button class=\"button_done send\" style=\"visibility: hidden;\" type=\"submit\" name=\"status\" value=\"resolved\">Resolved</button>";
                    }


echo "</div>
                <div class=\"footer__elem\">";

                if ($status === 'done') {
                    echo "<button class=\"button_save send\" type=\"submit\" name=\"status\" value=\"done_translator\">Save</button>";
                } elseif ($status === 'new') {
                    echo "<button class=\"button_save send\" type=\"submit\" name=\"status\" value=\"new_translator\">Save</button>";
                } elseif ($status === 'rejected_new') {
                    echo "<button class=\"button_save send\" type=\"submit\" name=\"status\" value=\"rejected\">Save</button>";
                } else {
                    echo "<button class=\"button_save send\" type=\"submit\" name=\"status\" value=\""
                    . $status
                    . "\">Save</button>";
                }    


echo "          
                </div>
            </div>
            
            <input name=\"guid\" type=\"hidden\" value=\"$guid\"> 
        </form>
    </div>
</div>";
 
include "pages/footer.php";
?>