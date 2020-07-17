<?php
//   define('DB_SERVER', 'localhost');
//   define('DB_USER', 'root');
//   define('DB_PASS', '');
//   define('DB_NAME', 'ics102728');
  
// class DBConnector
// {

//     public $conn;

//     public function __construct()
//     {
//         $conn = new mysqli(DB_SERVER, DB_USER, DB_PASS) or die("Connection failed: " . $conn->connect_error); 
//         mysqli_select_db($conn, DB_NAME);
//     }

//     public function closeDatabase()
//     {
//         mysqli_close($this->conn);
//     }
// }

class Dbh {
    private $servername;
    private $username;
    private $password;
    private $dbname;
     protected function connect() {
         $this->servername = "localhost";
         $this->username = "root";
         $this->password = "";
         $this->dbname = "ics102728";

         $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);

         return $conn;
     }
}