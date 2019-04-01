<?php
    class Dao {
        private $host = "us-cdbr-iron-east-03.cleardb.net";
        private $db = "heroku_178e4f084859e1a";
        private $user = "b4d15cc732a3a0";
        private $pass = "bcb11a77";
        
        private function getConnection () {
            $conn = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }



        /**  Methods for user  **/

        public function getUser($username) {
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM User WHERE Username = '$username'", PDO::FETCH_ASSOC);
        }

        // return true if username is available, false otherwise
        public function usernameAvailable($username) {
            $conn = $this->getConnection();
            $result = $conn->query("SELECT Username FROM User WHERE Username = '$username'", PDO::FETCH_ASSOC);
            return $result == null || $result->rowCount() <= 0;
        }

        // return true if email is available, false otherwise
        public function emailAvailable($email) {
            $conn = $this->getConnection();
            $result = $conn->query("SELECT Email FROM User WHERE Email = '$email'", PDO::FETCH_ASSOC);
            return $result == null || $result->rowCount() <= 0;
        }

        public function createUser($name, $username, $password, $email) {
            $conn = $this->getConnection();
            $saveQuery = "INSERT INTO User (Name, Username, Password, Email) VALUES (:name, :username, :password, :email)";
            $q = $conn->prepare($saveQuery);
            $q->bindParam(":name", $name);
            $q->bindParam(":username", $username);
            $q->bindParam(":password", $password);
            $q->bindParam(":email", $email);
            $q->execute();
        }

        public function updateUser($name, $username, $password, $email, $id) {
            $conn = $this->getConnection();
            $saveQuery = "UPDATE User SET Name = :name, Username = :username, Password = :password, Email = :email WHERE ID = $id";
            $q = $conn->prepare($saveQuery);
            $q->bindParam(":name", $name);
            $q->bindParam(":username", $username);
            $q->bindParam(":password", $password);
            $q->bindParam(":email", $email);
            $q->execute();
        }



        /** Methods for entries **/

        public function createEntry($side, $joint, $pain, $date, $time, $id) {
            $conn = $this->getConnection();
            $saveQuery = "INSERT INTO Entry (UserID, Side, Joint, PainLevel, Time, Date) 
                VALUES ($id, :side, :joint, $pain, TIME(STR_TO_DATE(:time, '%H:%i %p')), :date)";
            $q = $conn->prepare($saveQuery);
            $q->bindParam(":side", $side);
            $q->bindParam(":joint", $joint);
            $q->bindParam(":time", $time);
            $q->bindParam(":date", $date);
            $q->execute();
        }


        /** By day **/

        public function getEntryByDay($date, $userID) {
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM Entry WHERE UserID = $userID AND Date = '$date'", PDO::FETCH_ASSOC);
        }

        public function getEntryByDay_TimeRange($date, $userID, $start, $end) {
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM Entry WHERE UserID = $userID AND Date = '$date' 
                AND Time >= '$start' AND Time <= '$end'", PDO::FETCH_ASSOC);
        }

        public function getPainStatsByDay($date, $userID) {
            $conn = $this->getConnection();
            return $conn->query("SELECT avg(PainLevel) as Avg, min(PainLevel) as Min, max(PainLevel) as Max 
                FROM Entry WHERE UserID = $userID AND Date = '$date'", PDO::FETCH_ASSOC);
        }
        

        /** By month or year **/

        public function getEntryByMonthOrYear($date, $userID) {
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM Entry WHERE UserID = $userID AND Date LIKE '$date-%'", PDO::FETCH_ASSOC);
        }

        public function getEntryByMonthOrYear_TimeRange($date, $userID, $start, $end) {
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM Entry WHERE UserID = $userID AND Date LIKE '$date-%' 
                AND Time >= '$start' AND Time <= '$end'", PDO::FETCH_ASSOC);
        }

        public function getPainStatsByMonthOrYear($date, $userID) {
            $conn = $this->getConnection();
            return $conn->query("SELECT avg(PainLevel) as Avg, min(PainLevel) as Min, max(PainLevel) as Max 
                FROM Entry WHERE UserID = $userID AND Date LIKE '$date-%'", PDO::FETCH_ASSOC);
        }

        public function getJointCountByMonthOrYear($date, $userID) {
            $conn = $this->getConnection();
            return $conn->query("SELECT Side, 
                SUM(case when Joint = 'ankle' then 1 else 0 end) as Ankle, 
                SUM(case when Joint = 'knee' then 1 else 0 end) as Knee, 
                SUM(case when Joint = 'hip' then 1 else 0 end) as Hip, 
                SUM(case when Joint = 'hand' then 1 else 0 end) as Hand, 
                SUM(case when Joint = 'wrist' then 1 else 0 end) as Wrist, 
                SUM(case when Joint = 'elbow' then 1 else 0 end) as Elbow, 
                SUM(case when Joint = 'shoulder' then 1 else 0 end) as Shoulder
                FROM Entry WHERE UserID = $userID AND Date LIKE '$date-%'
                GROUP BY Side;", PDO::FETCH_ASSOC);
        }

    }
?>