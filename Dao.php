<?php    

    // Class with all the methods that directly get, add or update content in the database
    class Dao {
        
        // connent to the database
        private function getConnection () {
            $host = getenv('DB_HOST');
            $name = getenv('DB_NAME');
            $username = getenv('DB_USERNAME');
            $password = getenv('DB_PASSWORD');
            $conn = new PDO("mysql:host={$host};dbname={$name}", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }



        /**  Methods for user  **/

        // return user with the provided username and password
        public function getUser($username, $password) {
            $conn = $this->getConnection();
            $pass = md5($password . getenv('SALT'));
            return $conn->query("SELECT * FROM User WHERE Username = '$username' AND Password = '$pass'");
        }

        // return true if username is available, false otherwise
        public function usernameAvailable($username, $id) {
            $conn = $this->getConnection();
            $result = $conn->query("SELECT Username FROM User WHERE Username = '$username' AND ID NOT LIKE '$id'", PDO::FETCH_ASSOC);
            return $result == null || $result->rowCount() <= 0;
        }

        // return true if email is available, false otherwise
        public function emailAvailable($email) {
            $conn = $this->getConnection();
            $result = $conn->query("SELECT Email FROM User WHERE Email = '$email'", PDO::FETCH_ASSOC);
            return $result == null || $result->rowCount() <= 0;
        }

        // add a new user
        public function createUser($name, $username, $password, $email) {
            $conn = $this->getConnection();
            $pass = md5($password . getenv('SALT'));
            $saveQuery = "INSERT INTO User (Name, Username, Password, Email) VALUES (:name, :username, :password, :email)";

            // sanitize inputs
            $q = $conn->prepare($saveQuery);
            $q->bindParam(":name", $name);
            $q->bindParam(":username", $username);
            $q->bindParam(":password", $pass);
            $q->bindParam(":email", $email);

            $q->execute();
        }

        // update a user
        public function updateUser($name, $username, $password, $email, $id) {
            $conn = $this->getConnection();
            $pass = md5($password . getenv('SALT'));
            $saveQuery = "UPDATE User SET Name = :name, Username = :username, Password = :password, Email = :email WHERE ID = $id";
            
            // sanitize inputs
            $q = $conn->prepare($saveQuery);
            $q->bindParam(":name", $name);
            $q->bindParam(":username", $username);
            $q->bindParam(":password", $pass);
            $q->bindParam(":email", $email);

            $q->execute();
        }



        /** Methods for entries **/

        // add a new entry
        public function createEntry($side, $joint, $pain, $date, $time, $id) {
            $conn = $this->getConnection();
            $saveQuery = "INSERT INTO Entry (UserID, Side, Joint, PainLevel, Time, Date) 
                VALUES ($id, :side, :joint, $pain, TIME(STR_TO_DATE(:time, '%H:%i %p')), :date)";
                
            // sanitize inputs
            $q = $conn->prepare($saveQuery);
            $q->bindParam(":side", $side);
            $q->bindParam(":joint", $joint);
            $q->bindParam(":time", $time);
            $q->bindParam(":date", $date);

            $q->execute();
        }

        // edit a entry
        public function editEntry($side, $joint, $pain, $date, $time, $entryid) {
            $conn = $this->getConnection();
            $saveQuery = "UPDATE Entry SET Side = :side, Joint = :joint, PainLevel = :pain, Date = :date, Time = :time WHERE ID = :entryid";
            
            // sanitize inputs
            $q = $conn->prepare($saveQuery);
            $q->bindParam(":side", $side);
            $q->bindParam(":joint", $joint);
            $q->bindParam(":pain", $pain);
            $q->bindParam(":date", $date);
            $q->bindParam(":time", $time);
            $q->bindParam(":entryid", $entryid);
            
            $q->execute();
        }


        /** By day **/

        // get all entries for a user on a provided day
        public function getEntryByDay($date, $userID) {
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM Entry WHERE UserID = $userID AND Date = '$date'", PDO::FETCH_ASSOC);
        }

        // get pain stats for a user on a provided day
        public function getPainStatsByDay($date, $userID) {
            $conn = $this->getConnection();
            return $conn->query("SELECT avg(PainLevel) as Avg, min(PainLevel) as Min, max(PainLevel) as Max 
                FROM Entry WHERE UserID = $userID AND Date = '$date'", PDO::FETCH_ASSOC);
        }

        // get the number of entries per joint for a user on a provided day
        public function getJointCountByDay($date, $userID) {
            $conn = $this->getConnection();
            return $conn->query("SELECT Side, 
                SUM(case when Joint = 'ankle' then 1 else 0 end) as Ankle, 
                SUM(case when Joint = 'knee' then 1 else 0 end) as Knee, 
                SUM(case when Joint = 'hip' then 1 else 0 end) as Hip, 
                SUM(case when Joint = 'hand' then 1 else 0 end) as Hand, 
                SUM(case when Joint = 'wrist' then 1 else 0 end) as Wrist, 
                SUM(case when Joint = 'elbow' then 1 else 0 end) as Elbow, 
                SUM(case when Joint = 'shoulder' then 1 else 0 end) as Shoulder
                FROM Entry WHERE UserID = $userID AND Date LIKE '$date'
                GROUP BY Side;", PDO::FETCH_ASSOC);
        }
        

        /** By month or year **/

        // get all entries for a user on a provided month or year
        public function getEntryByMonthOrYear($date, $userID) {
            $conn = $this->getConnection();
            return $conn->query("SELECT * FROM Entry WHERE UserID = $userID AND Date LIKE '$date-%'", PDO::FETCH_ASSOC);
        }

        // get pain stats for a user on a provided month or year
        public function getPainStatsByMonthOrYear($date, $userID) {
            $conn = $this->getConnection();
            return $conn->query("SELECT avg(PainLevel) as Avg, min(PainLevel) as Min, max(PainLevel) as Max 
                FROM Entry WHERE UserID = $userID AND Date LIKE '$date-%'", PDO::FETCH_ASSOC);
        }

        // get the number of entries per joint for a user on a provided month or year
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