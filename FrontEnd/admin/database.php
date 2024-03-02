<?php
    include "config.php";
?>

<?php
    Class Database{
        public $host = DB_HOST;
        public $user = DB_USER;
        public $pass = DB_PASS;
        public $dbname = DB_NAME;
         
        public $link;
        public $error;

        public function __construct(){   
            $this->connectDB();
        }

        private function connectDB(){
            $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
            if($this->link){
                $this->error="Connection fail".$this->link->connect_error;
            return false;
            }
        }
    //select or Read data
        public function select($query){
            $result = $this->link->query($query) or die ($this->link->error.__LINE__);
            if($result->num_rows > 0){
                return $result;
            }else{
                return false;
            }
        }
    //insert data
        public function insert($query){
            $insert_row = $this->link->query($query) or die ($this->link->error.__LINE__);
            if($insert_row){
                return $insert_row;
            }else{
                return false;
            }
        }
    //update data
        public function update($query){
            $update_row = $this->link->query($query) or die ($this->link->error.__LINE__);
            if($update_row){
                return $update_row;
            }else {
                return false;
            }
        }
    //delete data
        public function delete($query){
            $delete_row = $this->link->query($query) or die ($this->link->error.__LINE__);
            if($delete_row){
                return $delete_row;
            }else {
                return false;
            }

        }
        public function escape($value) {
            return $this->link->real_escape_string($value);
        }
        
        //login
        // function login_user($username, $password) {
        //     global $conn;

        //     $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE username = ?");
        //     $stmt->bind_param("s", $username);
        //     $stmt->execute();
        //     $stmt->bind_result($user_id, $username, $hashed_password);
        //     $stmt->fetch();

        //     if (password_verify($password, $hashed_password)) {
        //         return $user_id;
        //     } else {
        //         return false;
        //     }

        //     $stmt->close();
        // }
    }
