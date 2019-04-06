<?php
    class Secrets {
        private $host = "us-cdbr-iron-east-03.cleardb.net";
        private $db = "heroku_178e4f084859e1a";
        private $user = "b4d15cc732a3a0";
        private $pass = "bcb11a77";

        public function getHost() {
            return $this->host;
        }

        public function getDB() {
            return $this->db;
        }

        public function getUsername() {
            return $this->user;
        }

        public function getPassword() {
            return $this->pass;
        }
    }
?>