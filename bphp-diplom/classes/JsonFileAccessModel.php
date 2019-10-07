<?php
class JsonFileAccessModel {
    protected $fileName,
                $file;

    public function __construct($fileName) {
        $this->fileName = __DIR__ . '/../' . Config::DATABASE_PATH.$fileName.'.json';
    }

    protected function connect($mode) {  
        $this->file = fopen($this->fileName, $mode);
        if ($this->file === false) {
            exit('Failed to open stream');
        };
    }

    protected function disconnect() {
        fclose($this->file);
    }

    public function read() {
        $this->connect('r');
        if (is_readable($this->fileName)) {
            $data = fread($this->file, filesize($this->fileName));
        }; 
        $this->disconnect();
        return json_decode($data);
    }

    public function write($text) {
        $this->connect('w');
        if (is_writable($this->fileName)) {
            $data = fwrite($this->file, $text);
        };
        $this->disconnect();
    }

    public function readJson() {
        $this->connect('r');
        if (is_readable($this->fileName)) {
            $data = fread($this->file, filesize($this->fileName));
        };
        $this->disconnect();
        return json_decode($data);
    }

    public function writeJson($text) {
        $json = json_encode($text, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $this->connect('w');
        if (is_writable($this->fileName)) {
            fwrite($this->file, $json);
        };
        $this->disconnect();
    }
}