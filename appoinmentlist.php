<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	body {
		text-align: center;
	}
	div h1 {
		background-color: lightgrey;
		color: white;
	}
	h2 {
		color: aqua;
		font-style: oblique;
		font-weight: normal;
		text-transform: uppercase;
		text-decoration-style: unset;
		text-shadow: 2px 2px aqua;
	}
	table, th, td {
     border: 1px solid black;
}
</style>
<body>
<h2>WELCOME    <?php echo $_SESSION['username']; ?> </h2>
<div><h1>PATIENT LIST</h1></div>
<form method="get">
<fieldset>
ENTER THE DATE:<BR>
<input type="date" name="dat"><BR>
ENTER THE DOCTOR NAmE:<BR>
<input type="text" name="name"><BR>
<input type="submit" name="submit" class="btn btn-success" value="submit"><BR>
</fieldset>
</form>
<?php 
if (isset($_GET['submit'])) {
	$servername = "localhost";
$username = "root";
$password = "";
$dbname = "doctor";
$date=$_GET['dat'];
$name=$_GET['name'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT PATIENT,SITUATION,DAY,DAT,TIM,VENUE FROM appoinment WHERE DOCTOR='".$name."' AND DAT='".$date."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>PATIENT</th><th>SITUATION</th><th>DAY</th><th>DAT</th><th>TIM</th><th>VENUE</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["PATIENT"]."</td><td>".$row["SITUATION"]." </td><td>".$row["DAY"]."</td><td>".$row["DAT"]."</td><td>".$row["TIM"]."</td><td>".$row["VENUE"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
}

 ?>
</body>
</html>