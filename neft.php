<?php
session_start();
if(!$_SESSION['usr'])
{
    header('location:login.html');
}
$s=$_SESSION['usr'];   
$s=$_SESSION['usr'];      
$conn=mysqli_connect('localhost','root','','bank');
$acc="SELECT account_id FROM accounts WHERE cust_id IN (SELECT cust_id FROM customer WHERE cust_username='$s')";
$res=mysqli_query($conn,$acc);
if(mysqli_num_rows($res)==1){
while($r1=mysqli_fetch_assoc($res)){
$accid=$r1['account_id'];}}
$ben = "SELECT * FROM ben WHERE account_id='$accid'";
$res=mysqli_query($conn,$ben);
$b="SELECT balance FROM accounts WHERE account_id='$accid'";
$res1=mysqli_query($conn,$b);
if(mysqli_num_rows($res1)>=0)
{
  $r2=mysqli_fetch_assoc($res1);
  $balance=$r2['balance'];
}
?>
<html><head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style type="text/css">
      
      .acc-id{
        margin-bottom: 20;
        height: 40px;
        width: 400;
        font-family: cursive;
        letter-spacing: 2px;
        text-align: center;
      }
      .amnt{
         margin-bottom: 20;
        height: 40px;
        width: 400;
        display: none;
        letter-spacing: 2px;
        font-family: cursive;
        letter-spacing: 2px;
      }
      .heading{
        display: none;
      }
      </style>
</head>
    <body bgcolor=#DCD9CD>
    <div style="background:#232F3E">
        <a href="logout.php"><button style="border:none;margin-top: 10;margin-bottom: 10;margin-left: 10; cursor:pointer"><img src="img/images.jpg" height=100 width="300" style="object-fit:fill;margin-top: -2;margin-left: -7;margin-right: -7;margin-bottom: -2"></button></a>
     <a href="logout.php"><button style=" border: none;font-size:21;margin-left:900; background:#232F3E;color: white;cursor:pointer">logout</button></a>
 </div>
        <br>
        <a href="index.php"><img src="img/back.png" style="position: absolute;top: 150;left: 100;height: 70,
           ;width: 70;cursor: pointer;" title="back"></a>
    <div class="container" align=ce style="width:800">
        <div class="jumbotron" style="border:4px;border-color:#232F3E;border-style:solid; background-color:white">
            <div style="background:#232F3E;height:80;margin-top:-65;margin-left:-35;margin-right:-35"><h1 style="text-align:center;color:white;padding-top: 15;"> Money Transfer</h1></div>
            <br>
            <h3>Select Beneficiary</h3>
            <h3><select name="select" class="acc-id" id="selectben" >
              <option selected>select</option>
              <?php
              while($r2=mysqli_fetch_assoc($res))
              {
              echo "<option>".$r2['ben_name']."</option>"; 
              }
              ?>
            </select></h3>
            <button type="button" id="addbenbutton" style="background:#232F3E;height:50;width:200;color:white;border:none;border-radius:7px;cursor: pointer;"  data-toggle="modal" data-target="#exampleModalCenter">Add beneficiary</button>
            <h3 class="heading">Enter Amount to tranfer</h3>
           <h3> <input type="text" class="amnt" id="money"  name="money"> </h3>
           <p class="heading" style="margin-top: -10">Available Balance = <?php echo $balance; ?></p>
           <h3 class="heading">UPI PIN </h3>
            <h3><input type="password" class="amnt" placeholder="enter pin" id="pass"></h3>
        <br>   
    <button type="submit" style="background:#232F3E;height:50;width:200;color:white;border:none;border-radius:7px;cursor: pointer;margin-bottom: -30" class="amnt" onclick="transfer()"> Transfer</button>
     </div>
    </div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form action="adben.php" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Beneficiary</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
      <h3>Enter beneficiary name</h3>
      <h3><input type="text" name="newben"class="acc-id" ></h3>
        <h3>Enter beneficiary account no</h3>
      <h3><input type="text" class="acc-id" name="benacc"></h3>
               </div>
      <div class="modal-footer">
               <button type="submit" style="background:#232F3E;height:40;width:150;color:white;border:none;border-radius:7px;cursor: pointer;" >Save changes</button>
            </div>
          </form>
    </div>
  </div>
</div>
  </body>
  <script type="text/javascript">
    $('#selectben').on("change",function(){
      $('#addbenbutton').hide();
      $('.amnt').show();
      $('.heading').show();
        })
    function transfer(){
      $.ajax({
        url:"moneytransfer.php",
        type: "post",
        data:{
          pin : $('#pass').val(),amnt:$('#money').val(),benname:$('#selectben').val()
        },
        success:function(ret){

          if(ret==1)
          {
            alert("Transaction successfull");
          }
          else if(ret==2)
          {
            alert("invalid pin");
          }
          else if(ret==0)
          {
            alert("Insufficient Balance");
          }
          location.reload();
        },
      })
    }
  </script>
  </html>