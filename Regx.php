<?php
    class Regx {

        // return true if name fits the pattern, false otherwise
        public function nameValid ($name) {
            $pattern = "/^(?=.*[a-zA-Z0-9])[a-zA-Z0-9\s]{1,30}$/";
            return preg_match($pattern, $name);
        }

        // return true if username fits the pattern, false otherwise
        public function usernameValid ($username) {
            $pattern = "/^[a-zA-Z0-9]{4,30}$/";
            return preg_match($pattern, $username);
        }

        // return true if password fits the pattern, false otherwise
        public function passwordValid ($password) {
            $pattern = "/(?=.*[0-9])(?=.*[a-zA-Z])(?=.*[!@#\$%&\?\-_])[a-zA-Z0-9!@#\$%&\?\-_]{6,}/";
            return preg_match($pattern, $password);
        }

        // return true if name fits the pattern, false otherwise
        public function emailValid ($email) {
            $pattern = "/^[a-zA-Z0-9_\.-]+@[a-zA-Z0-9-\.]+\.[a-zA-Z0-9-]+$/";
            return preg_match($pattern, $email);
        }

        // return true if date is a date, false otherwise
        public function dateValid ($date) {
            $pattern = "/[\d\-]{4,10}/";
            return preg_match($pattern, $date);
        }
    }
?>