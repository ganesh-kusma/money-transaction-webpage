<?PHP

include 'dbconnect.php';
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['loggedin'])== true ||$_SESSION['username']!==$username) {
   header("location:login.php");
}
else{
$mnoErr = "";
$mno = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

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
     
}
else{

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
$username = $_SESSION['username'];
$cmno = false;
$sql="select * from login where username='$username' ";
$result=mysqli_query($conn,$sql);
$row= mysqli_fetch_assoc($result);
$uamount=$row['uamount'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($mnoErr == "") {
        $mno = $_POST['mno'];
        $sql = "select * from users where mno= '$mno' ";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            session_start();
                    $_SESSION['mno']=$mno;
                   header("location:listbene.php");
            
        } else {
            $cmno=true;
        }
    }
}
else{
   
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
    <title>Banking</title>

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
                    <button type="button" class="hdbt btn-sm btn-dark float-right" style="margin-right:28px;"><?php echo $uamount?></button>
                </li>
            </ul>
        </div>
    </nav>
    <?Php if ($cmno) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>The enter Mobile No. is not registered. </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    } ?>

    <div class="container my-4 ">
        <form action="/mt/Banking.php" method="POST">
            <div class="form-group bnk">
                <label for="exampleInputEmail1">Mobile No.</label>
                <input type="text" name="mno" maxlength="10" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <span class="error" style="color: red;"><?php echo "$mnoErr" ?> </span>
                <br>
                <button type="submit" class="btn btn-black btn-lg btn-block">Submit</button>
        </form>
    </div>
    
</body>
<footer style="position: fixed;">
        <div >
            <h5>
                © 2020 GK TRANSACTS. | All Rights Reserved.
            </h5>
        </div>
    </footer>
</html>