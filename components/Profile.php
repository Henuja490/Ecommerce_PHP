
<?php 
if (!isset($_COOKIE['Username'])){
    header("Location: ../login.php");
}
function getcookie(){
    if (isset($_COOKIE['Username'])){
        $name= $_COOKIE["Username"];
        echo("<li><a href='Profile.php'>$name</a></li>");
    }else{
        echo("<li><a href='../login.php'>LOGIN</a></li>");
    }
}
require("database.php");
if (isset($_COOKIE["Username"])){
    $id = $_COOKIE['UserID'];
    $sql20= "SELECT COUNT(*) AS row_count FROM cart WHERE UserID = $id";
    $result20 = $db->query($sql20);
    $row20 = $result20->fetch_assoc();
    
    $name = $_COOKIE["Username"];
    $sql = "SELECT Address,Phoneno FROM users WHERE UserName ='$name'";
    $result = $db->query($sql);
    if($result){
        $stmt = $result->fetch_assoc();
    }
    $id = $_COOKIE["UserID"];
    $sql1 = "SELECT orders.OrderID,users.Address,users.Phoneno,orders.Order_process  FROM orders INNER JOIN users ON users.UserID=orders.UserID WHERE users.UserID='$id'";
    $result1 = $db->query($sql1);
    $result2 = $db->query($sql1);

}

if (isset($_POST["Address"])&&isset($_POST["phoneno"])) {
    $name = $_COOKIE["Username"];
    
    $sql = "SELECT Address,Phoneno FROM users WHERE UserName ='$name'";
    $result = $db->query($sql);
    if($result){
        $stmt = $result->fetch_assoc();
        if($_POST["Address"]===$stmt["Address"]&&$_POST["phoneno"]===$stmt["Phoneno"]){
            if(!($_POST["phoneno"]===$stmt["Phoneno"])){
                $pn=$_POST["phoneno"];
                $sql1 = "UPDATE users SET Phoneno = '$pn' WHERE users.UserName = '$name'";
                $result1 = $db->query($sql1);
                header("Location: Profile.php");
            }else if(!($_POST["Address"]===$stmt["Address"])){
                $pn=$_POST["Address"];
                $sql1 = "UPDATE users SET Address = '$pn' WHERE users.UserName = '$name'";
                $result1 = $db->query($sql1);
                header("Location: Profile.php");
            }

        }else{
            $pn=$_POST["Address"];
            $p=  $_POST["phoneno"];
            $sql2 = "UPDATE users SET Address = '$pn',Phoneno = '$p' WHERE users.UserName = '$name'";
            $result2 = $db->query($sql2);
            header("Location: Profile.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/images-removebg-preview.png" type="image/x-icon">
    
    <title>Profile</title>
    <link href="../styles.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="../css/Profile.css">

</head>
<body>
    <div class="container">
    <nav> 
            <ul class="sidebar">
                <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26" viewBox="0 96 960 960" width="26"><path d="m249 849-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg></a></li>
                <li><a href="../index.php">HOME</a></li>
                <li><a href="Product.php">PRODUCTS</a></li>
                <li><a href="Feedback.php">CONTACT US</a></li>
                <?php getcookie(); ?>
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
    </div>
    <div class="content">

            
            <form  method="post" class="user">
                <img src="../images/istockphoto-1300845620-612x612.jpg" width="250">
                <label>Name:<?php echo("<h2>$name</h2>") ?></label>
                <label>Address:<input type="text" name="Address"  value="<?php echo($stmt['Address']) ?>"></label>
                <label>Phone no: <input type="tel"  name="phoneno" value="<?php echo($stmt['Phoneno']) ?>"></label>
                <button>Update</button>
                <p>To use different account : <a href="../login.php">Login</a></p><br>
                <p>To Logout : <a href="../logout.php">Logout</a></p><br><br>
            </form>
            
            
            
       
        <div class="orders">
            <?php
        if($result){
                echo("<table><tr>");
                while($row= $result1->fetch_assoc()){
                    foreach ($row as $key1 => $value1) {
                       echo("<th>$key1</th>");
                    }
                    echo("</tr>");
                    break;
                }

                while($row1= $result2->fetch_assoc()){
                    echo("<tr>");
                    foreach ($row1 as $key2 => $value2) {
                       echo("<td>$value2</td>");
                       
                    }
            
                    echo "</tr>";
                    
                    echo "</tr>";
                }
                
    
                echo "</table>";
            } else {
                echo "0 results";
            }
            ?>
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