<?php
class Projects extends JsonDataArray {
    public $arr_lang;
    public $filter;
    public $path;

    function __construct($arr_lang = array("RU", "EN", "DE", "FR", "IT", "ESP"), $filter = null, $path = null) {
        parent::__construct();
        $this->arr_lang = $arr_lang;
        $this->filter = $filter;
        $this->path = $path;
    }

    public function displayPage() {
        // $data = $this->newQuery()->orderBy('date');
        $data = $this->newQuery();
        $projects = $data->getObjs();
        $guids = $data->getGuids();

        $this->filter = (isset($_GET['filterParam'])) ? $_GET['filterParam'] : '';
        $this->path = ($_COOKIE['login'] == 'admin') ? "form_manager.php" : "form_translator.php";   
        
        foreach ($projects as $index => $obj) {   
            if(isset($obj->translate)) {               
                $str = implode(' ', $obj->translate);
            }          

        for($i = 0; $i < count($this->arr_lang); $i++) {
            if(isset($obj->text_translate->{$this->arr_lang[$i]})) {
                $string[$i] = $obj->text_translate->{$this->arr_lang[$i]};
            }            
        }            

        if (($_COOKIE['login'] == 'admin') && (substr($obj->status, 0, 3) === substr($this->filter, 0, 3))  || ($_COOKIE['login'] == 'admin') && ($this->filter === '')) { 

            echo "<div class=\"container__wrapper\">"
                . '<div class="form__container">'

                . '<form method="post" '
                . "action=\"{$this->path}\">"

                . '<fieldset>'
                . "<legend>$obj->translator</legend>"

                . '<div class="task-list__item">'
                
                . '<input type="hidden" name="translator" '
                . "value=\"{$obj->translator}\">"
                . '<input type="hidden" name="client" '
                . "value=\"{$obj->client}\">" 
                . '<input type="hidden" name="original" '
                . "value=\"{$obj->original}\">" 
                . '<input type="hidden" name="date" '
                . "value=\"{$obj->date}\">" 

                . '<input type="hidden" name="status" '
                . "value=\"{$obj->status}\">"

                . '<input name="translate" type="hidden" value="'
                . $str                
                . '">'
                
                . '<div class="content__wrapper">'
                . '<textarea name="text" class="translate" readonly>'
                
                . $obj->text
                . '</textarea>'
                . '</div>';                

                for($i = 0; $i < count($this->arr_lang); $i++) {
                        $key = $this->arr_lang[$i];
                    if(isset($string[$i])) {
                               echo                                                 
                                    "<input name=\"text_translate["
                                    . $key
                                    . "]\" type=\"hidden\" value=\"$string[$i]\"> ";                  
                    }
                }

                echo '<div class="redact">'

                . '<button type="submit" class="link" name="form_to_manager" '
                . "value=\"{$guids[$index]}\" >Edit</button>"
                . '<p>'
                . $obj->date                            
                . '</p>'

                . '<div>'
                
                . "<button type='submit' class='link' formaction='formActions/delete.php?obj=$guids[$index]' name='delete'>Delete</button>"                

                . '<p> '
                . $obj->original
                . ' -</p>'

                . '<p> '
                . $str
                . '</p>'

                . '</div>'

                . '</div>'
                . '</div>'

                . '</fieldset>'

                . '</form>'

                . '</div>'
                . '</div>'; 
       
        } 
        
        elseif (($_COOKIE['login'] == $obj->translator) && (substr($obj->status, 0, 3) === substr($this->filter, 0, 3)) || ($_COOKIE['login'] == $obj->translator) && ($this->filter === '')) { 

            echo "<div class='container__wrapper'>"
                . '<div class="form__container">'

                . '<form method="post" '
                . "action=\"{$this->path}\">"

                . '<fieldset>'
                . '<div class="task-list__item">'
                
                . '<input type="hidden" name="translator" '
                . "value=\"{$obj->translator}\">"
                . '<input type="hidden" name="client" '
                . "value=\"{$obj->client}\">" 
                . '<input type="hidden" name="original" '
                . "value=\"{$obj->original}\">" 
                . '<input type="hidden" name="date" '
                . "value=\"{$obj->date}\">"
                
                . '<input type="hidden" name="status" '
                . "value=\"{$obj->status}\">" 

                . '<input name="translate" type="hidden" value="'
                . $str
                . '">'
                
                . '<div class="content__wrapper">'
                . '<textarea name="text" class="translate" readonly>'
                
                . $obj->text
                . '</textarea>'
                . '</div>';                

                for($i = 0; $i < count($this->arr_lang); $i++) {
                        $key = $this->arr_lang[$i];
                    if(isset($string[$i])) {
                               echo                                                 
                                    "<input name=\"text_translate["
                                    . $key
                                    . "]\" type=\"hidden\" value=\"$string[$i]\"> ";                  
                    }
                }

                echo '<div class="redact">'
                
                . '<button type="submit" class="link" name="form_to_translator" '
                . "value=\"{$guids[$index]}\" >Edit</button>"
                . '<p>'
                . $obj->date
                . '</p>'

                . '<div>'

                . '<p> '
                . $obj->original
                . ' -</p>'
                
                . '<p> '
                . $str
                . '</p>'

                . '</div>'

                . '</div>'
                . '</div>'

                . '</fieldset>'
                . '</form>'

                . '</div>'
                . '</div>';
        
       }
   }
 } 
}