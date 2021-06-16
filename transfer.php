<?php
include 'dbconnect.php';
session_start();
$username = $_SESSION['username'];

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if (!isset($_SESSION['loggedin']) == true || $_SESSION['username'] !== $username) {
    header("location:login.php");
}
// // else if(!isset($amount)){
// //     header("location:listbene.php");
// // }
else {

    $incoamt = false;
    $amount = input_data($_POST["newamt"]);
    if (!preg_match("/^[0-9]*$/", $amount)) {
        $incoamt = true;
    } else if (empty($_POST["newamt"])) {
        $incoamt = true;
    }



    $alert = false;
    $checkamt = false;
    $suces = false;

    $sql = "select * from login where username='$username' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $uamount = $row['uamount'];
    $row = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sql = "select * from beneficiary where id='$_POST[id]'";

        $result = mysqli_query($conn, $sql);
        $num = mysqli_fetch_assoc($result);
        if ($num > 0) {

            $sql = "select * from beneficiary where id='$_POST[id]'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $name = $row['bname'];
            $bank = $row['bank'];
            $bacc = $row['bacc'];
            $mno = $row['mno'];
        }


        if ($_POST['type'] == 'list') {
            // $_POST['id']=$id;
            $sql = "select * from beneficiary where id='$_POST[id]'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_fetch_assoc($result);
            if ($num > 0) {

                $sql = "select * from beneficiary where id='$_POST[id]'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $name = $row['bname'];
                $bank = $row['bank'];
                $bacc = $row['bacc'];
                $mno = $row['mno'];
                $amount = $_POST['newamt'];
            }
        } else if ($_POST['mpin'] && $_POST['type'] == 'transfer') {

            $sql = "select * from beneficiary where id='$_POST[id]'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $name = $row['bname'];
            $bank = $row['bank'];
            $bacc = $row['bacc'];
            $mno = $row['mno'];

            $newsql = "select * from users where mpin='$_POST[mpin]'";
            $result = mysqli_query($conn, $newsql);
            $num = mysqli_num_rows($result);
            $amount = $_POST['newamt'];
            if ($amount > $uamount) {
                $checkamt = true;
                header("refresh:1;url=http://localhost/mt/listbene.php");
            } else if ($num > 0) {
                $sql = "UPDATE beneficiary SET amount=amount+$amount where id=$_POST[id]";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $sql = "UPDATE `login` SET uamount=uamount-$amount where username='$username' ";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {


                        function random_strings($length_of_string)
                        {

                            // String of all alphanumeric character 
                            $str_result = '0123456789gks';

                            // Shufle the $str_result and returns substring 
                            // of specified length 
                            return substr(
                                str_shuffle($str_result),
                                0,
                                $length_of_string
                            );
                        }
                    }

                    $txnid = random_strings(10);

                    $newsql = "select * from txns where txnid='$txnid'";
                    $result = mysqli_query($conn, $newsql);
                    $num = mysqli_num_rows($result);
                    if ($num > 0) {
                        $txnid = random_strings(10);
                    } else {

                        $sqlnew = "INSERT INTO txns ( txnid, bname, bank, accno, amount ) VALUES ( '$txnid', '$name', '$bank', '$bacc', '$amount')";
                        $result = mysqli_query($conn, $sqlnew);
                        if ($result) {
                            $suces = true;
                            header("refresh:1;url=http://localhost/mt/detailedtransaction.php");
                        }
                    }
                }
            }
            // $id = $_POST['id'];
            // $sql = "select * from beneficiary where id='$id'";
            // $result = mysqli_query($conn, $sql);
            // $num = mysqli_fetch_assoc($result);
            // if ($num > 0) {

            //     $sql = "select * from beneficiary where id='$id'";
            //     $result = mysqli_query($conn, $sql);
            //     $row = mysqli_fetch_assoc($result); 
            //     $name = $row['bname'];
            //     $bank = $row['bank'];
            //     $bacc = $row['bacc'];
            // }
        } else if (!$_POST['mpin']) {

            $alert = true;
        }
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
    <title>transfer</title>

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


    <?Php if ($checkamt) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Enter less or equal amount than main balance </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    } ?>
    <?Php if ($suces) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Transaction is successful </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    } ?>
    <?Php if ($alert) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Enter Correct Mpin </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    } ?>
    <?Php if ($incoamt) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Enter Correct Amount </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
        header("refresh:1;url=http://localhost/mt/listbene.php");
    } ?>

    <form action="/mt/transfer.php" method="post">
        <div class="container border
col-6 align-self-center" style="margin-top: 40px;">
            <div class="row transfer">
                <div class="col-sm-6">
                    Beneficiary Name :
                </div>

                <div class="col-sm-6">
                    <?php echo $name ?>
                </div>
                <div class="col-sm-6 my-2">
                    Bank Name :
                </div>

                <div class="col-sm-6 my-2">
                    <?php echo $bank ?>
                </div>
                <div class="col-sm-6 my-2">
                    Account No. :
                </div>

                <div class="col-sm-6 my-2">
                    <?php echo $bacc ?>
                </div>

                <div class="col-sm-6 my-2">
                    Amount :
                </div>
                <?php
                echo '<input type=\'hidden\' name=newamt value=' . $_POST['newamt'] . '>';
                ?>
                <input type="hidden" name="type" value="transfer">
                <div class="col-sm-6 my-2">
                    <?php echo $_POST['newamt'] ?>
                </div>



                <div class="col-sm-6 my-2">
                    Transaction Type :
                </div>

                <div class="col-sm-6 my-2">
                    IMPS
                </div>


                <div class="col-sm-6 my-2">
                    Enter Mpin
                </div>

                <div class="col-sm-6 my-2">
                    <input type="password" name="mpin">

                </div>

                <div class="col-sm-6 my-2">
                    <input type="hidden" name="id" value=<?php echo $_POST['id'] ?>>
                </div>
                <div class="col-sm-4 my-2">

                    <button type="submit" class="btn btn-black btn-md btn-block ">
                        submit
                    </button>
                </div>
            </div>
        </div>
    </form>
    <footer style="position: fixed;">
        <div>
            <h5>
                © 2020 GK TRANSACTS. | All Rights Reserved.
            </h5>
        </div>
    </footer>
</body>