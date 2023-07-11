<?php
//error_reporting(0);
include_once "connect.php";

function randomID()
{
    $letters = "AZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
    $result = "";
    for ($i = 0; $i < 20; $i++) {
        $result .= $letters[rand(0, 35)];
    }
    return $result;
}
$fullname = $_POST['fullname'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$id = randomID();

$req = "INSERT INTO compts values ('$id', '$fullname', '$username', '$password','0')";


try {
    mysqli_query($connect, $req);
    header("location:login.php?alert=1&bg=success&type=Sucess&msg=Account successfully created");
} catch (Exception $e) {
    header("location:signup.php?alert=1&bg=danger&type=Error&msg=This account already exists");
}
