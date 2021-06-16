<?php
include 'dbconnect.php';
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['loggedin'])== true ||$_SESSION['username']!==$username) {
   header("location:login.php");
}
// else if(!isset($_SESSION['mno'])){
// header("location:banking.php");
// }
else{
$bankErr = $bnameErr = $baccErr = "";
$bank = $bname = $bacc = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["bank"])) {
        $bankErr = "Select a bank from the list";
    } else {

        $bank = input_data($_POST["bank"]);
        // check if name only contains letters and whitespace  
        if (preg_match("/Select Bank/i", $bank)) {
            $bankErr = "Select correct Bank";
        }
    }

    if (empty($_POST["bname"])) {
        $bnameErr = "Name is required";
    } else {
        $bname = input_data($_POST["bname"]);
        // check if name only contains letters and whitespace  
        if (!preg_match("/^[a-zA-Z ]*$/", $bname)) {
            $bnameErr = "Only alphabets are allowed";
        }
    }

    if (empty($_POST["bacc"])) {
        $baccErr = "Account no. is required";
    } else {
        $bacc = input_data($_POST["bacc"]);
        // check if mobile no is well-formed  
        if (!preg_match("/^[0-9]*$/", $bacc)) {
            $baccErr = "Only numeric value is allowed.";
        } else {
        }
    }
}


}
function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>


<?php
include 'dbconnect.php';
$alert = false;
$show = false;
$cmno = false;
$correct = false;

$username = $_SESSION['username'];

$sql = "select * from login where username='$username' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$uamount = $row['uamount'];


$mno = $_SESSION['mno'];


$sql = "select * from users where mno='$mno'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if ($num > 0) {
    $row = mysqli_fetch_assoc($result);
    $fname = $row['fname'];
    $mno = $row['mno'];
  
} else {
}
$sql = "select * from beneficiary where mno='$mno' ";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if ($num > 0) {
    $alert = true;
    $show = true;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($bankErr == "" && $bnameErr == "" && $baccErr == "") {
        $bank = $_POST['bank'];
        $bname = $_POST['bname'];
        $bacc = $_POST['bacc'];
        $bcacc = $_POST['bcacc'];
        $sql = "select * from beneficiary where bacc='$bacc'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $correct = true;
        } else if ($bacc == $bcacc) {
            $sql = "INSERT INTO beneficiary ( mno,bank, bname, bacc) VALUES (  $mno,'$bank', '$bname', '$bacc') ";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "unsucess";
            } else {
            }
        } else {
            $cmno = true;
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
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>Beneficiary list</title>

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
                        <a class="dropdown-item" href="logout.php">Logout</a>
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
    <!-- <?php if ($changeamt) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> Please enter amount less than main balance   </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            } ?> -->

    <?php if ($correct) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> Please enter new Account No.   </strong> the Account No. is already registered 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    } ?>
    <?php if ($cmno) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Please enter same account no. in Confirm Account No.*  </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    } ?>
    <div class="container">

        <ul class="heads my-4">
            <li>Name</li>
            <li>Mobile No.</li>
            <!-- <li>Month limit</li> -->
        </ul>
        <ul class="details">
            <li>
                <i class="fa fa-user">
                </i>
                <?php echo $fname ?></li>
            <li>
                <i class="fa fa-mobile"></i> <?php echo $mno ?> </li>
            <!-- <li>
                <i class="fa fa-inr"></i> <?php echo $amount ?></li> -->
        </ul>
    </div>

    <div class="container">
        <div class="row R1">
            <div class="head1 ">
                Register Beneficiary
            </div>
        </div>
        <form action="/mt/listbene.php" method="POST">
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Select Type*:</label>
                    <select class="form-control">
                        <option>IMPS</option>
                    </select>
                    <span>

                    </span>
                </div>
            </div>
    </div>

    <div class="container">
        <div class="col-sm-4">
            <div class="form-group">
                <label>Select Bank*: <?PHP echo '<span class="error" style="color: red;">' . $bankErr . ' </span>'; ?> </label>
                <select class="form-control" name="bank">
                    <option>Select Bank</option>
                    <option>SBI</option>
                    <option>HDFC</option>
                </select>

            </div>
        </div>

        <div class="col-sm-4 ">
            <div class="form-group">
                <label>Enter Beneficicary Name*: <?PHP echo '<span class="error" style="color: red;">' . $bnameErr . ' </span>'; ?></label>
                <input class="form-control" type="text" name="bname" maxlength="25" placeholder="Enter Beneficicary Name">

            </div>
        </div>

        <div class="col-sm-4  ">
            <label>Account No.*: <?PHP echo '<span class="error" style="color: red;">' . $baccErr . ' </span>'; ?></label>
            <input class="form-control" name="bacc" type="text"  maxlength="20"placeholder="Enter Account No.">

        </div>
        <div class="col-sm-4 ">
            <label>Confirm Account No.*:</label>
            <input class="form-control" type="text" name="bcacc" maxlength="20"placeholder="Enter Confirm Account No.">
        </div>
        <div class="col-sm-4">
            <label><br><br></label>
            <button class="btn btn-md btn-danger" style="margin-bottom:-28px;" type="submit">Register
                Beneficiary</button>
            <br><br>
        </div>
    </div>
    </form>

    <?PHP
    if ($alert) {
        echo '<div class="container">
    <ul class="bn_details" style="margin-top: 240px;color:white;">
        <li>Bene Name</li>
        <li>Bank</li>
        <li>A/C Number</li>
        <li>Process</li>
    </ul>
</div>';
    }
    ?>


    <div class="container">
        <div class="row stack ">
            <?PHP
            function send_mny($id)
            {
                session_start();
                $_SESSION['id'] = $id;
                header("location: transfer.php");
            }
            $sql = "select * from beneficiary where mno='$mno' ";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                $sql = "select * from beneficiary where mno='$mno' ";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    $name = $row['bname'];
                    $bank = $row['bank'];
                    $acc = $row['bacc'];
                    $id = $row['id'];
                    echo '<div class="col-sm-3  lbl ">
                ' . $name . '
            </div>
            <div class="col-sm-3  lbl">
                ' . $bank . '
            </div>
            <div class="col-sm-3 lbl ">' . $acc . '
            </div>
            <div class="col-sm-3 " > 
                <form action=\'/mt/transfer.php\' method="POST">
                                <input type="text" name="newamt"  maxlength="5" class="sbmttxt">
                                <input type="hidden" name="type" value="list">
                <input type="hidden" value=' . $id . ' name="id"> 
                            <button type="submit" class="amt" >
                    <i class="fa fa-caret-right" ></i>
                </button></form>
                <br>
                <br>
            </div>
            ';
                }
            }
            ?>

    <footer style="position: fixed;">
        <div >
            <h5>
                © 2020 GK TRANSACTS. | All Rights Reserved.
            </h5>
        </div>
    </footer>
</body>