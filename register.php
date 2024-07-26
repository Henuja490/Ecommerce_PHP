<?php 
require("database.php");
  session_start();
  
  if(isset($_POST["username"])&&isset($_POST["password"])&&isset($_POST["rep-password"])&&isset($_POST["email"])){
    unset($_SESSION["error"]);
    if($_POST["password"]===$_POST["rep-password"]){
      $name = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $address = $_POST["address"];
      $phoneno = $_POST["phoneno"];
      $sql = "SELECT UserName FROM users WHERE Email=='$email'";
      $run_s = $db->query($sql);
      
      if(!$run_s){
        $stmt = "INSERT INTO users VALUES('','$name','$email','$password','$address','$phoneno')";
      
        $run = $db->query($stmt);
        if($run){
          header("Location:login.php");
        }
      }else{
        $_SESSION["error"] = "User already exist";
        header("Location:register.php");
      }
    }else{
      $_SESSION["error"] = "Password are not matching";
      header("Location:register.php");
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/auth.css">
    
    <link rel="shortcut icon" href="./images/images-removebg-preview.png" type="image/x-icon">
</head>
<body>
  <div class="auth">
    <form method ="post">
      <h1>Register</h1>
      <input required type="text"  placeholder='username' name="username"/>
      <input required type="email"  placeholder='email' name="email"/>
      <input required type="password"  placeholder='password' name="password"/>
      <input required type="password"  placeholder='Confirm Password' name="rep-password"/>
      <input required type="text"  placeholder='Address' name="address"/>
      <input required type="text"  placeholder='PhoneNo' name="phoneno"/>
      <button>Register</button>
      <?php
      if(isset($_SESSION["error"])){
        $error = $_SESSION["error"];
        echo("<p>$error</p>");
      }
      ?>
      
      <span>Already have an account? <a href="./login.php">Login</a></span>
    </form>
  </div>
      
  
    
</body>

  

</html>