<?php
include_once 'user.php';
include_once 'DBConnector.php';
include_once 'fileUploader.php';
$first_name = '';
$last_name = '';
$city = '';
$uname = '';
$pass = '';
$utc_timestamp = '';
$data = '';
$offset = '';


$user = new User($first_name, $last_name, $city, $uname, $pass, $data, $utc_timestamp, $offset);
$conn = new DBConnector();


if (isset($_POST['btn-save'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $utc_timestamp = $_POST['utc_timestamp'];
    $offset = $_POST['time_zone_offset'];
    $data = $_FILES['filetoUpload'];
    // die($data["name"]);

    //Creating a new user object
    $user = new User($first_name, $last_name, $city, $username, $password, $data, $utc_timestamp, $offset);
    //Create the object for File Uploader
    $uploader = new FileUploader($data);

    if (!$user->validateForm()) {
        $user->createFormErrorSessions();
        header("Refresh:0");
        return;
    } else if ($user->isUserExists($username)) {
        $user->createUsernameErrorSessions();
        header("Refresh:0");
        return;
    } else {
        $res = $user->save();
    }



    $file_upload_response = $uploader->uploadFile();


    //Check if the operation occured succesfully
    if ($res && $file_upload_response === TRUE) {
        $message = "Save Operation Was Succesful";
    } else {
        $message = "Save Operation Was Not Succesful";
    }
    $conn->closeDatabase();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lab01</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="js/validate.js"></script>

</head>

<body>
    <div class="container ">
        <div class="p-2 m-3 bg-transparent card text-center rounded shadow-lg">
            <h3 class="card-header text-center"><u>New User</u></h3>
            <form class="card-body" method="post" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?= $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">

                <div class="text-center">
                    <div id="form-errors">
                        <?php
                        session_start();
                        if (!empty($_SESSION['form_errors'])) {
                            echo " " . $_SESSION['form_errors'] . "<br/><br/>";
                            unset($_SESSION['form_errors']);
                        }
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="input-group col-6 my-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-small" id="label1">First Name</span>
                        </div>
                        <input type="text" name="first_name" id="inputEmail" class="form-control" placeholder="" aria-describedby="label1" >
                    </div>
                    <div class="input-group col-6 my-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-small" id="label2">Last Name</span>
                        </div>
                        <input type="text" name="last_name" id="inputLastname" class="form-control" placeholder="" aria-describedby="label2">
                    </div>
                </div>
                <div class="row">
                    <div class="input-group col-6 my-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-small" id="label4">Username</span>
                        </div>
                        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="" aria-describedby="label4">
                    </div>
                    <div class="input-group col-6 my-1">
                        <div class="input-group-prepend">
                            <span class="input-group-text text-small" id="label5">Password</span>
                        </div>
                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="" aria-describedby="label5">
                    </div>
                </div>
                <div class="input-group col-12 my-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-small" id="label3">City Name</span>
                    </div>
                    <input type="text" name="city_name" id="inputPassword" class="form-control" placeholder="" aria-describedby="label3">
                </div>
                <div class="form-group col-12 my-1">
                    <div class="input-group mb-2 p-2 rounded-pill bg-white border border-secondary shadow-sm">
                        <div class="input-group-prepend">
                            <label for="exampleFormControlFile1" class="btn btn-light rounded-pill text-center">
                                <i class="fas fa-user font-weight-bolder"></i> <i><small>Profile Picture</small></i>
                            </label>
                        </div>
                        <input id="exampleFormControlFile1" type="file" name="filetoUpload" class="form-control border-0">
                    </div>
                    <small class="form-text text-muted"><i><u>
                                Your file should not be larger than 5 kb.</u></i>
                    </small>
                </div>

                <button name="btn-save" id="submit" class="btn btn-block btn-outline-primary" type="submit">SAVE</button>
                <a class="btn btn-block btn-link" href="login.php" role="button">LOGIN</a>

                <input type="hidden" name="utc_timestamp" id="utc_timestamp" value="">
                <input type="hidden" name="time_zone_offset" id="time_zone_offset" value="">
            </form>
        </div>
        <div class="table-responsive">
            <div id="form-error">
                <?php
                if (isset($message)) {
                    echo
                        '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ' . $message . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    ';
                }
                ?>
            </div>
            <table class="table table-striped table-dark">
                <thead class="thead-light">
                    <tr> 
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">City Name</th>
                        <th scope="col">Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $user->readAll();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_array()) {
                            echo "<tr>"; 
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['user_city'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
</body>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>
<script src="js/timezone.js"></script>