<?php
session_start();
$s=$_SESSION['usr'];            
    $conn=mysqli_connect('localhost','root','','bank');
    $acc="SELECT account_id FROM accounts WHERE cust_id IN (SELECT cust_id FROM customer WHERE cust_username='$s')";
    $details="SELECT *  FROM customer WHERE cust_username='$s'";
    $res=mysqli_query($conn,$acc);
    if(mysqli_num_rows($res)==1){
        $r1=mysqli_fetch_array($res);
        $accid=$r1['account_id'];
    }
    $type=$_POST['type'];
    $_SESSION['type']=$type;
     $r=mysqli_query($conn,"CALL interest('$accid','$type')");
    $bill="SELECT amount FROM bill WHERE account_id='$accid' AND billtype='$type'";
    $res1=mysqli_query($conn,$bill);
        if(mysqli_num_rows($res1)==1)
    {
      $r2=mysqli_fetch_assoc($res1);
      $amnt=$r2['amount'];
      echo $amnt;
     }
     else echo ("0");

?>