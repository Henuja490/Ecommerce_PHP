<?php
require("database.php");
session_start();

if(isset($_POST["submit"])){
    unset($_SESSION["error"]);
      $name = $_POST["pname"];
      $email = $_POST["cat"];

      $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = "../Project/" . $filename;
    move_uploaded_file($tempname, $folder);

      $quantity = $_POST["quantity"];
      $address = $_POST["pdesc"];
      $phoneno = $_POST["price"];
      $ava = $_POST["available"];
      $stock = $_POST["Stock"];
      $sql = "SELECT ProductID FROM products WHERE Name='$name'";
      $run_s = $db->query($sql);
      
      if($run_s){
        $stmt = "INSERT INTO products VALUES('','$name','$address','$filename','$email')";
      
        $run = $db->query($stmt);
        $query = "SELECT ProductID FROM products WHERE Name='$name'";
        $result = $db->query($query);
        $row =  $result->fetch_assoc();
        $id = $row["ProductID"];
        $stmt = "INSERT INTO product_details VALUES('','$id','$quantity','$phoneno','$ava','$stock')";
      
        $run = $db->query($stmt);
        
      }else{
        $row =  $run_s->fetch_assoc();
        $id = $row["ProductID"];
        $stmt = "INSERT INTO product_details VALUES('','$id','$quantity','$phoneno','$ava','$stock')";
      
        $run = $db->query($stmt);
      }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="shortcut icon" href="../images/images-removebg-preview.png" type="image/x-icon">
    <link rel="stylesheet" href="AdminDashboard.css">
</head>
<body>
    <div class="container">
        
        <header>
            <h4 class="logo">LAK VISKAM</h4>
            
            <nav>
            <ul>
                <li > <a href="AdminDashboard.php">Add Product</a></li>
                <li><a href="View.php">View Products</a></li>
                <li><a href="Order.php">Order Details</a></li>
                <li><a href="Feedback.php">Feedback Details</a></li>
                
            </ul>
            </nav>
        </header>
        <h1 class="Add" id="Add">Add product</h1>
        <div class="Addproducts" >
            
            <form method="post" enctype="multipart/form-data">
                <input type="text" placeholder="Product name" name="pname">
                <select name="cat">
                    <option value="Handicraft">Handicraft items</option>
                    <option value="Spicies">Species</option>
                    <option value="Masks">Masks</option>
                </select>
                <input type="file" name="image" id="">
                <textarea name="pdesc" id="" cols="30" rows="10"   placeholder="Product Description"></textarea>
                <input type="text" placeholder="Price" name="price">
                <input type="text" placeholder="Quantity" name="quantity">
                <input type="text" placeholder="Stock" name="Stock">
                <select name="available">
                    <option value="Out of stock">Out of stock</option>
                    <option value="Available">Available</option>
                </select>
                <button name="submit">Submit</button>
            </form>
            
    
        </div>
        
            
    
    
        
        
        
    </div>
    
</body>
</html>