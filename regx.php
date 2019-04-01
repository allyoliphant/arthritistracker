<?php
    class Regx {

        // return true if name fits the pattern, false otherwise
        public function nameValid ($name) {
            $pattern = "/^(?=.*[a-zA-Z])[a-zA-Z\s]{1,30}$/";
            return preg_match($pattern, $name);
        }

        // return true if username fits the pattern, false otherwise
        public function usernameValid ($username) {
            $pattern = "/^[a-zA-Z0-9]{6,30}$/";
            return preg_match($pattern, $username);
        }

        // return true if password fits the pattern, false otherwise
        public function passwordValid ($password) {
            $pattern = "/(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#\$%&\?\-_])[a-zA-Z0-9!@#\$%&\?\-_]{6,30}/";
            return preg_match($pattern, $password);
        }

        // return true if name fits the pattern, false otherwise
        public function emailValid ($email) {
            $pattern = "/^[a-zA-Z0-9_\.-]+@[a-zA-Z0-9-\.]+\.[a-zA-Z0-9-]+$/";
            return preg_match($pattern, $email);
        }
    }
?>