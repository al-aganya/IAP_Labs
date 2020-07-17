<?php
    session_start();
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    include_once "DBConnector.php";
    

     if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
       //Prevent url access
       header('HTTP/1.0 403 Forbidden');
       echo 'You are forbidden';
     }else{
       $api_key = null;
       //Generate API key
       $api_key = generateApiKey(64);
       header('Content-type: application/json');
       
       echo generateResponse($api_key);
     }
     
     
      function generateApiKey($str_length){
        
       $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
       
       $bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);
       
       $repl = unpack('C2',$bytes);
 
       $first = $chars[$repl[1]%62];
       $second = $chars[$repl[2]%62];
       return strtr(substr(base64_encode($bytes), 0 ,$str_length), '+/' , "$first$second");
     }
 
     function saveApiKey($api_key){
       //Saves current API key
       $con = new DBConnector();
       $id = $_SESSION['id'];
        $sql = "INSERT INTO api_keys(user_id,api_key) VALUES('$id','$api_key')";
        $res = mysqli_query($con->conn,$sql) or die("Error " .mysqli_error($con->conn));    
        
        return $res;
     }
 
 
     function generateResponse($api_key){
       if(saveApiKey($api_key) === TRUE){
         $res = ['success'=> 1, 'message'=> $api_key];
       }else{
         $res = ['success' => 0, 'message'=> "Something went wrong. Please regenerate the API"];
       }
       return json_encode($res);
     }
