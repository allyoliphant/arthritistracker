<?php
    class Dao {
        private $host = "us-cdbr-iron-east-03.cleardb.net";
        private $db = "heroku_178e4f084859e1a";
        private $user = "b4d15cc732a3a0";
        private $pass = "bcb11a77";
        
        private function getConnection () {
            return new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
        }

        public function getUser($username) {
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM User WHERE Username = '$username'", PDO::FETCH_ASSOC);
        }

        // return true if username is available, false otherwise
        public function checkIfAvailable($username) {
            $conn = $this->getConnection();
            $result = $conn->query("SELECT Username FROM User WHERE Username = '$username'", PDO::FETCH_ASSOC);
            return $result == null || $result->rowCount() <= 0;
        }

        public function createUser($name, $username, $password, $email) {
            $conn = $this->getConnection();
            $saveQuery = "insert into User (Name, Username, Password, Email) values (:name, :username, :password, :email);";
            $q = $conn->prepare($saveQuery);
            $q->bindParam(":name", $name);
            $q->bindParam(":username", $username);
            $q->bindParam(":password", $password);
            $q->bindParam(":email", $email);
            $q->execute();
        }
    }
?>