<?php
session_start();
error_reporting (E_ALL ^ E_NOTICE ^ E_WARNING);
include('db.php');

if(isset($_GET['Logout']))
{
$_SESSION['userid']= "";
$_SESSION['username']= "";

unset($_SESSION['userid']);
unset($_SESSION['username']);
}
elseif(isset($_SESSION['userid']) and isset($_SESSION['username']))
{
		header("Location:Main.php");
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
</head>
<body>
  <div id="main-wrapper">
<?php
include("Header.php");
?>

    <div class="template-page-wrapper">
      <form class="form-horizontal templatemo-signin-form" role="form" action="Main.php" method="post">
        <div class="form-group">
          <div class="col-md-12">
            <label for="username" class="col-sm-2 control-label">Username</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
          </div>              
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" value="Sign in" name="signin" class="btn btn-default">
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>