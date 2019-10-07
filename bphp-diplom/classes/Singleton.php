<?php
class Singleton {
    protected static $instance;

    public function __construct() {
    }

    public function __clone() {
        throw new Error('Not clonable..');
    }

    public function __wakeup() {
    }

    public static function init() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}