<?php
session_start();

if (!isset($_SESSION['authorized'])) {
    header("Location: index.php");
    exit;
  }

include 'pages/header.php';
include 'pages/menu.php';
include 'autoload.php';
include 'config/SystemConfig.php';
include 'classes/JsonFileAccessModel.php';

$arr_lang = array("RU", "EN", "DE", "FR", "IT", "ESP");
$arr_original = array("Русский", "Английский", "Немецкий", "Французский", "Итальянский", "Испанский");
$modelJson = new JsonFileAccessModel('translators');
$translators = $modelJson->readJson();

if (!isset($_POST['form_to_manager'])) { ?>
<div class="container__wrapper">
    <div class="form__container">
        <div class="button__wrapper close">
            <a class="link" href="javascript:history.back()">Close</a>
        </div>
        <form action="formActions/action.php" method="post">            
            <div class="container__wrapper space">
                <div class="head__elem drop_list">
                    <label for="i01_input">Исполнитель:</label>                    
                    <select class="select" id="i01_input" name="translator">
                    <option value="None">None</option>

                    <?php                    
                    foreach ($translators as $key => $value) {
                        echo "
                            <option value=\"$value->name\">
                                $value->name ($value->projectsInProgress)
                            </option>
                        ";
                    }
                    ?>

                    </select>
                </div>
                <div class="head__elem">
                    <label for="i02_input">Клиент:</label>
                    <input class="input-client" id="i02_input" type="text"
                           placeholder="Название фирмы" name="client"
                           value="">
                </div>
            </div>
            <div class="fieldset">
                <fieldset>
                    <legend>Язык оригинала</legend>
                    <label class='label-radio'>Русский<input class='radio' type='radio' value='Русский' name='original'></label>
                    <label class='label-radio'>Английский<input class='radio' type='radio' value='Английский' name='original'></label>
                    <label class='label-radio'>Немецкий<input class='radio' type='radio' value='Немецкий' name='original'></label>
                    <label class='label-radio'>Французский<input class='radio' type='radio' value='Французский' name='original'></label>
                    <label class='label-radio'>Итальянский<input class='radio' type='radio' value='Итальянский' name='original'></label>
                    <label class='label-radio'>Испанский<input class='radio' type='radio' value='Испанский' name='original'></label>
                </fieldset>
                <fieldset>
                    <legend>Языки перевода</legend>
                    <label class='label-checkbox'>Русский<input class='checkbox' type='checkbox' value='RU' name='translate[]'></label>
                    <label class='label-checkbox'>Английский<input class='checkbox' type='checkbox' value='EN' name='translate[]'></label>
                    <label class='label-checkbox'>Немецкий<input class='checkbox' type='checkbox' value='DE' name='translate[]'></label>
                    <label class='label-checkbox'>Французский<input class='checkbox' type='checkbox' value='FR' name='translate[]'></label>
                    <label class='label-checkbox'>Итальянский<input class='checkbox' type='checkbox' value='IT' name='translate[]'></label>
                    <label class='label-checkbox'>Испанский<input class='checkbox' type='checkbox' value='ESP' name='translate[]'></label>
                </fieldset>
            </div>
            <label>
                <textarea class="default" cols="" rows="" name="text"></textarea>
            </label>

            <?php
            for($i = 0; $i < count($arr_lang); $i++) {
                $key = $arr_lang[$i];                
                echo "
                    <input name=\"text_translate[$key]\" type=\"hidden\" value=\"\">
                ";
            } 
            ?>

            <div class="footer">
                <div></div>
                <div></div>
                <div class="footer__elem last">                    
                    <button class="button_save send" type="submit" name="status" value="new">Save</button>
                </div>
                <div class="footer__elem">
                    <label for="date">Крайний срок:</label>
                    <input class="select-date" name="date" id="date" type="date" value="">
                </div>
            </div>
        </form>
    </div>
</div>

<?php } else {
        $translator = isset($_POST['translator']) ? $_POST['translator'] : '';
        $client = isset($_POST['client']) ? $_POST['client'] : '';
        $original = isset($_POST['original']) ? $_POST['original'] : '';
        $translate = isset($_POST['translate']) ? $_POST['translate'] : '';
        $text = isset($_POST['text']) ? $_POST['text'] : '';

        $arr_translate = explode(" ", $translate);
        for($i = 0; $i < count($arr_lang); $i++) {
            $key = $arr_lang[$i];
            $data_text[$i] = isset($_POST["text_translate"][$key]) ? $_POST["text_translate"][$key] : '';
        }

        $date = isset($_POST['date']) ? $_POST['date'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';
        $guid = isset($_POST['form_to_manager']) ? $_POST['form_to_manager'] : '';

?>

        <div class="container__wrapper">
        <div class="form__container">
            <div class="button__wrapper close">
                <a class="link" href="javascript:history.back()">Close</a>
            </div>
            <form action="formActions/action.php" method="post">                
                <div class="container__wrapper space">
                    <div class="head__elem drop_list">
                        <label for="i01_input">Исполнитель:</label>                        
                        <select class="select" id="i01_input" name="translator">
                        <option value="None">None</option>

            <?php       
            foreach ($translators as $key => $value) {
                if ($value->name === $translator) {
                    echo "
                    <option value=\"$value->name\" selected>
                        $value->name ($value->projectsInProgress)
                    </option>
                    ";
                } else {
                    echo "
                    <option value=\"$value->name\">
                        $value->name ($value->projectsInProgress)
                    </option>
                    ";
                }
            }                          
    echo "
                        </select>
                    </div>    
                    <div class=\"head__elem\">
                        <label for=\"i02_input\">Клиент:</label>                        
                        <input class=\"input-client\" id=\"i02_input\" type=\"text\" name=\"client\" value=\"$client\">
                    </div>    
                </div>    
                <div class=\"fieldset\">
                    <fieldset>    
                        <legend>Язык оригинала</legend>
    ";

                        for($i = 0; $i < count($arr_original); $i++) {
                            $key = $arr_original[$i];
                            if ($key === $original) {
                                echo "
                                <label class=\"label-radio\">
                                   $key
                                   <input class=\"radio\" type=\"radio\" value=\"$key\" name=\"original\" checked>
                                </label>
                                ";
                            } else {
                                echo "
                                <label class=\"label-radio\">
                                   $key
                                   <input class=\"radio\" type=\"radio\" value=\"$key\" name=\"original\">
                                </label>
                                ";
                            }
                        }

 echo "
                    </fieldset>    
                    <fieldset>    
                        <legend>Языки перевода</legend>
";
                        for($i = 0; $i < count($arr_original); $i++) {
                            $key_original = $arr_original[$i];
                            $key_lang = $arr_lang[$i];
                            if (in_array($key_lang, $arr_translate)) {
                                echo "
                                <label class=\"label-checkbox\">
                                   $key_original
                                   <input class=\"checkbox\" type=\"checkbox\" value=\"$key_lang\" name=\"translate[]\" checked>
                                </label>
                                ";
                              } else {
                                echo "
                                <label class=\"label-checkbox\">
                                   $key_original
                                   <input class=\"checkbox\" type=\"checkbox\" value=\"$key_lang\" name=\"translate[]\">
                                </label>
                                ";
                              }
                        }
echo "
                    </fieldset>
                </div>
                    <label>
                        <textarea class=\"default\" cols=\"\" rows=\"\" name=\"text\">$text</textarea>
                    </label>
";
            for($i = 0; $i < count($arr_lang); $i++) {                           
                $key_lang = $arr_lang[$i];                            
                    if (in_array($key_lang, $arr_translate)) {
                        echo "
                        <label class=\"label__textarea\">$key_lang</label>
                            <textarea class=\"translate\" name=\"text_translate[$key_lang]\">$data_text[$i]</textarea>                                                                                          
                        ";
                    } else {
                        echo "
                            <input name=\"text_translate[$key_lang]\" type=\"hidden\" value=\"$data_text[$i]\">
                        ";

                    }
            }    
echo "
                <div class=\"footer\">
                    <div class=\"footer__elem\">
";
                    if ($status !== 'done' && $status !== 'done_manager' && $status !== 'done_translator') {
                        echo "<button class=\"button_done send\" type=\"submit\" name=\"status\" value=\"done\">Done</button>";
                    } else {
                        echo "<button class=\"button_done send\" style=\"visibility: hidden;\" type=\"submit\" name=\"status\" value=\"done\">Done</button>";
                    }

echo "              
                    </div>
                <div class=\"footer__elem\">
";
                    if ($status === 'done' || $status === 'done_manager' || $status === 'done_translator') {
                        echo "<button class=\"button_finalize send\" type=\"submit\" name=\"status\" value=\"rejected_new\">Reject</button>";
                    } else {
                        echo "<button class=\"button_finalize send\" type=\"submit\" name=\"status\" value=\"rejected\">Reject</button>";
                    }

echo "
                </div>
                    <div class=\"footer__elem last\">
";
                    if ($status === 'done') {
                        echo "<button class=\"button_save send\" type=\"submit\" name=\"status\" value=\"done_manager\">Save</button>";
                    } elseif ($status === 'new') {
                        echo "<button class=\"button_save send\" type=\"submit\" name=\"status\" value=\"new_manager\">Save</button>";
                    } elseif ($status === 'rejected_new') {
                        echo "<button class=\"button_save send\" type=\"submit\" name=\"status\" value=\"rejected\">Save</button>";
                    } else {
                        echo "<button class=\"button_save send\" type=\"submit\" name=\"status\" value=\"$status\">Save</button>";
                    }
echo "
                    </div>
                    <div class=\"footer__elem\">
                        <label for=\"date\">Крайний срок:</label>
                        <input class=\"select-date\" name=\"date\" id=\"date\" type=\"date\" value=\"$date\">                        
                    </div>
                </div>
                <input name=\"guid\" type=\"hidden\" value=\"$guid\">
            </form>
        </div>
    </div>
";   
}

include 'pages/footer.php';
?>