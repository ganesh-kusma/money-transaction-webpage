<?PHP

include 'dbconnect.php';
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['loggedin'])== true ||$_SESSION['username']!==$username) {
   header("location:login.php");
}
else{
$fnameErr = $lnameErr = $mnoErr = $pincodeErr = $addresErr =  $mpinErr = "";
$fname = $lname = $mno = $pincode = $addres = $mpin = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["fname"])) {
        $fnameErr = "Name is required";
    } else {
        $fname = input_data($_POST["fname"]);
        // check if name only contains letters and whitespace  
        if (!preg_match("/^[a-zA-Z ]*$/", $fname)) {
            $fnameErr = "Only alphabets are allowed";
        }
    }

    if (empty($_POST["lname"])) {
        $lnameErr = "Name is required";
    } else {
        $lname = input_data($_POST["lname"]);
        // check if name only contains letters and whitespace  
        if (!preg_match("/^[a-zA-Z ]*$/", $lname)) {
            $lnameErr = "Only alphabets are allowed";
        }
    }

    if (empty($_POST["mno"])) {
        $mnoErr = "Mobile no is required";
    } else {
        $mno = input_data($_POST["mno"]);
        // check if mobile no is well-formed  
        if (!preg_match("/^[0-9]*$/", $mno)) {
            $mnoErr = "Only numeric value is allowed.";
        }
        //check mobile no length should not be less and greator than 10  
        if (strlen($mno) != 10) {
            $mnoErr = "Mobile no must contain 10 digits.";
        }
    }

    if (empty($_POST["pincode"])) {
        $pincodeErr = "pincode is required";
    } else {
        $pincode = input_data($_POST["pincode"]);
        // check if mobile no is well-formed  
        if (!preg_match("/^[0-9]*$/", $pincode)) {
            $pincodeErr = "Only numeric value is allowed.";
        }
        //check mobile no length should not be less and greator than 10  
        if (strlen($pincode) != 6) {
            $pincodeErr = "pincode must contain 6 digits.";
        }
    }
    if (empty($_POST["addres"])) {
        $addresErr = "Address is required";
    } else {
        $addres = input_data($_POST["addres"]);
    }
    if (empty($_POST["mpin"])) {
        $mpinErr = "mpin is required";
    } else {
        $mpin = input_data($_POST["mpin"]);
        // check if mobile no is well-formed  
        if (!preg_match("/^[0-9]*$/", $mpin)) {
            $mpinErr = "Only numeric value is allowed.";
        }
        //check mobile no length should not be less and greator than 10  
        if (strlen($mpin) != 4) {
            $mpinErr = "mpin must contain 4 digits.";
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
$mcheck = false;
$reg=false;
$username = $_SESSION['username'];
$sql="select * from login where username='$username' ";
$result=mysqli_query($conn,$sql);
$row= mysqli_fetch_assoc($result);
$uamount=$row['uamount'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($fnameErr == "" && $lnameErr == "" && $mnoErr == "" && $pincodeErr == "" &&  $addresErr == "" &&  $mpinErr == "") {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mno = $_POST['mno'];
        $pincode = $_POST['pincode'];
        $mpin = $_POST['mpin'];
        $addres = $_POST['addres'];
        $otp = $_POST['otp'];

        $sql = "select * from users where mno='$mno'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $mcheck = true;
        } else {
            $sql = "select * from otp where otp='$otp'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num > 0) {
                $sql = "INSERT INTO `users` ( `fname`, `lname`, `mno`, `pincode`, `addres`, `mpin`) VALUES ( '$fname', '$lname', '$mno', '$pincode', '$addres', '$mpin')";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo "unsucess";
                } else {
                    $reg = true;
                    header("refresh:1;url=http://localhost/mt/banking.php");
                }
            } else {
                $alert = true;
            }
        }
    } else {
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
    <title>Register</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        function test() {
            $.ajax({

                url: "otp.php",
                success: function(data) {
                    alert(`you otp is ${data}`);
                }
            })
        }
    </script>

</head>

<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

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
                    <button type="button" class="hdbt btn-sm btn-dark float-right" style="margin-right:28px;"><?php echo $uamount?></button>
                </li>
            </ul>
        </div>
    </nav>
    <!--     <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
  <strong>Holy guacamole!</strong> You should check in on some of those fields below.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button> ***** -->
    <!-- </div> -->


    <?Php if ($alert) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Enter Correct OTP </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    } ?>
    <?Php if ($mcheck) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Entered Mobile No. is already regitered </strong> Please Enter New Mobile No.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    } ?>
   <?Php if ($reg) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Mobile No. is successfully registered </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    } ?>
    <div class="container cnt1">
        <form action="/mt/register.php" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstname">Firstname</label>
                    <input type="text" class="form-control" placeholder="First name"  maxlength="25"name="fname">
                    <span class="error" style="color: red;"><?php echo "$fnameErr" ?> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="lastname">Lastname</label>
                    <input type="text" class="form-control" placeholder="Last name "maxlength="25" name="lname">
                    <span class="error" style="color: red;"><?php echo "$lnameErr" ?> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="Mobile No.">Mobile No.</label>
                    <input type="text" class="form-control" placeholder="Mobile No." maxlength="10"name="mno">
                    <span class="error" style="color: red;"><?php echo "$mnoErr" ?> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="Pincode">Pincode</label>
                    <input type="text" class="form-control" placeholder="Pincode" maxlength="6"name="pincode">
                    <span class="error" style="color: red;"><?php echo "$pincodeErr" ?> </span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="addres"></textarea>
                <span class="error" style="color: red;"><?php echo "$addresErr" ?> </span>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="Mpin">Set Mpin</label>
                    <input type="password" class="form-control" placeholder="MPin"maxlength="4" name="mpin">
                    <span class="error" style="color: red;"><?php echo "$mpinErr" ?> </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="Mpin">Enter OTP</label>
                    <input type="text" class="form-control" placeholder="OTP" name="otp" maxlength="4" id="mybutton">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <button type="button" class="btn btn-black btn-md btn-block sbmt" onclick="test()" data-target="#exampleModal" data-toggle="modal" value="gotp">Generate OTP</button>
                </div>
                <div class="form-group col-md-6">
                    <button class="btn btn-black btn-md btn-block sbmt" data-target="#exampleModal" data-toggle="modal">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <footer style="position: fixed;">
        <div >
            <h5>
                © 2020 GK TRANSACTS. | All Rights Reserved.
            </h5>
        </div>
    </footer>
</body>

</html>