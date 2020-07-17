<?php
    
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location:login.php'); 
    }

    include_once "DBConnector.php";
    $con = new DBConnector();

    $username = $_SESSION['username'];

    $sql = "SELECT id FROM user WHERE username = '$username'"; 
    $res = mysqli_query($con->conn,$sql) or die("Error " .mysqli_error($con->conn));    
      
    while($row = $res->fetch_array()){
      $_SESSION['id'] = $row['id'];
    }

    function fetchUserApiKey(){
      $id = $_SESSION['id'];
      $con = new DBConnector();
      
      $sql = "SELECT api_key FROM api_keys WHERE user_id='$id'";
      $res = mysqli_query($con->conn,$sql) or die("Error " .mysqli_error($con->conn));    
      
      if ($res->num_rows <= 0) {
          return 'Please Generate an API Key';
      }else{
        while($row = $res->fetch_array()){
          $api_key = $row['api_key'];
        } 
        return $api_key;
      }
     
   } 

   
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v3.8.5">
  <title>Private Page</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/cover/"> 
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

 
  <!-- Custom styles for this template -->
  <link href="css/cover.css" rel="stylesheet">
</head>

<body class="text-center">
<nav class="navbar navbar-expand-lg navbar-light bg-light nav-link">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
      aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      
    <h3 class="masthead-brand">Key Generation Page</h3>
      <ul class="navbar-nav  ml-lg-auto">
        <li class="nav-item active">
          <a class="nav-link text-danger" href="logout.php">Logout <span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <div class="p-2 bg-secondary card-sm text-center rounded shadow-lg m-4">

    <div  class="inner cover">
      <h1 class="cover-heading">Welcome, <?= $_SESSION['username']?></h1>
      
      <p class="lead">
        <?php $feedback = fetchUserApiKey();
      echo ($feedback==='Please Generate an API Key') ? 
        '<button class="btn btn-outline-warning" id="api-key-btn">Generate API Key</button>' : 
        '<button class="btn btn-outline-warning" id="api-key-btn" disabled>API Key generated below</button>';?>
      </p>
      <br><br>
      <div class="input-group apikey m-1"> 
        <textarea id="api-key" class="form-control area-api col-6 m-auto" aria-label="With textarea">
          <?php echo fetchUserApiKey();?>
        </textarea>
      </div> 
    </div>
  </div> 
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
  </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>  
  <script src="js/apikey.js"></script>
</body>

</html>