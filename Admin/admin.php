<?php 
session_start();
 if(isset($_POST["username"])&&isset($_POST["pw"])){
    $username = $_POST["username"];
    $pw = $_POST["pw"]; 
    if($username==="LakViskam"){
      if ($pw==="Lakviskam123456") {
        setcookie("admin","logged",time()+36000);
        header("Location: View.php");
      }else{
        $_SESSION["error"] = "Something went wrong";
        header("Location: admin.php");
        

      }
    }
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="shortcut icon" href="../images/images-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/auth.css">
</head>
<body>
    <div class="auth">
        <form method="post">
          <h1> Admin Login</h1>
          <input required type="text"   name="username" placeholder='username'/>
          <input required type="password"  name="pw" placeholder='password'/>
          <button>Login</button>
          <?php
      if(isset($_SESSION["error"])){
        $error = $_SESSION["error"];
        echo("<p style='color:red'>$error</p>");
      }
      ?>       
          
        </form>
    
      </div>  
</body>
</html>