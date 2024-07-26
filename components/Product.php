<?php

function getcookie(){
    if (isset($_COOKIE['Username'])){
        $name= $_COOKIE["Username"];
        echo("<li><a href='Profile.php'>$name</a></li>");
    }else{
        echo("<li><a href='../login.php'>LOGIN</a></li>");
    }
}
require("database.php");
     
         
    if(isset($_COOKIE["UserID"])){
        $id = $_COOKIE["UserID"];
    $sql20= "SELECT COUNT(*) AS row_count FROM cart WHERE UserID = $id";
    $result20 = $db->query($sql20);
    $row20 = $result20->fetch_assoc();
    }
    

    $sql = "SELECT DISTINCT products.Name,products.image,product_details.Avalability,products.ProductID FROM products INNER JOIN product_details ON products.ProductID = product_details.ProductID WHERE products.cat = 'Handicraft' AND product_details.Avalability ='Available';";
    $result = $db->query($sql);
    $name = "";
    if(isset($_GET["txt-search"])){
        $name = $_GET["txt-search"];
        if($name){
            $sql7 = "SELECT DISTINCT products.Name,products.image,product_details.Avalability,products.ProductID,products.cat FROM products INNER JOIN product_details ON products.ProductID = product_details.ProductID WHERE products.Name LIKE '%$name%' AND product_details.Avalability ='Available'";
            $result7 = $db->query($sql7);
        }
    }
    
    function generateButtons($id) {
        return '<a href="singleproduct.php?id=' . $id . '">';
    }
            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="shortcut icon" href="../images/images-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../css/Products.css">
</head>
<body>
    <div class="nav">
    <nav> 
            <ul class="sidebar">
                <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
                <li><a href="../index.php">HOME</a></li>
                <li><a href="Product.php">PRODUCTS</a></li>
                <li><a href="Feedback.php">CONTACT US</a></li>
                <li><a href="Profile.php"><?php getcookie(); ?></a></li>
                <li><a href="Cart.php"><i class="fa-solid fa-cart-shopping"></i></i>
                    <span class='badge badge-warning' id='lblCartCount'> <?php if(isset($_COOKIE['Username'])) {
                        echo($row20['row_count']) ;
                    } ?></span></a></li>
                
                            
            </ul>
            <ul>
            
                <li><h3>LAK VISKAM</h3></li>
                <li class="hideOnMobile"><a href="../index.php" >HOME</a></li>
                <li class="hideOnMobile"><a href="Product.php">PRODUCTS</a></li>
                <li class="hideOnMobile"><a href="Feedback.php" >CONTACT US</a></li>
                <?php getcookie(); ?>
                <li class="hideOnMobile"><a href="Cart.php"><i class="fa-solid fa-cart-shopping" style="font-size: 24px;"></i>
                <span class='badge badge-warning' id='lblCartCount'> <?php if(isset($_COOKIE['Username'])) {
                        echo($row20['row_count']) ;
                    } ?></span></a></li>
                <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
                        
            </ul>
        </nav>
    </div>
    <div class="content">
        <div class="search">
            <form method="get">
                <input type="text" placeholder="Search" class="search-input" name="txt-search">
            </form>
        </div>
        <?php 
        if(isset($result7)){
            $card ="";
                echo("<div class='species'>");
                if($result7->num_rows>0){
                    while($row = $result7->fetch_assoc()) {
                        $id = $row["ProductID"];
                        $card.= "<div class='product' >
                            <img src='../Project/{$row["image"]}'  width=200>
                            <h2>{$row["Name"]}</h2> 
                            <p>{$row["cat"]}</p> 
                            <a href='singleproduct.php?id=$id'><button class='Add-to-cart'>View product</button></a>
                        </div>";
                    }
                    echo $card;
                    echo("</div>");
                }else{
                    echo("<h1>NO RESULTS</h1>");
                    echo("</div>");
                }
                
            
        }else{?>
            <div class="Products">
            <h1>HANDICRAFT ITEMS</h1><br><br>
            <div class="handicraft">
               
                <?php
                
                $card ="";
                while($row1 = $result->fetch_assoc()) {
                    
                        $id = $row1["ProductID"];
                        $card.= "<div class='product' >
                        <img src='../Project/{$row1["image"]}' width=200>
                        <h2>{$row1["Name"]}</h2>  
                        <a href='singleproduct.php?id=$id'><button class='Add-to-cart'>View product</button></a>
                    </div>";
                
                    
                }
                echo $card;
                ?><br>
            </div>
            
                
            <h1>TEA AND SPECIES</h1><br><br>
            <div class="species ">
                <?php
                    $sql1 = "SELECT DISTINCT products.Name,products.image,product_details.Avalability,products.ProductID FROM products INNER JOIN product_details ON products.ProductID = product_details.ProductID WHERE products.cat = 'Species' AND product_details.Avalability ='Available'";
                    $result1 = $db->query($sql1);
                    $card1 ="";

                    while($row1 = $result1->fetch_assoc()) {
                        $id = $row1["ProductID"];
                        $card1.= "<div class='product'>
                           <img src='../Project/{$row1["image"]}' width=200>
                            <h2>{$row1["Name"]}</h2>  
                            <a href='singleproduct.php?id=$id'><button class='Add-to-cart'>View product</button></a>
                        </div>";
                    }
                        echo $card1;
                        ?><br>
            </div>
            <h1>ARTS AND CRAFTS</h1><br><br>
            <div class="Masks">
                
            <?php
                    $sql2 = "SELECT DISTINCT products.Name,products.image,product_details.Avalability,products.ProductID FROM products INNER JOIN product_details ON products.ProductID = product_details.ProductID WHERE products.cat = 'Masks' AND product_details.Avalability ='Available'";
                    $result2 = $db->query($sql2);
                    $card2 ="";
                    while($row2 = $result2->fetch_assoc()) {
                        $id = $row2["ProductID"];
                        $card2.= "<div class='product'>
                            <img src='../Project/{$row2["image"]}' width=200>
                            <h2>{$row2["Name"]}</h2>  
                            <a href='singleproduct.php?id=$id'><button class='Add-to-cart'>View product</button></a>
                        </div>";
                    }
                        echo $card2;
                        ?><br>
            </div>
            <h1>BRASS AND LAQUER WARE</h1><br><br>
            <div class="Masks">
                
            <?php
                    $sql2 = "SELECT DISTINCT products.Name,products.image,product_details.Avalability,products.ProductID FROM products INNER JOIN product_details ON products.ProductID = product_details.ProductID WHERE products.cat = 'Brass and Laquerware' AND product_details.Avalability ='Available'";
                    $result2 = $db->query($sql2);
                    $card2 ="";
                    while($row = $result2->fetch_assoc()) {
                        $id = $row["ProductID"];
                        $card2.= "<div class='product'>
                            <img src='../Project/{$row["image"]}' width=200>
                            <h2>{$row["Name"]}</h2>  
                            <a href='singleproduct.php?id=$id'><button class='Add-to-cart'>View product</button></a>
                        </div>";
                    }
                        echo $card2;
                        ?><br>
            </div>
            <h1>LEATHER AND CERAMIC</h1><br><br>
            <div class="Masks">
                
            <?php
                    $sql2 = "SELECT DISTINCT products.Name,products.image,product_details.Avalability,products.ProductID FROM products INNER JOIN product_details ON products.ProductID = product_details.ProductID WHERE products.cat = 'Leather and ceramic' AND product_details.Avalability ='Available'";
                    $result2 = $db->query($sql2);
                    $card2 ="";
                    while($row2 = $result2->fetch_assoc()) {
                        $id = $row2["ProductID"];
                        $card2.= "<div class='product'>
                            <img src='../Project/{$row2["image"]}' width=200>
                            <h2>{$row2["Name"]}</h2>  
                            <a href='singleproduct.php?id=$id'><button class='Add-to-cart'>View product</button></a>
                        </div>";
                    }
                        echo $card2;
                        ?><br>
            </div>
    
            
                
            <h1>MUSICAL INSTRUMENTS</h1><br><br>
            <div class="Masks">
                
            <?php
                    $sql2 = "SELECT DISTINCT products.Name,products.image,product_details.Avalability,products.ProductID FROM products INNER JOIN product_details ON products.ProductID = product_details.ProductID WHERE products.cat = 'Musical' AND product_details.Avalability ='Available'";
                    $result2 = $db->query($sql2);
                    $card2 ="";
                    while($row2 = $result2->fetch_assoc()) {
                        $id = $row2["ProductID"];
                        $card2.= "<div class='product'>
                            <img src='../Project/{$row2["image"]}' width=200 >
                            <h2>{$row2["Name"]}</h2>  
                            <a href='singleproduct.php?id=$id'><button class='Add-to-cart'>View product</button></a>
                        </div>";
                    }
                        echo $card2;
                        ?><br>
            </div>
    </div>
       <?php }?>
        
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