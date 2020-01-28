<?php
	session_start();
	$s=$_SESSION['usr'];			
	$conn=mysqli_connect('localhost','root','','bank');
	$acc="SELECT account_id FROM accounts WHERE cust_id IN (SELECT cust_id FROM customer WHERE cust_username='$s')";
	$res=mysqli_query($conn,$acc);
	if(mysqli_num_rows($res)==1){
		$r1=mysqli_fetch_array($res);
		$accid=$r1['account_id'];
	}
	$p=$_POST['pin'];
	$a=$_POST['amnt'];
	$type=$_SESSION['type'];
	$_SESSION['account_id']=$accid;
	date_default_timezone_set('Asia/Kolkata');
	$date=date("y-m-d");
	$time = date("h:m:sa");
	$t=$type." bill";
$bal="SELECT cust_id from customer WHERE cust_username='$s' AND txn_password='$p'";
	$res1=mysqli_query($conn,$bal);
	if(mysqli_num_rows($res1)>0)
	{
		$r2=mysqli_fetch_array($res1);
		$r4=$r2['cust_id'];
		$fn="SELECT balance FROM accounts WHERE cust_id='$r4'";
		$res2=mysqli_query($conn,$fn);
	if(mysqli_num_rows($res2)>0)
	{
		$r3=mysqli_fetch_array($res2);
		$r5=$r3['balance'];
		if($r5>=$a)
		{
			$r6=$r5-$a;
			$bal="INSERT INTO txn VALUES ('$accid','paid','$t','$a','$r6','$date','$time')";
			//$bal="UPDATE accounts SET balance = '$r6' WHERE cust_id='$r4'";
			$res2=mysqli_query($conn,$bal);
			$bill="UPDATE bill SET amount=amount-'$a' WHERE account_id='$accid' AND billtype='$type'";
			$re3=mysqli_query($conn,$bill);
			echo "1";
		}
		else{
			echo "0";
		}
	}
	}
	else {
		echo "2";
	}
?>