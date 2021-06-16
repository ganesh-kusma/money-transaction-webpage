<?php
    $servername = "localhost";
    $username = "root";
    $password = "123456";
   $database="money_transfer";
    $conn = new mysqli($servername, $username, $password,$database);

    if (!$conn) {
       echo "no connection";
      } 
      else
      {
         
      }
  
   ?>