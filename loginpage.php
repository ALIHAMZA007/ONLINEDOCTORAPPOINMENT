<?php 
session_start();
$conn=mysqli_connect("localhost","root","","doctor");

//if(!isset($_SERVER['HTTP_REFERER'])){
 // header('Location:home.php');
  //exit();
//}
 if(!empty($_POST['username']) && !empty($_POST['password']))
{
  $_SESSION['username']=$_POST['username'];
  $_SESSION['password']=$_POST['password'];
	$sql="SELECT * from doc where USER='".$_POST['username']."' AND PASS='".$_POST['password']."'";
	$result=mysqli_query($conn,$sql);
	$user=mysqli_fetch_array($result);
	if($user)
	{
		if(!empty($_POST['remember']))
		{
			setcookie("member_login",$_POST["username"],time()+(10*365*24*60*60));
			setcookie("member_password",$_POST["password"],time()+(10*365*24*60*60));

		}
		else
		{
			if (isset($_COOKIE["member_login"])) {
				setcookie("member_login","");
			}
			if(isset($_COOKIE["member_password"]))
			{
				setcookie("member_password");

			}

		}
		header("Location:index.php");
	}
	else
	{
		$message="Invalid LogIn";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGINPAGE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	body{
  		text-align: center;
  		background-color: lightblue;
  	}
  	button {
  		background-color: lightblue;
  	}
  	h2 {
  		color: gray;
  	}
  	fieldset {
  	position: fixed;
    margin: auto;
   top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    width: 35%;
    height: 150px;
    background-color: white;
  	}
  	
  	.form-control
  	{
  		background-color: lavender;
  	}
  </style>
</head>
<body>
<div class="container">
<fieldset>
	<h2>LOGIN FORM</h2>
	<form method="post">
	<div class="text-danger"><?php if(isset($message)){ echo $message;} ?></div>
	<div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
    <input id="username" type="text" class="form-control" name="username" placeholder="ENTER USERNAME" value="<?php if(isset($_COOKIE["username"])) {echo $_COOKIE["username"];} ?>">
  </div>
  <div class="input-group">
    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
    <input id="password" type="password" class="form-control" name="password" placeholder="ENTER PASSWORD" value="<?php if(isset($_COOKIE["password"])) {echo $_COOKIE["password"];} ?>">
  </div>
  <div class="form-group">
  <input type="checkbox" name="remember">
  <label for="remember-me">Remember me</label>
  </div>
  <input type="submit" name="submit" class="btn btn-primary btn-block" ><br><br>
	</form>
</fieldset>
</div>
</body>
</html>