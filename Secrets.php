<?php
    class Secrets {
        private $host = "us-cdbr-iron-east-03.cleardb.net";
        private $db = "heroku_178e4f084859e1a";
        private $user = "b4d15cc732a3a0";
        private $pass = "bcb11a77";

        public function getHost() {
            return $host;
        }

        public function getDB() {
            return $db;
        }

        public function getUsername() {
            return $user;
        }

        public function getPassword() {
            return $pass;
        }
    }
?>