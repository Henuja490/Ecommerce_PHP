<?php 
if(isset($_COOKIE['Username'])){
    require('database.php');
    $id = $_COOKIE['UserID'];
    $sql20= "SELECT COUNT(*) AS row_count FROM cart WHERE UserID = $id";
    $result20 = $db->query($sql20);
    $row20 = $result20->fetch_assoc();
}

function getcookie(){
    
    if (isset($_COOKIE['Username'])){
        $name= $_COOKIE["Username"];
        
        
        echo("<li><a href='./components/Profile.php'>$name</a></li>");
    }else{
        echo("<li><a href='login.php'>LOGIN</a></li>");
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lak viskam-Home page</title>
    <link rel="shortcut icon" href="./images/images-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="styles.css">
    
    
</head>
<body>
    <div class="nav">
        <nav> 
            <ul class="sidebar">
                <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
                <li><a href="index.php">HOME</a></li>
                <li><a href="./components/Product.php">PRODUCTS</a></li>
                <li><a href="./components/Feedback.php">CONTACT US</a></li>
                <li><a href="./components/Profile.php"><?php getcookie(); ?></a></li>
                <li><a href="./components/Cart.php"><i class="fa-solid fa-cart-shopping"></i></i>
                    <span class='badge badge-warning' id='lblCartCount'> <?php if(isset($_COOKIE['Username'])) {
                        echo($row20['row_count']) ;
                    }?> </span></a></li>
                
                            
            </ul>
            <ul>
            
                <li><h3>LAK VISKAM</h3></li>
                <li class="hideOnMobile"><a href="index.php" >HOME</a></li>
                <li class="hideOnMobile"><a href="./components/Product.php">PRODUCTS</a></li>
                <li class="hideOnMobile"><a href="./components/Feedback.php" >CONTACT US</a></li>
                <?php getcookie(); ?>
                <li class="hideOnMobile"><a href="./components/Cart.php"><i class="fa-solid fa-cart-shopping" style="font-size: 24px;"></i>
                <span class='badge badge-warning' id='lblCartCount'> <?php if(isset($_COOKIE['Username'])) {
                        echo($row20['row_count']) ;
                    } ?> </span></a></li>
                <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
                        
            </ul>
        </nav>
    </div>
    
    <div class="container">
        <div class="slideshow-container">
            <div class="mySlides fade">
                <div class="numbertext">1/ 3</div>
                <img src="./images/photo.jpg" style="width:100%">
                <div class="text">Masks</div>
              </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="./images/Spicies.png" style="width:100%">
                <div class="text">Species</div>
            </div>

            <div class="mySlides fade">
              <div class="numbertext">3 / 3</div>
              <img src="./images/handicraft.jpg" style="width:100%">
              <div class="text">Handicraft items</div>
            </div>
            
            
            
            
            
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
            
            
        </div><br><br>
        <h1 class="text-h2">Categories</h1><br><br>
        <div class="category">
            <div class="cat">
                <img src="./images/handicraft.jpg" alt="" width="300">
                <a href="./components/Product.php"><h2>HANDICRAFT ITEMS </h2></a>
                
            </div>
            <div class="cat">
                <img src="./images/Spicies.png" alt="" width="300">
                <a href="./components/Product.php"><h2>TEA AND SPECIES </h2></a>
                
            </div>
            
            <div class="cat">
                <img src="./images/photo.jpg" alt="" width="300">
                <a href="./components/Product.php"><h2>ARTS AND CRAFTS</h2> </a>
                
            </div>
            <div class="cat">
                <img src="./images/Brass.jpg" alt="" width="300">
                <a href="./components/Product.php"><h2>BRASS AND LAQUER WARE</h2> </a>
                
            </div>
            <div class="cat">
                <img src="./images/leather.jpg" alt="" width="300">
                <a href="./components/Product.php"><h2>LEATHER AND CERAMIC</h2> </a>
                
            </div>
            <div class="cat">
                <img src="./images/Musical.jpg" alt="" width="300">
                <a href="./components/Product.php"><h2>MUSICAL INSTRUMENTS</h2> </a>
                
            </div>
        </div><br><br>
        
    </div>
    <div class="footer">
        <footer class="section-p1">
            <div class="col">
                <img class="logo" src="./images/images-removebg-preview.png" width="50px" height="55px">
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
                <a href="./components/Feedback.php#aboutus">About Us</a>
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
                        <img src="./images/WhatsApp Image 2024-03-24 at 22.35.49_3408aede.jpg">
                        <img src="./images/WhatsApp Image 2024-03-24 at 22.35.49_45cbf0c3.jpg">
                    </div>
               
                </div>

            <div class="copyright">
                <p>&copy; LAK VISKAM. All rights reserved.</p>
            </div>
        </footer>

    </div>
    <script src="./javascript/index.js"></script>
    <script src="https://kit.fontawesome.com/48406c1766.js" crossorigin="anonymous"></script>
</body>
</html>