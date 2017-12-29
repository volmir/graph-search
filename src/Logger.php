<?php

namespace App;

class Logger {
    
    /**
     *
     * @var array
     */
    public $messages = [];
    
    public function __construct() {
        ;
    }

    public function add(string $message) {
        if (is_string($message)) {
           $this->messages[] = trim($message); 
        }
    }

    public function getMessages(): array {
        return $this->messages;
    }
    
}
