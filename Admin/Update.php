<?php
require("database.php");
session_start();


if(isset($_GET["id"])){
  $id = $_GET["id"];
  $sql = "SELECT product_details.product_ID,products.Name,products.image,
  products.Description,products.cat,product_details.Price,product_details.Stock,product_details.Avalability,product_details.Quantity FROM products INNER JOIN product_details ON products.ProductID=product_details.ProductID WHERE product_details.product_ID ='$id'";
  $result = $db->query($sql);
  $row = $result->fetch_assoc();
  
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = $_POST["pname"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $Stock = $_POST["Stock"];
    $available = $_POST["available"];
    $update_sql = "UPDATE products 
                   INNER JOIN product_details 
                   ON products.ProductID = product_details.ProductID 
                   SET product_details.Price = '$price',
                       product_details.Stock = '$quantity',
                       product_details.Quantity = '$Stock',
                       product_details.Avalability = '$available'
                   WHERE product_details.product_ID = '$id'";

    if($db->query($update_sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $db->error;
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
        <h1 id="Update">Update product</h1>
        <div class="Updateproducts">
            
            
            <form method="post">
            image : <img src="<?php echo('../Project/'.$row["image"])?>" alt="" srcset="" width="200">
                Product Name: <input type="text" placeholder="Product name" name="pname" value="<?php echo($row["Name"])?>">
                Category: <input type="text" value="<?php echo($row["cat"]) ?>">
                
                Quantity: <input type="text" placeholder="Quantity" name="Stock" value="<?php echo($row["Quantity"])?>">
                Price: <input type="text" placeholder="Price" name="price" value="<?php echo($row["Price"])?>">
                Stock: <input type="text" placeholder="Quantity" name="quantity" value="<?php echo($row["Stock"])?>">
                Avalability: <select name="available">
                    <option value="Available">Available</option>
                    <option value="Outofstock">Outofstock</option>
                </select>
                
                <button>Submit</button>
            </form>
        </div>
    
</body>
</html>