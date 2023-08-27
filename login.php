<?php
include "components/dbconnect.php";
session_start();
$login = false;
$redalert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $already = false;
    $password = md5($password);
    $sql = "Select * from user where username = '$username' AND password = '$password'";
    // $sql = "Select * from user where username = '$username'";
    $result = mysqli_query($conn, $sql);
    // echo ($password);die;
    $num = mysqli_num_rows($result);
    // var_dump($sql);die;


    if ($num == 1) {

        $login = true;
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: welcome.php");
    }
    else {
    $redalert = true;
} 
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>

<body>
    <?php
    include "components/navbar.php";
    ?>
    <!-- ALERT -->
    <?php
    if ($login) {
        echo '
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in.
        <input type="input" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></input>
    </div>';
    }
    ?>
    <!-- RED ALERT -->
    <?php
    if ($redalert) {
        echo '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ALERT!!</strong> Invalid Credentials. 
        <input type="input" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></input>
    </div>';
    }
    ?>

    <div class="container my-4">
        <h1 class="text-center">Login</h1>
        <form action="/LoginSystem/login.php" method="post">
            <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <input type="submit" class="btn btn-primary" value="Login" name="submit">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>

</html>