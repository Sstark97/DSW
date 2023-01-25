<?php
    
    class Session {
        public function __construct() {
            if(!isset($_SESSION)) {
                session_start();
            }
        }

        public function setAttribute (string $attribute, string $value) {
            if(!isset($_SESSION[$attribute]) && is_string($value)) {
            $_SESSION[$attribute] = $value;
            }
        }

        public function getAttribute (string $attribute) {
            if(isset($_SESSION[$attribute]) && is_string($attribute)) {
                return $_SESSION[$attribute];
            }
        }

        public function deleteAttribute (string $attribute) {
            if(isset($_SESSION[$attribute]) && is_string($attribute)) {
                unset($_SESSION[$attribute]);
            }
        }

        public function destroySession () {
            session_destroy();
        }
    }
?>