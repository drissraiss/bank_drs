<?php
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
    <form action="createacc.php" method="post" autocomplete="off">
        <table class="table w-50 m-auto mt-5">
            <tr>
                <th>Full name</th>
                <td><input class="w-100" required type="text" name="fullname"></td>
            </tr>
            <tr>
                <th>Username</th>
                <td><input class="w-100" required type="text" name="username"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input class="w-100" required type="password" name="password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" class="btn btn-success w-100" value="Create">
                    <a class="text-center d-block" href="login.php">I already have an account</a>
                </td>
            </tr>
        </table>
    </form>
    <a href="../" class="text-center d-block mt-3 display-6 text-decoration-none fw-bold"> < Home</a>
    
    <div style="display: none;">
    <script>
        const removeAlert = () => document.getElementById('alertBANK').remove();
        setInterval(removeAlert, 3000)
    </script>
</body>

</html>