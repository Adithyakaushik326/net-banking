<?php
session_start();
if(!$_SESSION['usr'])
{
    header('location:login.html');
}
$s=$_SESSION['usr'];            
    $conn=mysqli_connect('localhost','root','','bank');
    $acc="SELECT account_id FROM accounts WHERE cust_id IN (SELECT cust_id FROM customer WHERE cust_username='$s')";
    $res=mysqli_query($conn,$acc);
    if(mysqli_num_rows($res)==1){
        $r1=mysqli_fetch_array($res);
        $accid=$r1['account_id'];}

?>
<html><head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script></head>
    <body bgcolor=#DCD9CD>
    <div style="background:#232F3E">
        <a href="logout.php"><button style="border:none;margin-top: 10;margin-bottom: 10;margin-left: 10; cursor:pointer"><img src="img/images.jpg" height=100 width="300" style="object-fit:fill;margin-top: -2;margin-left: -7;margin-right: -7;margin-bottom: -2"></button></a>
     <a href="logout.php"><button style=" border: none;font-size:21;margin-left:900; background:#232F3E;color: white;cursor:pointer">logout</button></a></div>
        <br>
        <?php
        $q1="SELECT * FROM txn WHERE account_id='$accid'";
$res1=mysqli_query($conn,$q1);
if(mysqli_num_rows($res1)>0)
{
    
    while($r2=mysqli_fetch_assoc($res1)){
      
         $bal=$r2['balance'];
         $type=$r2['type'];
         $amnt=$r2['amount'];
         $to=$r2['ben_name'];
         
}
}

?>
 <a href="index.php"><img src="img/back.png" style="position: absolute;top: 140;left: 40;height: 70 ;width: 70;cursor: pointer;" title=" back"></a>
 <br>
 <br>
 <br>

<table class="table table-hover">
  <thead style="background-color:#232F3E;color: white ">
    <tr>
      <th scope="col"></th>
      <th scope="col">Action</th>
      <th scope="col">To/From</th>
      <th scope="col"> Amount</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
    
      <?php 
      $res1=mysqli_query($conn,$q1);
      $a=1;
if(mysqli_num_rows($res1)>0)
{
    
    while($r2=mysqli_fetch_assoc($res1)){
        
         $bal=$r2['balance'];
         $type=$r2['type'];
         $amnt=$r2['amount'];
         $to=$r2['ben_name'];
         $date=$r2['date'];
         $time=$r2['time'];
        echo '<td>'.$a.'</td>';
        echo '<td>'.$type.'</td>';
        echo '<td>'.$to.'</td>';
        echo '<td>'.$amnt.'</td>';  
         echo '<td>'.$date.'</td>';
        echo '<td>'.$time.'</td>';
        echo '</tr>';
        $a++;
}
}
?>
  <!-- <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
 -->  </tbody>
</table>
        </body>
    </html>