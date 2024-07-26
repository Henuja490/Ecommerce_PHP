<?php 
if (!isset($_COOKIE['Username'])){
    header("Location: ../login.php");
}
require("database.php");
function getcookie(){
    if (isset($_COOKIE['Username'])){
        $name= $_COOKIE["Username"];
        echo("<li><a href='Profile.php'>$name</a></li>");
    }else{
        echo("<li><a href='../login.php'>LOGIN</a></li>");
    }
}

if (isset($_COOKIE['Username'])){
    $id = $_COOKIE['UserID'];
    $sql20= "SELECT COUNT(*) AS row_count FROM cart WHERE UserID = $id";
    $result20 = $db->query($sql20);
    $row20 = $result20->fetch_assoc();
    

    $name= $_COOKIE["Username"];
    if(isset($_POST["Name"])&&isset($_POST["rating"])&&isset($_POST["Tell"])&&isset($_POST["date"])){
        $sql = "SELECT UserID from users WHERE UserName='$name'";
        $result = $db->query($sql);
        if($result){
            $row = $result->fetch_assoc();
            $id = $row["UserID"];
            $rate = $_POST["rating"];
            $desc = $_POST["Tell"];
            $date = $_POST["date"];
            $sql = "INSERT INTO feedback VALUES('','$id','$rate','$desc','$date')";
            $result = $db->query($sql);
            if($result){
                header("Location: Feedback.php");
            }else{
                $_SESSION["error"] = "Something went wrong";
                die("Connection Failed");
            }
        }else{
            $_SESSION["error"] = "Something went wrong";
            die("Connection Failed");
        }
    }
}

   

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Customer CONTACT US</title>
    <link rel="shortcut icon" href="../images/images-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/Feedback.css">
    <link href="../styles.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/Feedback.css">

</head>
<body>
    <div class="container">
    <nav> 
            <ul class="sidebar">
                <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
                <li><a href="../index.php">HOME</a></li>
                <li><a href="Product.php">PRODUCTS</a></li>
                <li><a href="Feedback.php">CONTACT US</a></li>
                <li><a href="Profile.php"><?php getcookie(); ?></a></li>
                <li><a href="Cart.php"><i class="fa-solid fa-cart-shopping"></i></i>
                    <span class='badge badge-warning' id='lblCartCount'> <?php echo($row20['row_count']) ?> </span></a></li>
                
                            
            </ul>
            <ul>
            
                <li><h3>LAK VISKAM</h3></li>
                <li class="hideOnMobile"><a href="../index.php" >HOME</a></li>
                <li class="hideOnMobile"><a href="Product.php">PRODUCTS</a></li>
                <li class="hideOnMobile"><a href="Feedback.php" >CONTACT US</a></li>
                <?php getcookie(); ?>
                <li class="hideOnMobile"><a href="Cart.php"><i class="fa-solid fa-cart-shopping" style="font-size: 24px;"></i>
                <span class='badge badge-warning' id='lblCartCount'> <?php echo($row20['row_count']) ?> </span></a></li>
                <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
                        
            </ul>
        </nav>
        <div class="content">
            <h1>CONTACT US</h1>
         
    <form method="post">
        <label for="Name" class="Name">1. Name:<br><input type="text"  name="Name"required></label><br>
        <label for="Email" class="Name">2. Email:<br><input type="email" required></label><br>
        <label for="rating" class="Name">3. How would you rate your last experience:<br></label><br>
        <div class="rating">
            <input type="radio" id="star5" name="rating" value="5"><label for="star5"></label>
            <input type="radio" id="star4" name="rating" value="4"><label for="star4"></label>
            <input type="radio" id="star3" name="rating" value="3"><label for="star3"></label>
            <input type="radio" id="star2" name="rating" value="2"><label for="star2"></label>
            
        </div><br>
        <label for="Tell" class="desc">4. Tell us a bit more about it:<br><textarea name="Tell"  cols="30" rows="10"></textarea></label><br>
        <label for="Date" class="date" >5. Do you rember the date: <br><input type="date" name="date"></label><br>
        <button class="submit">Submit</button><br>
        
    </form><br>
    <div class="aboutus" id="aboutus">
      <img src="../images/font.jpg"  width="60%">
      <h3>Address: No 358 Galle Road, Panadura 12500</h3>
      <a href="https://www.google.com/maps/place/Lak+Viskam/@6.7167,79.9075426,15z/data=!4m6!3m5!1s0x3ae24970e35893d9:0x4a1da6a732df6596!8m2!3d6.7167!4d79.9075426!16s%2Fg%2F11sg87b26g?entry=ttu" target="_blank" ><h3>View On google map</h3></a>
      <h3>Hours: 8.00am - 10.00pm</h3>
      <h3>Telephone: (+94) 071 282 8250</h3>
  </div>
    </div>
    </div>
    
    
    <div class="footer">
        <footer class="section-p1">
            <div class="col">
                <img class="logo" src="../images/images-removebg-preview.png" width="50px" height="55px">
                <h4>Contact</h4>
                <p><Stong>Address: </Stong>No 358 Galle Road, Panadura 12500</p>
                <p><Stong>Phone: </Stong>(+94) 071 282 8250</p>
                <p><Stong>Hours: </Stong>8.00am - 10.00pm, Mon - Sun</p>
            
                <div class="follow">
                    <h4>Follow Us</h4>
                    <div class="icons">
                        <i class="fa-brands fa-facebook"></i>
                        <i class="fa-brands fa-twitter"></i>
                        <i class="fa-brands fa-instagram"></i>
                        <i class="fa-brands fa-pinterest"></i>
                        <i class="fa-brands fa-youtube"></i>
                    </div>
                </div>
            </div>
            <div class="col">
                <h4>About</h4>
                <a href="#">About Us</a>
                <a href="#">Delivery Informaion</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms & Conditions</a>
                <a href="#">Contact Us</a>
            </div>

            <div class="col">
                <h4>My Accounts</h4>
                <a href="#">Sign In</a>
                <a href="#">View Cart</a>
                <a href="#">My Wish List</a>
                <a href="#">Track My Order</a>
                <a href="#">Help</a>
            </div>

                <div class="col install">
                    <h4>Install App</h4>
                    <p>Form App Store or Google Play</p>
                    <div class="row">
                        <img src="../images/WhatsApp Image 2024-03-24 at 22.35.49_3408aede.jpg">
                        <img src="../images/WhatsApp Image 2024-03-24 at 22.35.49_45cbf0c3.jpg">
                    </div>
               
                </div>

            <div class="copyright">
                <p>&copy; LAK VISKAM. All rights reserved.</p>
            </div>
        </footer>

    </div>
    <script src="../javascript/index.js"></script>
    <script src="https://kit.fontawesome.com/48406c1766.js" crossorigin="anonymous"></script>
</body>
</html>