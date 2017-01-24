<?php
session_start();
?>
<html>
<head>
	<title>INDEX PAGE</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	body {
  		background: url("kosem.jpg") no-repeat center center fixed ;
    	-webkit-background-size: cover; 
    	-moz-background-size: cover; 
    	-o-background-size:cover;
    	background-size: cover;
    	overflow: scroll;
  	}
  	
  	h2 {
  		position: absolute;
  width: 300px;
  height: 200px;
  z-index: 15;
  top: 50%;
  left: 50%;
  margin: -100px 0 0 -150px;
  font-style: italic;
  		color: white;
  		font-size: 700%
  	}
  	h1 {
  		text-align: center;
  		color: aliceblue;
  	}
  </style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">DOCTOR SECTION</a></li>
      <li><a href="appointmentschedule.php">SCHEDULE </a></li>
      <li><a href="viewprofile.php">VIEW PROFILE</a></li>
      <li><a href="appoinmentlist.php">APPOINTMENT LIST</a></li>
    </ul>
  </div>
</nav>

<?php
echo "<h1>".$_SESSION['username']."</h1>";
 ?>
<h2>welcome</h2>
</body>
</html>
