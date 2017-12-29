<?php

namespace App;

class Printer {

    /**
     *
     * @var array
     */
    public $messages = [];

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
