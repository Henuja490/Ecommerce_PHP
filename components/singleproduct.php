<?php
session_start(); 
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

if(isset($_GET["id"])) {
    $id_u = $_COOKIE['UserID'];
    $sql20= "SELECT COUNT(*) AS row_count FROM cart WHERE UserID = $id_u";
    $result20 = $db->query($sql20);
    $row20 = $result20->fetch_assoc();

    $id = $_GET["id"];
    $sql4 = "SELECT image from products WHERE ProductID='$id'";
    $result4=$db->query($sql4);
    $row=$result4->fetch_assoc();

    $sql = "SELECT Quantity FROM product_details WHERE ProductID='$id'";
    $result = $db->query($sql);

    $sql1 = "SELECT Quantity,Price FROM product_details WHERE ProductID='$id'";
    $result2 = $db->query($sql1);

    $sql = "SELECT Quantity,Price FROM product_details WHERE ProductID='$id'";
    $result3 = $db->query($sql);

    if(isset($_POST["cart"])){
        if(isset($_POST['myclass'])){
            $item = $_POST['myclass'];
            $sql2 = "SELECT product_ID,Price,Stock FROM product_details WHERE ProductID='$id' AND Quantity='$item'";
            $result4 = $db->query($sql2);
            $desc = $result4->fetch_assoc();
            if(isset($_POST['Quantity'])){
                if($_POST['Quantity']<=$desc['Stock']){
                    $ref_id=$desc['product_ID'];
                    $sql = "SELECT products.Name,products.image FROM product_details INNER JOIN products ON products.ProductID=product_details.ProductID where product_details.product_ID=$ref_id ";
                    $result =$db->query($sql);
                    $row=$result->fetch_assoc();
                    $name = $row['Name'];
                    $user_id = $_COOKIE['UserID'];
                    $price = $_POST['Quantity']*$desc['Price'];
                    $quantity = $_POST['Quantity'];
                    $sql1 = "INSERT INTO `cart`(`UserID`, `product`,`product_ID`, `price`, `quantity`) VALUES ($user_id,'$name',$ref_id,$price,$quantity)";

                    $result4 = $db->query($sql1);
                    $stock = $desc['Stock'];
                    $si = $stock - $_POST['Quantity'];
                    $sql25 = "UPDATE product_details SET Stock = '$si' WHERE product_ID= $ref_id ";
                    
                    $result20 = $db->query($sql25);
                    unset($_SESSION['p_error']);
                    header("Location: Product.php");
                }else{
                    $_SESSION["p_error"]= "Not that much stock is available";
                }
                
        
                
                

            }
        }
        
    }
    
    
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Single product</title>
    <link rel="shortcut icon" href="../images/images-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="../css/singleproduct.css">
    
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
                <span class='badge badge-warning' id='lblCartCount'> <?php echo($row20['row_count']) ?></span></a></li>
                <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="M120 816v-60h720v60H120Zm0-210v-60h720v60H120Zm0-210v-60h720v60H120Z"/></svg></a></li>
                        
            </ul>
        </nav>
        <div class="content">
            <img src="../Project/<?php echo($row["image"]) ?>" width="350" >
           
                

            <div class="quantity">
            <?php
      if(isset($_SESSION["p_error"])){
        $error = $_SESSION["p_error"];
        echo("<p style='color: red;'>$error</p>");
      }?>
              
                <form method="post">
                    Quantity:
                    <input type="number" name="Quantity" value='1' min="1" max="5">
                    Size: 
                    <select name="myclass">
                    <?php
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                                foreach ($row as $key2 => $value2) {?>
                                    <option value="<?php echo($value2); ?>"><?php echo($value2);?><option>
                                    
                                <?php } ?>
                            <?php } ?>
                            
                    
                        <?php } ?>
                    </select>
                    
                    <?php
            if($result2){
                echo("<table><tr>");
                while($row= $result2->fetch_assoc()){
                    foreach ($row as $key1 => $value1) {
                       echo("<th>$key1</th>");
                    }
                    echo("</tr>");
                    break;
                }

                while($row1= $result3->fetch_assoc()){
                    echo("<tr>");
                    foreach ($row1 as $key2 => $value2) {
                       echo("<td>$value2</td>");
                    }
            
                    echo "</tr>";
                }
                
    
                echo "</table>";
            } else {
                echo "0 results";
            }?>
                    </table>

                    
                    
                    <button class="Add-to-cart" name="cart">Add to cart</button>
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