<?php
session_start();
  ?>
<!Doctype html>
<html>
<head>
<title>
REGISTRATIOON
</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  	body {
  		background-color: #FAEBD7;
  		color: white;
      text-align: center;
  	}
    h2 {
      text-align: center;
      color: blue;
    }
    input {
      font-size: 120%;
color: #5a5854;
background-color: #f2f2f2;

}
select {
   font-size: 120%;
color: #5a5854;
background-color: #f2f2f2;
}

  </style>
<head>
<body>


<div class="container">
<ul class="nav navbar-nav navbar-right">
     <li> <a href="registration.php"><span class="glyphicon glyphicon-user"></span> SIGNUP</a></li>
     <li><a href="loginpage.php"><span class="glyphicon glyphicon-log-in"></span>LOGININ</a></li>
</ul>
 </div>
 <h2>CREATE NEW ACCOUNT</h2>
  <div>
<form method="post">
  
  <fieldset>
  <input type="text" name="fullname" placeholder="Enter The Full Name" size="60"><br><br>
  <input type="text" name="contactnumber" placeholder="Enter ContactNumber" size="60"><br><br>
  <input type="email" name="email" placeholder="Enter The Valid Email" size="60"><br><br>
  <input type="email" name="skypeid" placeholder="Ener The Skype ID" size="60"><br><br>
  <select name="spec">
    <option>GENERAL SURGEON</option>
    <option>PULMONOLOGIST</option>
    <option>CHILD PYSICHIST</option>
    <option>CARDILOGIST</option>
    <option>DIABETOLOGIST</option>
    <option>UROLOGIST</option>
  </select><br><br>
  <input type="text" name="cur" placeholder="current or previous institutes" size="60"><br><br>
  <input type="text" name="username" placeholder="Enter The UserName" size="60"><br><br>
  <input type="password" name="password" placeholder="Enter Your Valid Email" size="60"><br><br>
  
  <div class="checkbox">
      <label><input type="checkbox" name="rememberme"> Remember me</label>
  </div>
  </fieldset>
  <input type="submit" class="btn btn-info" value="SIGNUP">
</form>
</div>
<?php
 if(!empty($_POST['fullname']) && !empty($_POST['password']) && !empty($_POST['contactnumber']) && !empty($_POST['skypeid']) && !empty($_POST['email']) && !empty($_POST['cur']) && !empty($_POST['username']))
      {
       $username=$_POST['username']; 
       $user = "root";
       $pasword = "";
       $db = "doctor";
       $_SESSION['username']=$_POST['username'];
       //$name=$_SESSION['name'];
       $password=$_POST['password'];
       $name=$_POST['fullname'];
       $number=$_POST['contactnumber'];
       //$pass=$_POST['password'];
       $skypeid=$_POST['skypeid'];
       $current=$_POST['cur'];
       $email=$_POST['email'];
       $spec=$_POST['spec'];
     $database = mysqli_connect("localhost", $user, $pasword, $db);
     if (!$database) {
     die("Conection failed : " .mysqli_connect_error());
    }
     $sql ="SELECT * FROM doc WHERE USER='".$_SESSION['username']."'";
     $result=mysqli_query($database,$sql);
     
      if(mysqli_num_rows($result)>=1)
      {
            echo "username already exists";
      }
       else
       {
            $newsql="INSERT INTO doc (NAME, CONTNUM, SKYPEID,SPEC,EXP,PCI,USER,PASS) VALUES ('$name',$number,'$skypeid','$spec','$email','$current','{$_SESSION['username']}','$password')";
            if(mysqli_query($database,$newsql))
            {
              
              header('Location:thanks.php');
            }
            else{
              echo "ERROR";
            }
       }
         
    }
    else if (!isset($_SERVER['HTTP_REFERER']))
    {
      header('location:home.php');
        exit;
    }
    else
    {
      echo "Fill the form completely";
    }
?>
</body>
</html>
