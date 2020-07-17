<?php
include "crud.php";
include "authenticate.php";
include_once "DBConnector.php";
class User implements Crud
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;
    private $conn;

    private $username;
    private $password;
    private $data;
    private $utc_timestamp;
    private $offset;

 
    function __construct($first_name, $last_name, $city_name, $username, $password, $data, $utc_timestamp, $offset)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->city_name = $city_name;
        $this->username = $username;
        $this->password = $password;
        $this->data = $data;
        $this->utc_timestamp = $utc_timestamp;
        $this->offset = $offset;
        $this->con = new DBConnector();
    }


    public static function create()
    {
        $instance = new self(null, null, null, null, null, null, null, null);
        return $instance;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function save()
    {
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        $uname = $this->username;
        $this->hashPassword();
        $pass = $this->password;
        $filename = $this->data['name'];
        $utc_timestamp = $this->utc_timestamp;
        $offset = $this->offset;
        $sql = "INSERT INTO user(first_name,last_name,user_city,username,password,filename,uct_timestamp,offset)
                     VALUES('$fn','$ln','$city','$uname','$pass','$filename','$utc_timestamp','$offset')";

        $res = mysqli_query($this->con->conn, $sql) or die("Error " . mysqli_error($con->conn));


        return $res;
    }

    public function readAll()
    {
        $sql = "SELECT * FROM user";
        $res = mysqli_query($this->con->conn, $sql) or die("Error " . mysqli_error($con->conn));

        return $res;
    }

    public function readUnique()
    {
        return null;
    }

    public function search()
    {
        return null;
    }

    public function update()
    {
        return null;
    }

    public function removeOne()
    {
        return null;
    }

    public function removeAll()
    {
        return null;
    }

    public function validateForm()
    {
        $fname = $this->first_name;
        $lname = $this->last_name;
        $city = $this->city_name;

        if ($fname == "" || $lname == "" || $city == "") {
            return false;
        }
        return true;
    }

    public function createFormErrorSessions()
    {
        session_start();
        $_SESSION['form_errors'] = "All fields are required!";
    }

    public function createUsernameErrorSessions()
    {
        session_start();
        $_SESSION['form_errors'] = "Username already exists!";
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function isPasswordCorrect()
    {
        $found = false;
        $sql = "SELECT * FROM user";
        
        $result = mysqli_query($this->con->conn, $sql) or die("Error " . mysqli_error($con->conn));


        while ($row = $result->fetch_array()) {
            if (
                password_verify($this->getPassword(), $row['password'])
                && $this->getUsername() == $row['username']
            ) {
                $found = true;
            }
        }
        
        print_r($found);
        return $found;
    }

    public function login()
    {
        if ($this->isPasswordCorrect()) {
            header('Location: private_page.php');
        }
    }

    public function createUserSession()
    {
        session_start();
        $_SESSION['username'] = $this->getUsername();
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['id']);
        session_destroy();
        header('location:index.php');
    }

    public function isUserExists($username)
    {
        $sql = "SELECT * FROM user where username='$username'";
        
        $res = mysqli_query($this->con->conn, $sql) or die("Error " . mysqli_error($con->conn));


        if ($res->num_rows > 0) {
            return true;
        }
        return false;
    }
}
