<?php
require("database.php");
session_start();
if(isset($_GET["id"])){
    $id = $_GET["id"];
    if(isset($_POST["cancel"])){
        header("Location: View.php");
    }else if(isset($_POST["delete"])){
        $sql="DELETE FROM product_details WHERE product_ID='$id'";
        $result=$db->query($sql);
        header("Location:View.php");
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
        <h1 id="Delete">Delete product</h1>
        <div class="Addproducts" >
            
            <form method="post">
                <label>DO YOU WANT TO DELETE</label>
                <button name="cancel">Cancel</button>
                <button name="delete">Delete</button>
            </form>
    
</body>
</html>