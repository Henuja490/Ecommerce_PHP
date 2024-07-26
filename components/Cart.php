<?php 
if (!isset($_COOKIE['Username'])){
    header("Location: ../login.php");
}
require("database.php");
session_start();
function generateButtons($id) {
    return '<td><a href="Delete.php?id=' . $id . '">Delete</a></td>';
}
function getcookie(){
    if (isset($_COOKIE['Username'])){
        $name= $_COOKIE["Username"];
        echo("<li><a href='Profile.php'>$name</a></li>");
    }else{
        echo("<li><a href='../login.php'>LOGIN</a></li>");
    }
}

if(isset($_COOKIE["Username"])){
    $id = $_COOKIE["UserID"];
    $sql20= "SELECT COUNT(*) AS row_count FROM cart WHERE UserID = $id";
    $result20 = $db->query($sql20);
    $row20 = $result20->fetch_assoc();
    $sql = "SELECT product,quantity,price,product_ID FROM cart where UserID = $id";
    $result = $db->query($sql);
    $sql1 = "SELECT product,price FROM cart where UserID = $id";
    $result1 = $db->query($sql1);


}
if(isset($_POST["order"])){
    $id = $_COOKIE["UserID"];
    $sql3 = "SELECT product_ID,quantity FROM cart where UserID = $id";
    $result3 = $db->query($sql3);
    
    $price = $_SESSION["price"];
    $id = $_COOKIE["UserID"];
    
    $sql6 = "SELECT Address from users where UserID='$id'";
    $result6 = $db->query($sql6);
    $row6 = $result6->fetch_assoc();
    $address=$row6["Address"];

    $sql5 = "INSERT INTO `orders`(`OrderID`, `UserID`, `Address`, `Price`, `Order_process`) VALUES ('',$id,'$address',$price,'Pending')";
    $result7 = $db->query($sql5);
    

    $sql7 = "SELECT OrderID from orders where price=$price AND UserID=$id AND Order_process='Pending'";
    $result8 = $db->query($sql7);
    $row7 = $result8->fetch_assoc();
    $order = $row7['OrderID'];
    while($row9 = $result3->fetch_assoc()){
        $product = $row9['product_ID'];
        $quan  = $row9['quantity'];
        $sql5 = "INSERT INTO `order_details`(`OrderID`, `Product_ID`, `p_quantity`) VALUES ('$order','$product','$quan')";
        $result7 = $db->query($sql5);
        
        
       
    }
    $sql11 ="DELETE FROM `cart` WHERE UserID =$id";
    $result10 = $db->query($sql11);
    
    header("Location: Profile.php");

}



?>

<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/images-removebg-preview.png" type="image/x-icon">
    <title>Cart</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../css/Cart.css">
    <link rel="stylesheet" href="../styles.css">
   


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
                    <span class='badge badge-warning' id='lblCartCount'><?php echo($row20['row_count']) ?> </span></a></li>
                
                            
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
            <div>
                <h1>Shopping Cart</h1>
                <table border="2" >
                <tr>
                    <th>Products</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
                <?php
                while($row1= $result->fetch_assoc()){
                    echo("<tr>");
                    foreach ($row1 as $key2 => $value2) {
                        if($key2=='product_ID'){
                            continue;
                        }
                        echo("<td>$value2</td>");
                        
                        
                    }
                    echo generateButtons($row1['product_ID']);
                    echo "</tr>";
                   
                }?>
                </table>
            </div>
            
            <div class="all">
                <div class="summary">
                    <h1>Total Payment</h1>
                    <?php
                        $sum =0;
                        while($row2= $result1->fetch_assoc()){
                            
                            foreach ($row2 as $key3 => $value3) {
                                echo("$value3");
                                if($key3=="product"){
                                    echo(":-  ");
                                }else{
                                    $sum= $sum+$value3;
                                }
                               
                
                                
                            }
                            echo("<br><br>");
                            
                        
                        }
                        $_SESSION["price"]=$sum;
                        echo("<h4>Total Amount: Rs.$sum</h4>");
                    ?>
                    
                </div>
                <form  method="post">
                    <button name="order">Order the items</button>
                </form>
                
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