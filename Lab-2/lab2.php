<?php
include 'User.php';

if (isset($_POST['btn-save'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city_name = $_POST['city_name'];

    $user = new User($first_name, $last_name, $city_name);
    $res = $user->save();

    if ($res === TRUE) {
        header("Location: lab1.php");
    } else {
        echo "<pre class='text-danger'>Error adding User</pre>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="validate.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <div class="container">
        <form name="user_details" id="user_details" onsubmit="return validateForm()" method="post" action="<? $_SERVER['PHP_SELF'] ?>" >
            <table class="table table table-borderless">
                <thead>
                    <th class="text-center">
                        <h3>Insert Form</h3>
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td class='text-center'><input class="form-control" type="text" name="first_name" required placeholder="First Name" id=""></td>
                    </tr>
                    <tr>
                        <td class='text-center'><input class="form-control" type="text" name="last_name" placeholder="Last Name" id=""></td>
                    </tr>
                    <tr>
                        <td class='text-center'><input class="form-control" type="text" name="city_name" placeholder="City" id=""></td>
                    </tr>
                    <tr>
                        <td class='text-center'><button class="btn btn-block btn-secondary" type="submit" name="btn-save"><strong>SAVE</strong></button></td>
                    </tr>
                </tbody>
            </table>
        </form>

        <table class="table table-sm table-dark table-bordered">
            <thead class="text-primary">
                <tr>
                    <th class="text-center">
                        First Name
                    </th>
                    <th class="text-center">
                        Last Name
                    </th>
                    <th class="text-center">
                        City of residence
                    </th>
                <tr>
            </thead>
            <tbody>
                <?php
                $a = "";
                $b = "";
                $c = "";
                $user = new User($a, $b, $c);
                $datas = $user->readAll();
                foreach ($datas as $data) {
                    echo "<tr><td class='text-center'>" . $data["first_name"] . "</td><td class='text-center'>" . $data["last_name"] . "</td><td class='text-center'>" . $data["user_city"] . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>