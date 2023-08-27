<?php
$showw = false;
$redalert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["submit"])) {
        // var_dump($_POST["submit"]); 
        include "components/dbconnect.php";
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cnfpassword = $_POST["cnfpassword"];
        $already = false;
        
        if (($password == $cnfpassword) && $already == false) {
            $sql = "INSERT INTO `user` (`sno`, `username`, `password`, `dt`) VALUES ('', '$username', '$password', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showw = true;
            }
        } else {
            $redalert = true;
        }
    }
}
?>