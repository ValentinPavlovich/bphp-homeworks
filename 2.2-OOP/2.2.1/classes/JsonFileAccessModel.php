<?php
    class JsonFileAccessModel
    {
        protected $fileName;
        protected $file;
        function __construct($fileName) {
            $this->fileName = Config::DATABASE_PATH . $fileName . '.json';
        }
        private function connect($mode)
        {
            $this->file = fopen($this->fileName, $mode);
        }
        private function disconnect()
        {
            fclose($this->file);
        }
        public function read()
        {
            $this->connect('r');
            $filename = $this->fileName;
            $fileSize = filesize($filename);        
            $contents = fread($this->file, $fileSize);
            $this->disconnect();
            return $contents;        
        }
        public function write($contents)
        {
            $this->connect('w');
            fwrite($this->file, $contents);
            $this->disconnect();      
        }
        public function readJson()
        {
            $this->connect('r');
            $filename = $this->fileName;
            $fileSize = filesize($filename);        
            $contents = fread($this->file, $fileSize);
            $jsonObj = json_decode($contents,true);
            $this->disconnect();
            return $jsonObj;          
        }
        public function writeJson($contents)
        {
            $this->connect('w');
            $json = json_encode($contents,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            fwrite($this->file, $json);
            $this->disconnect();            
        }
    } 
?>