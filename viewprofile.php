<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
	h1 {
		color :purple;
		font-size: 24pt;
		text-align: center;
		text-shadow: 2px 2px lightgreen;
	}
	li .hover {
		text-align: center;
		background-color: lightgrey;
	}
</style>
<body>
<h1>
	<u>Doctor Info</u>
</h1>
<?php 
	
	 $user = "root";
     $pasword = "";
     $db = "doctor";
	 //$number=$_POST['number'];
     $database = mysqli_connect("localhost", $user, $pasword, $db);
 	  if (!$database) {
	  die("Conection failed : " .mysqli_connect_error());
		}
	   $sql ="SELECT * FROM doc WHERE USER='".$_SESSION['username']."'";
	   $result=mysqli_query($database,$sql);
	   
	    if(mysqli_num_rows($result)>=1)
	    {
	    	    
	    	    
	    	while($row = mysqli_fetch_assoc($result)) {
        echo "<ul><li>"   ."NAME".    $row["NAME"].   "</li>"  .  "<li>"  .  " CONTACTNUMBER: " .  $row["CONTNUM"]  .  "</li>"  .  "<li>"  .  "SKYPEID: "   .    $row["SKYPEID"] .  "</li>". "<li>"."SPECIALIST".$row["SPEC"]."</li>"."<li>"."CURRENT HOSPITALS WORKING"."<BR>".$row["PCI"]."</li><ul>";
                 }
                 
                 

                 
                 
	    }
	    else
	    {

	    	echo "<h2>The Entered Username Or Password Is Invalid</h2>";
	    	
	    }
	
	
 ?>
</body>
</html>