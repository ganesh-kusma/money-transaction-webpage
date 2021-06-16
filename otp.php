
<?php
include 'dbconnect.php';

$otp = rand(1000, 9999);
$sql = "UPDATE otp SET otp='$otp' WHERE id=1";
if ($conn->query($sql) === TRUE) {
  echo $otp;
} else {
  echo "Error updating record: " . $conn->error;
}


?>
