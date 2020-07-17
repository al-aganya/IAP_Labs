<?php
include 'User.php'; 
 
if (isset($_POST['btn-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $instance = User::create();
    $instance->setPassword($password);
    $instance->setUsername($username);

    if ($instance->isPasswordCorrect()) {
        $instance->login();
        mysqli_close($con);
        $instance->createUserSession();
    } else {
        mysqli_close($con);
        header("Location:login.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="validate.css" rel="stylesheet">
</head>

<body>

<form name="login" id="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="container">
<table class="table table-borderless text-center">
                <thead>
                    <tr>
                        <td class="text-center">
                            <h3>Login</h3>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class='text-center'><input class="form-control" type="text" name="username"
                                placeholder="Username" id="" required></td> 
                        <td class='text-center'><input class="form-control" type="password" name="password"
                                placeholder="Password" id="" required></td>
                    </tr>
                    <tr>
                        <td class='text-center '><button class="btn btn-block btn-secondary" type="submit"
                                name="btn-login"><strong>LOGIN</strong></button></td>
                    </tr>
                </tbody>
            </table>
</form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>