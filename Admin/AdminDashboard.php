<?php

require("database.php");
if(isset($_COOKIE["admin"])){
    $sql = "SELECT product_details.product_ID,products.Name,products.Description,products.cat,product_details.Price,product_details.Stock,product_details.Avalability FROM products INNER JOIN product_details ON products.ProductID=product_details.ProductID ";
    $result = $db->query($sql);
    $result1 = $db->query($sql);
    function generateButtons($id) {
        return '<td><a href="Update.php?id=' . $id . '">Update</a></td><td><a href="Delete.php?id=' . $id . '">Delete</a></td>';
    }
    

   
}else{
    header("Location: admin.php");
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
        <h1 class="Add" id="Add">View products</h1>
        <?php
            if($result){
                echo("<table><tr>");
                while($row= $result->fetch_assoc()){
                    foreach ($row as $key1 => $value1) {
                       echo("<th>$key1</th>");
                    }
                    echo("</tr>");
                    break;
                }

                while($row1= $result1->fetch_assoc()){
                    echo("<tr>");
                    foreach ($row1 as $key2 => $value2) {
                       echo("<td>$value2</td>");
                    }
                    echo generateButtons($row1['product_ID']);
                    echo "</tr>";
                }
                
    
                echo "</table>";
            } else {
                echo "0 results";
            }
            
                


            
    
    ?>
    
</body>
</html>