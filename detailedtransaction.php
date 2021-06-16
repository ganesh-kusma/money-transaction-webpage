<?php

include 'dbconnect.php';
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['loggedin']) == true || $_SESSION['username'] !== $username) {
    header("location:login.php");
}
else{


$sql="select * from login where username='$username' ";
$result=mysqli_query($conn,$sql);
$row= mysqli_fetch_assoc($result);
$uamount=$row['uamount'];


$sql = "select * from txns where id=1";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if ($num > 0) {
    $row = mysqli_fetch_assoc($result);
    $txnid = $row['txnid'];
    $bname = $row['bname'];
    $bank = $row['bank'];
    $accno = $row['accno'];
    $amount = $row['amount'];
    $date = $row['date'];
}

}
?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Detail ledger</title>

</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="Register.php">REGISTER <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="Banking.php">BANKING <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Transaction & more
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="detailedtransaction.php">Detailed Transactions</a>
                        <a class="dropdown-item" href="detailedledger.php">Total ledger</a>
                        <a class="dropdown-item" href="logout.php">logout</a>
                    </div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link gk" href="mainpage.php">Gk Transacts <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

            <li>
                    <button type="button" class="hdbt btn-sm btn-dark float-right" style="margin-right:28px;"><?PHP echo $username ?></button>
                </li>
                <li>
                    <button type="button" class="hdbt btn-sm btn-dark float-right" style="margin-right:28px;"><?php echo $uamount ?></button>
                </li>
            </ul>
        </div>
    </nav>

    <table class="table">
        <thead class="thead-dark" style="position: sticky;">
            <tr>
                <th scope="col">sno.</th>
                <th scope="col">txn id</th>
                <th scope="col">Bene Name</th>
                <th scope="col">Bank</th>
                <th scope="col">Account Number</th>
                <th scope="col">Amount</th>

                <th scope="col">Date & time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'dbconnect.php';

            $sql = "select * from txns";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {

                $sno = $row['id'];
                $txnid = $row['txnid'];
                $bname = $row['bname'];
                $bank = $row['bank'];
                $accno = $row['accno'];
                $amount = $row['amount'];
                $date = $row['date'];


                echo ' <tr>
                <th scope="row">' . $sno . '</th>
                <th scope="row">' . $txnid . '</th>
                <td>' . $bname . '</td>
                <td>' . $bank . '</td>
                <td>' . $accno . '</td>
                <td>' . $amount . '</td>
                <td>' . $date . '</td>

            </tr>';
            }
            ?>
        </tbody>
    </table>
    <br><br>
    <footer style="position: unset;">
        <div >
            <h5>
                © 2020 GK TRANSACTS. | All Rights Reserved.
            </h5>
        </div>
    </footer>
</body>
</html>