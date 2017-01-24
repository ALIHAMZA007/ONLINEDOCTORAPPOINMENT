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
  <style type="text/css">
    h1 {
      text-align: center;
      color: darkgray;
    }
  </style>
</head>
<body>
<div class="container">
<h1>CREATE A NEW ACCOUNT</h1>
  <form method="post">
  <legend>Personal Detail</legend>
  <fieldset>
  <div class="form-group">
      <label for="name">NAME:</label>
      <input name="name" type="text" class="form-control" id="text" placeholder="Enter name" >
    </div><br>
    <div class="form-group">
      <label for="gender">GENDER:</label>
      <select name="gender" class="form-control" id="gender">
        <option>MALE</option>
        <option>FEMALE</option>
        <option>OTHER</option>
      </select>
      <br>
      <div class="form-group">
      <label for="age">AGE:</label>
      <input name="age" type="number" class="form-control" id="number" placeholder="Enter age">
    </div>
    <div class="form-group">
      <label for="email">EMAIL:</label>
      <input name="email" type="email" class="form-control" id="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="contnum">CONTACT NUMBER:</label>
      <input name="contnum" type="text" class="form-control" id="contnum" placeholder="Enter number">
    </div>
    <div class="form-group">
      <label for="address">ADDRESS:</label>
      <input name="address" type="text" class="form-control" id="address" placeholder="Enter address">
    </div>
    <div class="form-group">
      <label for="username">USERNAME:</label>
      <input name="username" type="text" class="form-control" id="username" placeholder="username">
    </div>
    <div class="form-group">
      <label for="password">PASSWORD:</label>
      <input name="password" type="password" class="form-control" id="address" placeholder="password">
    </div>
    <input type="submit" class="btn btn-info" value="REGISTER">
    </fieldset>
    </form>
    </div>
    <?php
      if(!empty($_POST['name']) && !empty($_POST['gender']) && !empty($_POST['contnum']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && 
           !empty($_POST['address'])  && !empty($_POST['age']))
      {
        $username=$_POST['username']; 
        $user = "root";
        $pasword = "";
        $db = "doctor";
        $_SESSION['username']=$_POST['username'];
       //$name=$_SESSION['name'];
        $password=$_POST['password'];
        $name=$_POST['name'];
       // $number=$_POST['contnum'];
        $_SESSION['contnum']=$_POST['contnum'];
       //$pass=$_POST['password'];
        $age=$_POST['age'];
        $address=$_POST['address'];
        $email=$_POST['email'];
        $gender=$_POST['gender'];
        $database = mysqli_connect("localhost", $user, $pasword, $db);
     if (!$database) {
     die("Conection failed : " .mysqli_connect_error());
    }
     $sql ="SELECT * FROM newpatient WHERE USERNAME='".$_SESSION['username']."'";
     $result=mysqli_query($database,$sql);
     
      if(mysqli_num_rows($result)>=1)
      {
            echo "username already exists";
      }
       else
       {
            $newsql="INSERT INTO newpatient (NAME, GENDER, AGE,EMAIL,CONTNUM,ADDRESS,USERNAME,PASSWORD) VALUES ('$name','$gender','$age','$email','{$_SESSION['contnum']}','$address','{$_SESSION['username']}','$password')";
            if(mysqli_query($database,$newsql))
            {
              
               echo "<h3>FORM HAS BEEN SUBMITTED</h3>";
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