<?php 
$alert=false;
include 'dbconnect.php';
session_start();
$username=$_SESSION['username'];
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $npass=$_POST['npass'];
    $ncpass=$_POST['ncpass'];
    if($npass==$ncpass){
        $sql="UPDATE `login` SET `password`='$npass' where username='$username'";
        $result=mysqli_query($conn,$sql);
        if($result){
            $alert=true;
            header("refresh:1;url=http://localhost/mt/login.php");
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles.css">

    <title>money transfer</title>
</head>

<body>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
        
    <div class="sidenav">
        <div class="login-main-text">
            <h2>GK Transacts</h2>
            <p> Make your transactions hassle free and safe

            </p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
            <?Php if ($alert) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Your password has been changed sucessfully </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                        } ?>
                <form action="\mt\newpass.php" method="post" >
                    <div class="form-group">
                        <label>Enter New password</label>
                        <input type="password" name="npass" class="form-control" placeholder="Enter New password">
                    </div>
                    <div class="form-group">
                        <label>Re-enter Password</label>
                        <input type="password" name="ncpass" class="form-control" placeholder="Re-enter Password">
                    </div>
                    

                    <button type="submit" class="btn btn-black btn-lg btn-block">Submit</button>
                    <br><br>
                    <p>Terms of Use Privacy Policy</p>
                    <P>© 2020 GK TRANSACTS. | All Rights Reserved.</p>

                </form>
            </div>
        </div>

    </div>

</body>

</html>