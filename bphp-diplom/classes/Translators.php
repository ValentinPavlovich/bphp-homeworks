<?php
class Translators {
    public $translator;
    public $replaced_translator;    

    function __construct($translator = null, $replaced_translator = null) {
            $this->translator = $translator;
            $this->replaced_translator = $replaced_translator;            
    }

    public function addCounter() {
        $modelJson = new JsonFileAccessModel('translators');
        $content = $modelJson->readJson();
        
        foreach ($content as $key => $value) {            
            if ($value->name === $this->translator) {
                $value->projectsInProgress += 1;
                break;
            }
        }        
        $modelJson->writeJson($content);
    }

    public function delCounter() {
        $modelJson = new JsonFileAccessModel('translators');
        $content = $modelJson->readJson();
    
        foreach ($content as $key => $value) {
            if ($value->name === $this->translator && $value->projectsInProgress > 0) {
                $value->projectsInProgress -= 1;
                break;
            }
        }
        $modelJson->writeJson($content);
    }

    public function changeCounter() {
        $modelJson = new JsonFileAccessModel('translators');
        $content = $modelJson->readJson();

        foreach ($content as $key => $value) {
            if ($value->name === $this->replaced_translator && $value->projectsInProgress > 0) {
                $value->projectsInProgress -= 1;
                break;
            }
        }
        foreach ($content as $key => $value) {
            if ($value->name === $this->translator) {
                $value->projectsInProgress += 1;
                break;
            }
        }
        $modelJson->writeJson($content);
    }
}