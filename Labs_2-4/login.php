<?php
    include_once 'DBConnector.php';
    include_once 'user.php';

    // $conn = new DBConnector();
    if (isset($_POST['btn-login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $instance = User::create();
        $instance->setPassword($password);
        $instance->setUsername($username);

        if ($instance->isPasswordCorrect($username,$password)) {
            
            $instance->login();
            // $conn->closeDatabase();
            $instance->createUserSession($username);
        }
        // }else{
        //     $conn->closeDatabase();
        //     header('location:login.php');
        // }
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
  <title>Signin</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body class="text-center">
  <div class="container">
    <form class="form-signin" method="POST" name="login" id="login" action="<?= $_SERVER['PHP_SELF']?>">
      <div class="p-2 bg-secondary card-sm text-center rounded shadow-lg m-4">

        <h3>Login</h3>


        <div class="row py-4">
          <div class="input-group col-6 my-1">
            <div class="input-group-prepend">
              <span class="input-group-text text-small" id="label4">Username</span>
            </div>
            <input type="text" name="username" id="username" class="form-control" placeholder=""
              aria-describedby="label4">
          </div>
          <div class="input-group col-6 my-1">
            <div class="input-group-prepend">
              <span class="input-group-text text-small" id="label5">Password</span>
            </div>
            <input type="password" name="password" id="password" class="validate form-control" placeholder=""
              aria-describedby="label5">
          </div>
        </div>
        <button name="btn-login" type="submit" class="btn btn-primary">Sign in</button>
      </div>
    </form>
  </div>
  </script>

</body>

</html>