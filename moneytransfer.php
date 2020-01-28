<?php
session_start();

$s=$_SESSION['usr'];
$pin=$_POST['pin'];
$amnt=$_POST['amnt'];
$benname=$_POST['benname'];
$conn=mysqli_connect('localhost','root','','bank');
$benid="SELECT ben_account FROM ben WHERE ben_name='$benname'";
$res=mysqli_query($conn,$benid);
if(mysqli_num_rows($res)>0)
{
 $r=mysqli_fetch_assoc($res);
 $benaccount=$r['ben_account'];
}
date_default_timezone_set('Asia/Kolkata');

$date=date("y-m-d");
$time = date("h:i:sa");
$cust="SELECT cust_id FROM customer WHERE cust_username='$s' AND txn_password='$pin'";
$res1=mysqli_query($conn,$cust);
if(mysqli_num_rows($res1)>0)
{
	$r1=mysqli_fetch_assoc($res1);
	$cust_id=$r1['cust_id'];
$bal="SELECT * FROM accounts WHERE cust_id='$cust_id'";
$res2=mysqli_query($conn,$bal);
if(mysqli_num_rows($res2)>0)
{
	$r2=mysqli_fetch_assoc($res2);
	$balance=$r2['balance'];
	$acc=$r2['account_id'];
		if($balance>$amnt)
	{
		$r3=$balance-$amnt;
		$new="INSERT INTO txn VALUES('$acc','sent','$benname','$amnt','$r3','$date','$time')";
		$u1=mysqli_query($conn,$new);
		$q="SELECT balance FROM accounts WHERE account_id='$benaccount'";
			$q1=mysqli_query($conn,$q);
			if(mysqli_num_rows($q1)>0)
			{
				$q2=mysqli_fetch_assoc($q1);
				$benbalance=$q2['balance'];
			}
					//$new="UPDATE accounts SET balance ='$r3' WHERE cust_id='$cust_id'";
				$r4=$benbalance+$amnt;
		$new1="INSERT INTO txn VALUES('$benaccount','recieved','$s','$amnt','$r4','$date','$time')";
			$u2=mysqli_query($conn,$new1);
			echo "1";
	}
	else{
		echo "0";
	}
}
}
else{
	echo "2";
}


?>