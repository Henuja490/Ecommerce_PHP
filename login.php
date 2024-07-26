<?php
  require("database.php");
  
  session_start();

  if(isset($_POST["username"])&&isset($_POST["password"])){
    $name = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT Password,UserID FROM users WHERE UserName='$name'";
    $run = $db->query($sql);
    if($run){
      $row = $run->fetch_assoc();
      if($password===$row["Password"]){
        setcookie('Username',$name,time()+36000);
        setcookie('UserID',$row['UserID'],time()+36000);
        unset($_SESSION['error']);
        header("Location: index.php");
      }else{
        $_SESSION["error"] = "Check you password and username";
        header("Location: login.php");
      }
    }else{
      $_SESSION["error"] = "Check you password and username";
      header("Location: login.php");
    }
  }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="./images/images-removebg-preview.png" type="image/x-icon">
    <title>Login</title>
    <link rel="stylesheet" href="./css/auth.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  
    <div class="auth">
      <form method="post">
        <h1>Login</h1>
        <input required type="text"  placeholder='username'  name='username'/>
        <input required type="password"  placeholder='password' name='password'/>
        <button>Login</button>

        <?php
      if(isset($_SESSION["error"])){
        $error = $_SESSION["error"];
        echo("<p>$error</p>");
      }
      ?>
        <span>Don't you have an account? <a href="./register.php">Register</a><br><br>
      </form>
  
    </div>  
    
    
</body>
</html>