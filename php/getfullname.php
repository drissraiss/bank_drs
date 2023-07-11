<?php
include_once "connect.php";
$iduser = $_GET['iduser'];

$req = "SELECT fullname FROM compts WHERE id='$iduser' LIMIT 1";
$query = mysqli_query($connect, $req);
if (mysqli_num_rows($query)) echo mysqli_fetch_column($query);
else echo "Not Found";
?>