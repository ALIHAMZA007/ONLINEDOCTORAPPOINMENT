<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<style type="text/css">
body {
	background-color: aliceblue;
}
div>h2 {
		background-color: white;
		font-weight: normal;
		font-style: italic;
		color: purple;
		text-shadow: 2px 2px 4px #000000;
		font-size: 200%;
	}
	h1 {
		text-align: center;
		color: purple;
		font-size: 250%;

	}
	.container {
		position: fixed;
		right: 0;
		width: 30%;
		
	}
	img {
		text-align: center;
	}
	h4 {
		color: purple;
		font-size: 250%;
		font-weight: normal;
	}
	p {
		color: aquamarine;
		font-size: 150%;
	}
	input {
		color: aqua;
		font-family: serif;
	}
</style>
<body>

<div>
<h2>APPOINTMENT SCHEDULE!</h2>
</div>
<div  class="container">
<fieldset>
<h4>SCHEDULE!</h4>
<form method="post" action="appointmentschedule.php">
NAME:<BR>
<input type="text" name="name" placeholder="NAME"><BR>
<BR>
<select name="SPEC">
	<option>GENERAL SURGEON</option>
    <option>PULMONOLOGIST</option>
    <option>CHILD PHYSICHIST</option>
    <option>CARDILOGIST</option>
    <option>DIABETOLOGIST</option>
    <option>UROLOGIST</option>
</select>
<BR
DAY:<BR>
<input type="day" name="day" placeholder="DAY"><BR>
TIME FROM:<BR>
<input type="time" name="from" placeholder="FROM"><BR>
TIME TO:<BR>
<input type="time" name="to" placeholder="TO"><BR>
VENUE:<BR>
<input type="text" name="venue" placeholder="VENUE"><BR>
<input type="submit"  class="btn btn-primary btn-block" value="SUBMIT" name="submit"><BR/>
 </form>
 </fieldset>
 <p>
 <?php echo $message ?>
 </p>
 </div>
 <?php 
if (!empty($_POST['name'])  && !empty($_POST['day']) && !empty($_POST['venue']) && !empty($_POST['SPEC'])) {
		$user = "root";
        $pasword = "";
        $db = "doctor";
 		$name=$_POST['name'];
 		$day=$_POST['day'];
 		$from=$_POST['from'];
 		$to=$_POST['to'];
 		$venue=$_POST['venue'];
 		$SPEC=$_POST['SPEC'];
 		$database = mysqli_connect("localhost", $user, $pasword, $db);
 		if (!$database) {
	   die("Conection failed : " .mysqli_connect_error());
		}
		$sql ="SELECT * FROM timing WHERE (DAY='".$day."' AND TIMING>='".$from."' AND Till<='".$to."') OR (DAY='".$day."' AND TIMING='".$from."') OR (DAY='".$day."' AND Till='".$to."')";
	   $result=mysqli_query($database,$sql);
       if(mysqli_num_rows($result)>=1)
	    {
	       		echo "ALREADY SCHEDULED IN SOME WHERE ON SAME SCHEDULE ";
	    }
	     else
	     {

		        $newsql="INSERT INTO timing (NAME,DAY,TIMING,Till,VENUE,SPEC) VALUES ('$name','$day','$from','$to','$venue','$SPEC')";
 		        if(mysqli_query($database,$newsql))
	       		{
	       			$alert='SUCCESSFUL SCHEDULED';
	       			
	       			//echo "VALUES inserted in database";
	       			
	       		}
	       		else{
	       			echo "ERROR";
	       		}
	       }
	   }
	   else
	   {
	   	   //echo "FILL THE FORM COMPLELETELY";
	   		$message="FILL THE COMPLETE FORM";
	   }		
?>
</body>
</html>