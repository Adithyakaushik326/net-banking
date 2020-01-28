<?php
session_start();
if(!$_SESSION['usr'])
{
    header('location:login.html');
}

$s=$_SESSION['usr'];            
    $conn=mysqli_connect('localhost','root','','bank');
    $acc="SELECT account_id FROM accounts WHERE cust_id IN (SELECT cust_id FROM customer WHERE cust_username='$s')";
    $details="SELECT *  FROM customer WHERE cust_username='$s'";
    $res=mysqli_query($conn,$acc);
    if(mysqli_num_rows($res)==1){
        $r1=mysqli_fetch_array($res);
        $accid=$r1['account_id'];
    }
    $res1=mysqli_query($conn,$details);
    if(mysqli_num_rows($res1)==1){
        $r2=mysqli_fetch_array($res1);
        $Name=$r2['cust_name'];
        $phone=$r2['cust_phone'];
        $email=$r2['cust_email'];
        $add=$r2['address'];
                $pic=$r2['custimg'];
    }

?>
<html><head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <style type="text/css">
     
      #acc-id{
        margin-bottom: 20;
        height: 40px;
    width: 800;
        font-family: cursive;
        letter-spacing: 2px;
        border: none;

      }
      #acc-i{
     
        height: 40px;
    width: 800;
        font-family: cursive;
        letter-spacing: 2px;
        border: none;

      }
    </style>
    </head>
    <body bgcolor=#DCD9CD>
    <div style="background:#232F3E">
        <a href="logout.php"><button style="border:none;margin-top: 10;margin-bottom: 10;margin-left: 10; cursor:pointer"><img src="img/images.jpg" height=100 width="300" style="object-fit:fill;margin-top: -2;margin-left: -7;margin-right: -7;margin-bottom: -2"></button></a>
     <a href="logout.php"><button style=" border: none;font-size:21;margin-left:900; background:#232F3E;color: white;cursor:pointer">logout</button></a></div>
        <br>
     <br>
     <img src="<?php echo $pic; ?>" style="position:absolute;height: 200px;width: 250px;left:830;top:280">
      <a href="index.php"><img src="img/back.png" style="position: absolute;top: 150;left: 100;height: 70,
           ;width: 70;cursor: pointer;" title="back"></a><a href="index.php"><div class="img"></div></a>

    <div class="container" align=ce style="width:900">
        <div class="jumbotron" style="border:4px;border-color:#232F3E;border-style:solid; background-color:white"><form method="post" >
            <div style="background:#232F3E;height:80;margin-top:-65;margin-left:-35;margin-right:-35"><h1 style="text-align:center;color:white;padding-top: 15">Account Info</h1></div>
            <br>
            <br>
                   <h3><input  id="acc-id" type="text" value="<?php echo 'Name           :  '.$Name ?>"></h3>
        <h3><input  id="acc-id" type="text" value="<?php echo 'Account No. :  '.$accid ?>"></h3>
         <h3><input  id="acc-id" type="text" value="<?php echo 'Mobile No.   :  '.$phone ?>"></h3>
       <h3><input  id="acc-id" type="text" value="<?php echo 'Email-id       :  '.$email ?>"></h3>
     <h3><input  id="acc-i" type="text" value="<?php echo 'Address      :  '.$add ?>"></h3>
       
        </form></div></div></body></htm50