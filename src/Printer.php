<?php

namespace App;

class Printer {

    /**
     *
     * @var array
     */
    public $messages = [];

    /**
     * 
     * @param array $messages
     * @return $this
     */
    public function set(array $messages) {
        if (is_array($messages)) {
            $this->messages = $messages;
        }
        
        return $this;
    }

    public function show() {
        if (count($this->messages)) {
            foreach ($this->messages as $message) {
                echo $message . PHP_EOL;
            }
        }
    }
    
}
