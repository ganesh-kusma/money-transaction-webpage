<?PhP


include 'dbconnect.php';
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['loggedin']) == true || $_SESSION['username'] !== $username) {
    header("location:adminpanel.php");
} else {
} ?>

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
    <title>Admin index</title>

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
                    <a class="nav-link" href="addmoney.php">ADD MONEY <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="adduser.php">ADD USER <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="addlogout.php">LOGOUT <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link gk" href="adminindex.php" style="margin-left: 387px;"> Gk Transacts <span class="sr-only">(current)</span></a>
                </li>
            </ul>

        </div>
    </nav>


    <div class="container " style="margin-top:115px">
        <div class="text-center pb-lg-4">
            <h2 class="mb-5">Secured and Simpler </h2>
        </div>
        <div class="row">
            <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                <div class="px-0 px-lg-3">
                    <div class="icon-rounded bg-primary-light mb-3">
                        <img src="photos/mobilelogo.svg" class="icons" alt="" style="margin-top: 88px;">
                    </div>
                    <h3 class="h5">Register your Mobile No.</h3>
                    <p class="text-muted">Firstly, you have to register your Mobile No. for further steps </p>
                </div>
            </div>
            <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                <div class="px-0 px-lg-3">
                    <div class="icon-rounded bg-primary-light mb-3">
                        <img src="photos/bank.svg" class="icons" id="bank" alt="" style="margin-top: 88px;">
                    </div>
                    <h3 class="h5">Add Your Account details</h3>
                    <p class="text-muted">Make sure you add correct details of the beneficiary </p>
                </div>
            </div>

            <div class="col-lg-4 mb-3 mb-lg-0 text-center">
                <div class="px-0 px-lg-3">
                    <div class="icon-rounded bg-primary-light mb-3">
                        <img src="photos/transaction.svg" class="icons" alt="" style="margin-top: 88px;">
                    </div>
                    <h3 class="h5">Check The Transactions </h3>
                    <p class="text-muted">Check, your transactions to know more about it </p>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div>
            <h5>
                ?? 2020 GK TRANSACTS. | All Rights Reserved.
            </h5>
        </div>
    </footer>
</body>

</html>