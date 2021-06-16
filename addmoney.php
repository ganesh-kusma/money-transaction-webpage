<?PhP


include 'dbconnect.php';
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['loggedin'])== true ||$_SESSION['username']!==$username) {
   header("location:adminpanel.php");
}else{
$user = $amount = "";
$userErr = $amountErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["username"])) {
        $userErr = "user is required";
    } else {
       
    }
    if (empty($_POST["amount"])) {
        $amountErr = "amount is required";
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
$success=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($user == "" && $amount == "") {
        $user = $_POST['username'];
        $amount = $_POST['amount'];
        $sql = "UPDATE `login` SET uamount=uamount+$amount where username='$user'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $success=true;
            $sql = "select * from `login` where username='$user'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_assoc($result);
            $mno=$row['mno'];

            $newsql = "INSERT INTO `ledger` (`username`, `mno`, `lamount`) VALUES ( '$user', '$mno', '$amount')"; 
            $result=mysqli_query($conn,$newsql);
            if($result){
               
            }
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
    <title>Add money</title>

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
    <?Php if ($success) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Amount has been sent  </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
    } ?>
    <form style="  margin-left: 400px; margin-right: 400px;margin-top:
    125px;" action="/mt/addmoney.php" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">username</label>
            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <span class="error" style="color: red;"><?php echo "$userErr" ?> </span>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">amount</label>
            <input type="text" name="amount" class="form-control" id="exampleInputPassword1">
            <span class="error" style="color: red;"><?php echo "$amountErr" ?> </span>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
<footer>
        <div>
            <h5>
                © 2020 GK TRANSACTS. | All Rights Reserved.
            </h5>
        </div>
    </footer>
</html>