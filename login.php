<?php
$alert=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    
    $username=$_POST["username"];
    $password=$_POST["password"];

    $sql ="select * from login where username='$username' AND password='$password'";
    $result= mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);
    if($num >0){
        
        session_start();
        $_SESSION['loggedin']=true;
        $_SESSION['username']=$username;
        header("location:mainpage.php");
    echo "true";
    }
    else{
        $alert=true;
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

    <title>money transfer</title>
</head>

<body>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    ">
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
                <form action="/mt/login.php" method="POST">
                    <div class="form-group">
                        <?php
                    if ($alert){  
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Invalid username or password </strong> Enter correct login details
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';}
                      ?>
                        <label>User Name</label>
                        <input type="text" class="form-control" placeholder="User Name" name="username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="forgotpass">
                        <label><a href="forgotpassword.php">forgot password?</a></label>
                    </div>

                    <button type="submit" class="btn btn-black btn-lg btn-block">Login</button>
                    <br><br>
                    <p>Terms of Use Privacy Policy</p>
                    <P>© 2020 GK TRANSACTS. | All Rights Reserved.</p>

                </form>
            </div>
        </div>

    </div>

</body>

</html>