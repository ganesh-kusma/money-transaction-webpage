<?php
$alert = false;
$nalert = false;
include 'dbconnect.php';
include 'otp.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $mno = $_POST['mno'];
    session_start();
    $_SESSION['username']=$username;
    $sql = "select * from login where username='$username' AND mno='$mno'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        $alert = true;
        header("refresh:5;url=http://localhost/mt/fotp.php");
    } else {
        $nalert = true;
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
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
        function test() {
            $.ajax({

                url: "otp.php",
                success: function(data) {
                    alert(`you otp is ${data}`);
                }
            })
        }
    </script> -->

    <title>Forgot password page</title>
</head>

<body>

    <body>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

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
                    <form action="\mt\forgotpassword.php" method="post">
                        <?Php if ($alert) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Your otp is ' . $otp . ' </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                        } ?>
                        <?Php if ($nalert) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Enter correct details </strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                        } ?>
                        <div class="form-group">
                            <label>User Name</label>
                            <input type="text" name="username" class="form-control" placeholder="User Name">
                        </div>
                        <div class="form-group">
                            <label>Mobile No.</label>
                            <input type="text" name="mno" maxlength="10" class="form-control" placeholder="Mobile No.">
                        </div>


                        <button type="submit" class="btn btn-black btn-lg btn-block" data-target="#exampleModal" data-toggle="modal">Submit</button>


                    </form>
                    <p>Terms of Use Privacy Policy</p>
                    <P>© 2020 GK TRANSACTS. | All Rights Reserved.</p>

                    </form>
                </div>
            </div>

        </div>

    </body>

</html>