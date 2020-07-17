<?php
include "DBConnector.php";
include "Crud.php";
include "Authenticator.php";

class User extends Dbh implements Crud,Authenticator
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    private $username;
    private $password;

    // We can use our constructor to initialize our values
    // member variables cannot be instantiated from elsewhere; They private;
    function __construct($first_name, $last_name, $city_name, $username, $password)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->city_name = $city_name;
        $this->username = $username;
        $this->password = $password;
    }

    // user_id setter
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    // user_id getter
    public function getUserId()
    {
        return $this->user_id;
    }

    public static function create() {
        $instance = new self($first_name, $last_name, $city_name, $username, $password);
        return $instance;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function hashPassword()
    {
        $this->password = password_hash($this->password,PASSWORD_DEFAULT);
    }

    public function isPasswordCorrect()
    {
        $con = $this->connect();
        $found = false;
        $sql = "SELECT * FROM user";
        $res = mysqli_query($con, $sql);
        
        while($row = $res->fetch_array()){
            if(password_verify($this->getPassword(),$row['password']) && $this->getUsername() == $row['username']) {
                $found = true;
            }
        }

        mysqli_close($con);
        return $found;
    }

    public function isUserExist()
    {
        $con = $this->connect();
        $unique = true;
        $sql = "SELECT * FROM user";
        $res = mysqli_query($con, $sql);
        
        while($row = $res->fetch_array()){
            if($this->getUsername() == $row['username']) {
                $unique = false;
            }
        }

        mysqli_close($con);
        return $unique;
    }

    public function login()
    {
        if($this->isPasswordCorrect()) {
            header("Location:private_page.php");
        }
    }

    public function createUserSession () {
        session_start();
        $_SESSION['username'] = $this->getUsername();
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['username']);
        session_destroy();
        header("Location:lab1.php");
    }

    public function save()
    {
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        $uname = $this->username;
        $this->hashPassword();
        $pass = $this->password;
        $sql = "INSERT INTO user(first_name,last_name,user_city,username,password)
                     VALUES('$fn','$ln','$city','$uname','$pass');";
        $con = $this->connect();
        $res = mysqli_query($con, $sql);

        return $res;
    }

    public function readAll()
    {
        $sql = "SELECT * FROM user";
        $result = $this->connect()->query($sql);
        $numRows = $result->num_rows;

        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
        // $sql = "SELECT * FROM user";
        // $res = mysqli_query($this->con->conn, $sql) or die("Error " . mysqli_error($con->conn));

        // return $res;
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
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        if ($fn == " || $ln == " || $city == "") {
            return false;
        }
        return true;
    }

    public function createFormErrorSessions()
    {
        session_start();
        $_SESSION['form_errors'] = "All fields are required";
    }
} 
