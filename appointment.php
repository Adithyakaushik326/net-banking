<?php
session_start();
if(!$_SESSION['usr'])
{
    header('location:login.html');
}
$conn = mysqli_connect('localhost', "root", "","bank");
$que = "SELECT emp_name FROM employee";
$res = mysqli_query($conn, $que);

?>
<html><head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style type="text/css">
    #emp{
        
        margin-top: 50;
        height: 50px;
        width: 400;
        font-size: 26;
        font-family: cursive;
        letter-spacing: 3px;
        text-align: center;
      }
    </style>
 
   </head>
    <body bgcolor=#DCD9CD>
    <div style="background:#232F3E">
        <a href="logout.php"><button style="border:none;margin-top: 10;margin-bottom: 10;margin-left: 10; cursor:pointer"><img src="img/images.jpg" height=100 width="300" style="object-fit:fill;margin-top: -2;margin-left: -7;margin-right: -7;margin-bottom: -2"></button></a>
     <a href="logout.php"><button style=" border: none;font-size:21;margin-left:900; background:#232F3E;color: white;cursor:pointer">logout</button></a></div>
        <br>
    <div class="container" align=ce style="width:1500">
        <div class="jumbotron" style="border:4px;border-color:#232F3E;border-style:solid; background-color:white">
            <div style="background:#232F3E;height:80;margin-top:-65;margin-left:-35;margin-right:-35"><h1 style="text-align:center;color:white;padding-top: 15">Staff Details</h1></div>
            <br>
            <select id="emp">
                <option selected>Select</option>
                <?php
                 $conn=mysqli_connect('localhost','root','','bank');
                 $loc="SELECT location FROM branch";
                 $res=mysqli_query($conn,$loc);
                 if(mysqli_num_rows($res)>0)
                 {
                    while($r=mysqli_fetch_assoc($res))
                    {
                        $location = $r['location'];
                        echo '<option>'.$location.'</option>';
                    }
                 }
                ?>
            </select>
            <div class="row" id="data-row" onclick="fn()" style="margin-top: 20">

            </div>
        </div>
    </div>
         <a href="index.php"><img src="img/back.png" style="position: absolute;top: 150;left: 30;height: 70,;width: 70;cursor: pointer;" title="back"></a>
         <!-- Button trigger modal -->

          </body>
<script type="text/javascript">
    $('#emp').on('change',function(){
        var branch = $("#emp option:selected").val();
        $.ajax({
            url: "getemps.php",
            type: "post",
            data:{
                b: branch
            },
            success:function(obj){
                var data = JSON.parse(obj);
                var code = "";
                for (var i = 0; i < data.length; i++) {
                    code += '<div class="col-6"><img src="'+data[i]['emp_img']+'" height="300" width="450" align="center">';
                    code += '<h3>Name :'+data[i]['emp_name']+'</h3>';
                    code += '<h3>Designation: '+data[i]['designation']+'</h3>';
                    code += '<h3>Email address: '+data[i]['email']+'</h3> ';
                    code += '</div>';

                }
                $("#data-row").html(code);
                //$('#emp').hide();
               
            }

        });
    })

    function fn(){
      
         $('#exampleModalCenter').modal('show');
    }
    $(function() {
  $('#datetimepicker1').datetimepicker({
    language: 'pt-BR'
  });
});


</script></html>