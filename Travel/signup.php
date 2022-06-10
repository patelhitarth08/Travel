<?php
// session_start();
include 'connection.php';

$showAlert = false;
$showError = false;
$exists = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    }

    if (isset($_POST['username'])) {
        $user = $_POST['username'];
    }

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
    }

    if (isset($_POST['cpassword'])) {
        $cpassword = $_POST["cpassword"];
    }


    $sql = "Select * from users where username='$user'";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if ($num == 0) {
        if (($password == $cpassword) && $exists == false) {

            // $hash = password_hash($password, PASSWORD_DEFAULT);

            // Password Hashing is used here. 
            $sql = "INSERT INTO `users` (`name`, `username`, `email`, 
                `password`) VALUES ('$name', '$user', '$email', '$password')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = "Passwords do not match";
        }
    } // end if 

    if ($num > 0) {
        $exists = "Username not available";
    }

} //end if   

if ($showAlert) {

    header("Location: index.html");
}

if ($showError) {

    echo $showError;
    header("Location: index.html");
    exit;
}

if ($exists) {
    echo $exists;
    
    header("Location: index.html");
    exit;    
}
?>