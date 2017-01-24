
<!DOCTYPE html>
<html>
<head>
<title>searchpage</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	body {
  		overflow: scroll;
  	}
  	table, th, td {
     border: 1px solid black;
     background-color: lightgrey;
     
}
  </style>
</head>
<body>
<div class="container">
<div align="center">
<img src="search.jpg" height="300" width="500" align="middle">
</div>
<form action="search.php" method="post">

 <select   name="spec" class="form-control">
    <option>GENERAL SURGEON</option>
    <option>PULMONOLOGIST</option>
    <option>CHILD PHYSICHIST</option>
    <option>CARDILOGIST</option>
    <option>DIABETOLOGIST</option>
    <option>UROLOGIST</option>
  </select>
<input type="submit" name="search" value="SEARCH"  >
  <form>
</div>
<?php

	if(isset($_POST['search']))
	{
		$SPEC=$_POST['spec'];
		$conn = mysqli_connect("localhost", "root", "", "doctor");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT NAME,DAY,TIMING,TILL,VENUE FROM timing WHERE SPEC='".$SPEC."' ";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "<table><tr><th>NAME</th><th>DAY</th><th>TIMING</th><th>TILL</th><th>VENUE</th></tr>";
    while($row = mysqli_fetch_assoc($result)) {
        //echo "NAME " . $row["NAME"]. " - CONTNUM: " . $row["CONTNUM"]. " "."<br>";
     echo "<tr><td>".$row["NAME"]."</td><td>".$row["DAY"]." </td><td>".$row["TIMING"]."</td><td>".$row["TILL"]."</td><td>".$row["VENUE"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

mysqli_close($conn);
	}
  
?>

</body>
</html>
