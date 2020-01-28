<?php
session_start();
if(!$_SESSION['usr'])
{
    header('location:login.html');
}
?>
<html><head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        .image{
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        height: 160px;
        width: 160px;
             cursor: pointer;
        
            }
        #img1{
            background-image: url(img/acc.jpg);
        }
        #img2{
            background-image: url(img/bill.png);
        }
        #img3{
            background-image: url(img/neft.jpg);
        }
        #img4{
            background-image: url(img/appointment.jpg);
        }
        #img5{
            background-image: url(img/txn.png);
        }
        #img6{
            background-image: url(img/balance.png);
        }
        .row{
            text-align: center;
/*            margin-top: 40;*/
            padding-left: 100;
       
        }
        </style> 
    </head>
<body bgcolor=#DCD9CD>
    <div style="background:#232F3E">
        <a href="logout.php"><button style="border:none;margin-top: 10;margin-bottom: 10;margin-left: 10; cursor:pointer"><img src="img/images.jpg" height=100 width="300" style="object-fit:fill;margin-top: -2;margin-left: -7;margin-right: -7;margin-bottom: -2"></button></a>
     <a href="logout.php"><button style=" border: none;font-size:21;margin-left:900; background:#232F3E;color: white;cursor:pointer">logout</button></a></div>
    <br>
    <br><div style="font-size: 25"><span >Welcome  ,  </span><span style="font-family:serif"><?php echo $_SESSION['usr'];?></span></div>
    <hr width=90% align="left">
    <br>
    
    <div class="container">
    <div class="row" >
        <div class="col-4"><a href="accounts.php"><div class="image" id="img1" title="Account info"></div></a></div>
        <div class="col-4"><a href="bill.php"><div class="image" id="img2" title="Bill payment"></div></a></div>
        <div class="col-4"><a href="neft.php"><div class="image" id="img3" title="Money Transfer" ></div></a></div>
        </div><br><br>
        <div class="row">
        <div class="col-4"><a href="appointment.php"><div class="image" id="img4" title="Staff details"></div></a></div> <div class="col-4"><a href="history.php"><div class="image" id="img5" title="History" ></div></a></div>  
        <div class="col-4"><a href="balance.php"><div class="image" id="img6" title="Balance" ></div></a></div>
        </div>
    </div>
        </body></html>