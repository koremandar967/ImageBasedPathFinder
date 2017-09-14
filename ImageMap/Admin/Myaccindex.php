<?php
session_start();
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
include('db.php');


if(!isset($_SESSION['buserid']))
{
		header("Location:index.php");
}

?>

<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
  <title>Image Based Path Finder</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">        
  <link rel="stylesheet" href="css/templatemo_main.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
  <div id="main-wrapper">
<?php
include("Header.php");
?>



    <div class="template-page-wrapper">
	 <div class="form-horizontal templatemo-signin-form" >
	
          <div class="col-md-12">
            <label for="username" class="col-sm-2 control-label">Date</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="RFKEY" name="username" placeholder="Date">
            </div>
          </div>              
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <div class="col-sm-offset-2 col-sm-10">
             
            </div>
          </div>
        </div>
         
		 <div class="form-group">
         <div class="col-md-12">
         <div class="col-sm-offset-2 col-sm-10">
		<div id="show" class="show"></div></div></div></div>



<script>
$("#RFKEY").keydown(function (e) {
if ($(e.target).attr("class")=='form-control' && e.keyCode == 13) {

var textcontent2 = '1';
var textcontent1 = $("#RFKEY").val();
var info = 'sid=' + textcontent1+'&page='+ textcontent2;
if(info=='')
{
}
else
{
document.getElementById("show").innerHTML="";
$("#show").fadeIn(400).html('<span class="load"><img src="load.gif"></span>');
$.ajax({
type: "POST",
url: "TicketTransactionUser.php",
data: info,
cache: true,
success: function(html){
$("#show").fadeIn(400).html('');
$("#show").append(html);
}  
});
}


	}
	});
</script>

    </div>
  </div>
</body>
</html>