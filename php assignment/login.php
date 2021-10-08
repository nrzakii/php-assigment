<?php
/*
* This file should display the login form. Login and authentication process should use user credentials
* from the file users.txt
*/

session_start();
include "index.php"

if(isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return data;
    }
}

$uname = validate($_POST['uname']);
$pass = validate($_POST['password']);

if(empty($uname)) {
    header ("Location: index.php?erro=User Name is required");
    exit();
}
else if(empty($pass)) {
    header ("Location: index.php?erro=Password is required");
    exit();
}

$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if($row['user_name'] === $uname && $row['password'] === $pass){
        echo "Logged In!";
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header("Location: home.php");
        exit();

    }
    else{
        header("Location: index.php?error=Incorrec User Name or Password");
        exit();
    }
}
else {
    header("Location: index.php");
    exit();
}
?>