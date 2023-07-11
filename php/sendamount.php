<?php
session_start();
include_once "connect.php";
$id = $_SESSION['id'];
$idreceiver = $_POST['idreceiver'];
$amount = (int) $_POST['amount'];

if ($amount < 0){
    header("location:home.php?alert=1&bg=danger&type=Errorg&msg=Sorry, negative amount cannot be sent :>");
}
elseif (!mysqli_fetch_column(mysqli_query($connect, "SELECT balance>=$amount FROM compts WHERE id='$id'"))) {
    header("location:home.php?alert=1&bg=danger&type=Errorg&msg=Sorry, your balance is insufficient for this transfer :(");
} else {
    $req_deduction = "UPDATE compts SET balance=balance-$amount WHERE id='$id'";
    $req_add_amount_to_other_account = "UPDATE compts SET balance=balance+$amount WHERE id='$idreceiver'";

    mysqli_query($connect, "START TRANSACTION");
    mysqli_query($connect, $req_deduction);
    $result1 = mysqli_affected_rows($connect);
    mysqli_query($connect, $req_add_amount_to_other_account);
    $result2 = mysqli_affected_rows($connect);

    if ($result1 and $result2) {
        mysqli_query($connect, "COMMIT");
        header("location:home.php?alert=1&bg=success&type=success&msg=The amount has been transferred successfully");
    } else {
        mysqli_query($connect, "ROLLBACK");
        header("location:home.php?alert=1&bg=warning&type=Warning&msg=Sorry, this account does not exist!!");
    }
}
