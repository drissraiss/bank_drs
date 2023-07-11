<?php session_start();
if (!isset($_SESSION['id'])) {
    header("location:../");
}
include_once "connect.php";
function getFullName($id)
{
    $req = "SELECT fullname FROM compts WHERE id='$id'";
    $result = mysqli_query($GLOBALS['connect'], $req);
    return mysqli_fetch_column($result);
}
function getUserName($id)
{
    $req = "SELECT username FROM compts WHERE id='$id'";
    $result = mysqli_query($GLOBALS['connect'], $req);
    return mysqli_fetch_column($result);
}
function getBalance($id)
{
    $req = "SELECT balance FROM compts WHERE id='$id'";
    $result = mysqli_query($GLOBALS['connect'], $req);
    return mysqli_fetch_column($result);
}

function alert($bg, $type, $msg)
{
    echo ("<div id='alertBANK' class='bg-$bg ?> text-white text-center p-1 w-100' style='position: fixed;opacity:.9'><p class='fs-4 container'><strong>$type : </strong>$msg<span onclick='removeAlert()' class='fw-bold me-5' style='float: right;margin:auto; cursor:pointer'>X</span></p></div>");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BANK DRS</title>
    <link rel="icon" type="image/icon" href="../png/bank.png">
    <link rel="stylesheet" href="../css/bootstrap.css">
</head>

<body>
    <?php if (isset($_GET['alert'])) alert($_GET['bg'], $_GET['type'], $_GET['msg']) ?>
    <h1 class="bg-primary text-white text-center p-3">BANK DRS</h1>

    <div class="container">
        <a href="logout.php" class="btn btn-outline-danger w-100 mb-4">Log out</a>
        <h2>My account</h2>
        <table class="table table-hover border bg-light">
            <tr>
                <th>ID</th>
                <td><?php echo $_SESSION['id'] ?></td>
            </tr>
            <tr>
                <th>FULL NAME</th>
                <td><?php echo getFullName($_SESSION['id']) ?></td>
            </tr>
            <tr>
                <th>USER NAME</th>
                <td><?php echo getUserName($_SESSION['id']) ?></td>
            </tr>
            <tr>
                <th>BALANCE</th>
                <td><?php echo getBalance($_SESSION['id']) . ' DH' ?></td>
            </tr>
        </table>
        <hr>
        <h2>Send an amount</h2>
        <form action="sendamount.php" method="post">
            <table class="table border bg-light">
                <tr>
                    <th>ID Receiver : </th>
                    <td><input class="w-100" required id="iduser" name="idreceiver" type="text"></td>
                    <td><input type="text" disabled id="nameuser" class="bg-white"></td>
                    <th>Amount : </th>
                    <td><input class="w-75" required type="number" name="amount" ?> DH</td>
                </tr>
                <tr>
                    <td colspan="5"><input type="submit" value="Send" class="btn btn-success w-100"></td>
                </tr>
            </table>
        </form>
    </div>
    <div style="display: none;">
    <script>
            const removeAlert = () => {
                try {document.getElementById('alertBANK').remove();}
                catch {}
            }
            setInterval(removeAlert, 3000)            
        
        const iduser = document.getElementById('iduser');
        const nameuser = document.getElementById('nameuser');
        iduser.onchange = () => {
            if (!document.getElementById('iduser').value.trim().length) return 
            let request1 = new XMLHttpRequest();
            request1.open('GET', `getfullname.php?iduser=${iduser.value}`, true);
            request1.send();
            request1.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200){
                    nameuser.value = this.responseText;
                }
            }
            
        }
    </script>
</body>

</html>