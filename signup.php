<?php
$already = '';
$showw = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "components/dbconnect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cnfpassword = $_POST["cnfpassword"];
    $alreadysql = " Select * from user where username = '$username'";
    $result = mysqli_query($conn, $alreadysql);

    $numrows = mysqli_num_rows($result);
    if ($numrows > 0) {
        $already = 'USER ALREADY EXIST';
    } else {
        
        if ($password == $cnfpassword && $already == false) {
            $hash= md5($password);
            $sql = "INSERT INTO `user` (`sno`, `username`, `password`, `dt`) VALUES ('', '$username', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            // var_dump($result);die;
            if ($result) {

                $showw = 'Your account have been created.';
            }
        } 
        else {
            $already = 'password mismatched';
        }
    }
}




?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

</head>

<body>
    <?php
    include "components/navbar.php";
    ?>
    <!-- ALERT -->
    <?php if ($showw) { ?>
        
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> <?php echo $showw ?>
        <input type="input" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></input>
    </div>;
    <?php }  ?>

    <!-- RED ALERT -->

    <?php if ($already) { ?>
        
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>ALERT!!</strong> <?php echo $already  ?>
        <input type="input" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></input>
    </div>;
    <?php }  ?>
    



    <div class="container my-4">
        <h1 class="text-center">Sign Up</h1>
        <form action="/LoginSystem/signup.php" method="post">
            <div class="mb-3">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="cnfpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cnfpassword" name="cnfpassword">
            </div>

            <input type="submit" class="btn btn-primary" value="Signup" name="submit">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
</body>

</html>