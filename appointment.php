<?php
session_start(); 
?>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
	body {
		background-color: aliceblue;
		overflow: scroll;
	}
	form {
		text-align: center;
	}
	h1 {
		color: lightgrey;
		text-align: center;
	}
	input {
		background-color: darkseagreen;
	}
	legend {
		font-style: italic;
		color: lightgrey;
	}
	a {
		text-align: center;
	}
</style>
</head>
<body>

<div class="container">
<h1>BOOK The Appointment</h1>
  <form method="post">
  
    <legend>Appointment Schedule</legend>
    <fieldset>
     <div class="form-group">
      <label for="patient">PATIENT NAME:</label>

      <input name="patient" type="text" class="form-control" id="patient" placeholder="Enter the Patient Name" >
    </div>
   <div class="form-group">
      <label for="patient">CONTACT NUMBER:</label>

      <input name="CONTNUM" type="text" class="form-control" id="CONTNUM" placeholder="Enter contact number" >
    </div>
    <div class="form-group">
      <label for="spec">SPECIALIST:</label>
      <select name="spec" class="form-control" id="spec">
        <option>GENERAL SURGEON</option>
        <option>PULMONOLOGIST</option>
        <option>CHILD PHYSICHIST</option>
        <option>CARDILOGIST</option>
        <option>DIABETOLOGIST</option>
        <option>UROLOGIST</option>
      </select>
      </div>
    	 <div class="form-group">
      <label for="day">DAY:</label>
      <input name="day" type="text" class="form-control" id="day" placeholder="Enter day">
    </div>
     <div class="form-group">
      <label for="dat">DATE:</label>
      <input name="dat" type="date" class="form-control" id="dat" >
    </div>
     <div class="form-group">
      <label for="Time">TIME:</label>
      <input name="Time" type="time" class="form-control" id="Time" >
    </div>
    <div class="form-group">
      <label for="venue">VENUE:</label>
      <input name="venue" type="text" class="form-control" id="venue" placeholder="Enter venue" >
    </div>
    
     <div class="form-group">
      <label for="doctorname">DOCTOR NAME:</label>
      <input name="doctorname" type="text" class="form-control" id="doctorname" placeholder="Enter doctor name" >
    </div>
    
    </div>
    </fieldset>

    <input type="submit" name="submit">
    
  </form>
</div>
<a href="search.php">Click here to search for doctor</a>
<?php
 if(!empty($_POST['day']) && !empty($_POST['doctorname']) && !empty($_POST['venue'])  && !empty($_POST['patient']) && !empty($_POST['CONTNUM']))
      {
      $patient=$_POST['patient'];
      $user = "root";
       $pasword = "";
       $db = "doctor";
       $time=$_POST['Time'];
       $contnum=$_POST['CONTNUM'];
       $date=$_POST['dat'];
       
    
       $doctorname=$_POST['doctorname'];
       $day=$_POST['day'];
       $spec=$_POST['spec'];
       $venue=$_POST['venue'];
     $database = mysqli_connect("localhost", $user, $pasword, $db);
     if (!$database) {
     die("Conection failed : " .mysqli_connect_error());
    }
    $sql="SELECT NAME FROM timing WHERE DAY='".$day."' AND VENUE='".$venue."' AND TIMING<='".$time."' AND TILL>'".$time."'";
    $result = mysqli_query($database,$sql);
    if(mysqli_num_rows($result)>=1)
    {
        $newsql="SELECT * FROM appoinment WHERE DAT='".$date."' AND TIM='".$time."' AND DOCTOR='".$doctorname."'";
        $newresult=mysqli_query($database,$newsql);
        if (mysqli_num_rows($newresult)>=1) {
          echo "ALREADY BOOKED";
        }
        else
        {
          $trisql="INSERT INTO appoinment (PATIENT,CONTNUM,SPEC,DAY,DAT,TIM,VENUE,DOCTOR) VALUES ('$patient','$contnum','$spec','$day','$date','$time','$venue','$doctorname')";
                  if(mysqli_query($database,$trisql))
                  {
              
                      echo "form submitted successfully";
                      $username = 'BOND007';
                      $password = '42690';
                      $to = $contnum;
                       $from = 'Brand';
                      $message = 'your appointment schedule on'.$date."at".$time;
                      $url = "http://Lifetimesms.com/plain?username=".$username."&password=".$password.
                      "&to=".$to."&from=".urlencode($from)."&message=".urlencode($message)." ";
                      //Curl Start
                      $ch  =  curl_init();
                      $timeout  =  30;
                      curl_setopt ($ch,CURLOPT_URL, $url) ;
                      curl_setopt ($ch,CURLOPT_RETURNTRANSFER, 1);
                      curl_setopt ($ch,CURLOPT_CONNECTTIMEOUT, $timeout) ;
                      $response = curl_exec($ch) ;
                        curl_close($ch) ; 
                      //Write out the response
                      echo $response ;
                      echo "SMS HAS BEEN SENT TO YOUR MOBILE".$contnum;
                   }
                   else
                   {
                        echo "ERROR";
                   }
                  // mysql_close($database);

       }
    }
    else
    {
      echo "NO DOCTOR AVAILABLE";
    }
  }
  else
  {
     echo "FILL THE FORM COMPLETELY";
  }
  ?>
</body>
</html>