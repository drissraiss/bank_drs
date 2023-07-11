<?php
include_once "connect.php";
session_start();
$username = $_POST['username'];
$password = md5($_POST['password']);
$req = "SELECT * FROM compts WHERE username='$username' AND password='$password'";

$result = mysqli_query ($connect, $req);
if (mysqli_num_rows($result)){
    $_SESSION['id'] = mysqli_fetch_assoc($result)['id'];
    header("location:home.php");
}else{
    header("location:login.php?alert=1&bg=danger&type=Error&msg=This account Not exists !!!");
}
?>