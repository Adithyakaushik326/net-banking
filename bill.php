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
        $accid=$r1['account_id'];
    }
  
?>
<html><head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <style type="text/css">
      .img{
        background-image: url(img/back.png);
         background-size: contain;
        height: 70;
        width: 70;
        margin-left: 30;
             cursor: pointer;

      }
   .acc-id{
        margin-bottom: 20;
        height: 40px;
    width: 400;
        font-family: cursive;
        letter-spacing: 2px;
                text-align: center;
      }
      .bill{
        margin-bottom: 20;
        height: 40px;
        width: 400;
        font-family: cursive;
        letter-spacing: 2px;
        text-align: center;
        display: none;
      }
      #upi{
        display: none;
      }
        </style>
        </head>
    <body bgcolor=#DCD9CD>
    <div style="background:#232F3E">
        <a href="logout.php"><button style="border:none;margin-top: 10;margin-bottom: 10;margin-left: 10; cursor:pointer"><img src="img/images.jpg" height=100 width="300" style="object-fit:fill;margin-top: -2;margin-left: -7;margin-right: -7;margin-bottom: -2"></button></a>
     <a href="logout.php"><button style=" border: none;font-size:21;margin-left:900; background:#232F3E;color: white;cursor:pointer">logout</button></a></div>
        <br>
     <br>

    <div class="container" style="width:900">
        <div class="jumbotron" style="border:2px;border-color:#232F3E;border-style:solid; background-color:white"><form method="post" >
            <div style="background:#232F3E;height:80;margin-top:-65;margin-left:-35;margin-right:-35"><h1 style="text-align:center;color:white;padding-top: 15">Bill Payment</h1></div>
            <br>
          <h3>Account No.</h3>
        <h3><input class="acc-id" type="text" value="<?php echo $accid ?>"></h3>
          <h3>Type of Bill</h3>
          <br>
          <h3><select name="type" class="acc-id" id="billtype">
                  <option selected>Select</option>
                  <option>Electricity</option>
                  <option>Water</option>
                  <option>Mobile recharge</option>
                  <option>Credit card</option>
          </select>
         <h3 id="1"style="display: none">Bill amount</h3> 
<h3><input type="text" class="bill" placeholder="bill amount" value="" id="billamnt" >
            <h3 id="upi">UPI PIN </h3>
            <h3><input type="password" class="bill" name="pin" placeholder="enter pin" id="pass"></h3>
        <br>   
    <button type="submit" style="background:#232F3E;height:50;width:200;color:white;border:none;border-radius:7px;cursor: pointer;margin-bottom: -30" class="bill" onclick="pay()"> pay</button>
            </form></div></div>   
    <a href="index.php"><img src="img/back.png" style="position: absolute;top: 150;left: 100;height: 70,
           ;width: 70;cursor: pointer;" title="back"></a>
</body>
<script type="text/javascript">
              $("#billtype").on("change",function(){
        if($("#billtype option:selected").val()!="select"){
           $(".bill").show();
           $("#upi").show();
           $("#1").show();
           $.ajax({
            url:"calculatebill.php",
            type:"post",
            data:{
              type:$("#billtype").val()
            },
            success:function(ret){
              $("#billamnt").val(ret);
              
            }
           });
        }
      })
              function pay(){
                $.ajax({
                  url:"paybill.php",
                  type:"post",
                  data:{
                    pin: $("#pass").val(),amnt:$("#billamnt").val()
                    },
                   
                  success:function(ret){
                    if(ret==1){
                      alert("successfully paid");
                    }
                    else if(ret==2){
                      alert("invalid pin");
                    }
                    else {
                      alert("insufficient balance");
                    }
                  },

                })
              }
    </script>
</html>