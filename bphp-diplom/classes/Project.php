<?php
class Project extends DataRecordModel {
    public $translator;
    public $client;
    public $original;
    public $translate;
    public $text;
    public $text_translate;          
    public $date;
    public $status;
    public $guid;
            
    function __construct($translator = null, $client = null, $original = null, $translate = null, $text = null, $text_translate = null, $date = null, $status = null, $guid = null) {
        parent::__construct($guid);
        $this->translator = $translator;
        $this->client = $client;
        $this->original = $original;
        $this->translate = $translate;
        $this->text = $text;
        $this->text_translate = $text_translate;
        $this->date = $date;
        $this->status = $status;
    }

    public function addFromForm() {                
        $this->commit();
    }

    public function delFromForm() {
        $this->delete();
    }
}