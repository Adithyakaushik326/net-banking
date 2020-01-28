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
while($r1=mysqli_fetch_assoc($res)){
$accid=$r1['account_id'];}}
$_SESSION['account_id']=$accid;
?>
<html><head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style type="text/css">
  
      #acc-id{
        margin-bottom: 20;
        height: 40px;
    width: 800;
        font-family: cursive;
        letter-spacing: 2px;
        

      }
    </style>
</head>
    <body bgcolor=#DCD9CD>
    <div style="background:#232F3E">
        <a href="logout.php"><button style="border:none;margin-top: 10;margin-bottom: 10;margin-left: 10; cursor:pointer"><img src="img/images.jpg" height=100 width="300" style="object-fit:fill;margin-top: -2;margin-left: -7;margin-right: -7;margin-bottom: -2"></button></a>
     <a href="logout.php"><button style=" border: none;font-size:21;margin-left:900; background:#232F3E;color: white;cursor:pointer">logout</button></a>
 </div>
        <br>
    <div class="container" align=ce style="width:800">
        <div class="jumbotron" style="border:4px;border-color:#232F3E;border-style:solid; background-color:white"><form method="post" >
            <div style="background:#232F3E;height:80;margin-top:-65;margin-left:-35;margin-right:-35"><h1 style="text-align:center;color:white;padding-top: 15">Balance Enquiry</h1></div>
            <br>
            <br>
        <h3>Account No.</h3>
       <h3> <input style="width:400;margin-bottom:20;height:40;text-align: center;font-family: cursive;letter-spacing: 2px;" id="acc-id" type="text" value="<?php echo $accid ?>"></h3>
            <h3>UPI PIN </h3>
            <input style="width:400;height:40;margin-bottom:30;text-align: center;" type="password" id="pin" name="pin" placeholder="enter pin"   >
            <br>
                
                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary"  style="background:#232F3E;height:50;width:200;color:white;border:none;border-radius:7px;cursor: pointer;margin-bottom: -30" onclick="callfun()" >
  Check Balance
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
     
        <button type="button" class="close" data-dismiss="modal" onclick="javascript:window.location.reload()"" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	 <h1>Balance 
       		<input type="text" id="balance-box" style="border: none" >
     		</h1>
      </div>
          </div>
       </div>
          </div>
                </form>
         </div>
        </div>
           <a href="index.php"><img src="img/back.png" style="position: absolute;top: 150;left: 100;height: 70,
           ;width: 70;cursor: pointer;" title="back"></a>

    </body><script type="text/javascript">
	function callfun(){
  $('#exampleModalCenter').modal('hide');
		$.ajax({
			url:"getbalance.php",
			type:"post",
			data:{
				pin: $("#pin").val()
			},
			success:function(ret){
        if(ret==1)
        {
          alert("invalid pin");
          location.reload();
        }
        else{
				$('#balance-box').val(ret);
        $('#exampleModalCenter').modal('show');

        }

		}
		});
   
        }
</script></html>
