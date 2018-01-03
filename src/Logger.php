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

    /**
     * 
     * @param string $message
     */
    public function add(string $message) {
        if (is_string($message)) {
           $this->messages[] = trim($message); 
        }
    }

    /**
     * 
     * @return array
     */
    public function getMessages(): array {
        return $this->messages;
    }
    
}
