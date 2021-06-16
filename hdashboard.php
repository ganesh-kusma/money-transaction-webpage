<?php

include 'dbconnect.php';
session_start();
$username = $_SESSION['username'];
if (!isset($_SESSION['loggedin']) == true || $_SESSION['username'] !== $username) {
  header("location:hdfclogin.php");
} else {
  $bacc = $_SESSION['username'];
  $sql = "select * from beneficiary where bacc='$bacc'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $bname = $row['bname'];
} ?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="simple-sidebar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Hello, world!</title>
</head>

<body>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->




  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">
        <i class="fa fa-user"></i>
        <?PHP echo $bname  ?>
      </div>
      <div class="list-group list-group-flush"><a href="hdashboard.php" class="list-group-item list-group-item-action bg-light">Dashboard</a><a href="hcurrentbal.php" class="list-group-item list-group-item-action bg-light">Current balance</a><a href="htransactions.php" class="list-group-item list-group-item-action bg-light">Transactions</a><a href="hlogout.php" class="list-group-item list-group-item-action bg-light">logout</a></div>
    </div><!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">

      <div class="container-fluid"><br>
        <img src="photos/hdfclogo.png" style="width: 33%;height: 20%;margin-left: 30%;width: 33%;margin-left: 33%;" class="hdfc" alt=""><br><br>
        <h1 class="mt-4">Welcome <?PHP echo $bname  ?> </h1>
        <div class="sr">HDFC at your service</div>

      </div>
    </div><!-- /#page-content-wrapper -->
  </div>
</body>

</html>