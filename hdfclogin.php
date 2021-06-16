<?php
$alert = false;
$malert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'dbconnect.php';

  $bacc = $_POST["username"];
  $mpin = $_POST["password"];

  $sql = "select * from beneficiary where bacc='$bacc'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $mno = $row['mno'];
 
  $sql = "select * from beneficiary where  bacc='$bacc' AND bank='HDFC'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  if ($num > 0) {
    $newsql = "select * from users where mno='$mno' AND mpin='$mpin' ";
    $result = mysqli_query($conn, $newsql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['username'] = $bacc;
      header("location: hdashboard.php");
    } else {
      $alert = true;
    }
  } else if ($_POST["username"] == "" && $_POST["password"] == "") {
    $malert = true;
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="loginn.css">
  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  <title></title>
</head>

<body>
  <?php
  if ($alert) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Invalid username or password </strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
  }
  ?>
    <?php
  if ($malert) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Enter correct login details</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
  }
  ?>
  
  <div id="login">

    <div class="container">
      <div id="login-row" class="row justify-content-center align-items-center">
        <div id="login-column" class="col-md-6">
          <div id="login-box" class="col-md-12">
            <form id="login-form" class="form" action="/mt/hdfclogin.php" method="post">
              <h3 class="text-center text-info">HDFC-Login</h3>
              <div class="form-group">
                <label for="username" class="text-info">Username:</label><br>
                <input type="text" name="username" id="username" class="form-control">
              </div>
              <div class="form-group">
                <label for="password" class="text-info">pin:</label><br>
                <input type="password" name="password" maxlength="4" id="password" class="form-control">
              </div>
              <div class="form-group">

                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
              </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  </div>

</body>

</html>