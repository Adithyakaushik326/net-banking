<?php
session_start();
$s=$_SESSION['usr'];
$acc=$_POST['benacc'];
$name=$_POST['newben'];
$conn=mysqli_connect('localhost','root','','bank');
 $a="SELECT account_id FROM accounts WHERE cust_id = (SELECT cust_id FROM customer WHERE cust_username='$s')";
    $res=mysqli_query($conn,$a);
    if(mysqli_num_rows($res)==1){
        $r1=mysqli_fetch_array($res);
        $accid=$r1['account_id'];
    }
  $ins="INSERT INTO ben VALUES ('$accid','$name','$acc')";
$res1=mysqli_query($conn,$ins);
if($res1)
{
	header('location:neft.php');
}
else{
	echo "Foreign key constraint error ";
	
}
?>