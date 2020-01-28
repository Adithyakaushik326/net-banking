<?php
session_start();
if(!isset($_SESSION['usr'])){
    $userid = $_POST['userid'];
    $pass = $_POST['password'];
    $conn = mysqli_connect('localhost', 'root', '', 'bank');
    $query = "SELECT *FROM customer WHERE cust_email = '$userid' OR cust_username='$userid' AND cust_password = '$pass'";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res) == 1){
        while($row=mysqli_fetch_assoc($res))
        {
            $r1=$row['cust_username'];
            $_SESSION['usr']=$r1;
          //  echo $_session["usr"];
 header('Location:index.php');
     }}
     else{
      header('location:login.html');
  }

 }
else 
    header('location:login.html');
?>