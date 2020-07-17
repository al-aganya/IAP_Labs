<?php
include "DBConnector.php";
include "Crud.php";

class User extends Dbh implements Crud
{
    private $user_id;
    private $first_name;
    private $last_name;
    private $city_name;

    // We can use our constructor to initialize our values
    // member variables cannot be instantiated from elsewhere; They private;
    function __construct($first_name, $last_name, $city_name)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->city_name = $city_name;
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

    public function save()
    {
        $fn = $this->first_name;
        $ln = $this->last_name;
        $city = $this->city_name;
        $sql = "INSERT INTO user(first_name,last_name,user_city)
                     VALUES('$fn','$ln','$city');";
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
} 
