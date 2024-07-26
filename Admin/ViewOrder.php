<?php
require("database.php");
session_start();


if(isset($_GET["id"])){
  $id = $_GET["id"];
  $sql = "SELECT product_details.Quantity,products.Name,order_details.p_quantity FROM order_details INNER JOIN product_details ON order_details.Product_ID=product_details.product_ID Inner Join products ON product_details.ProductID=products.ProductID WHERE order_details.OrderID='$id'";
  $result = $db->query($sql);
  $result1 = $db->query($sql);
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="AdminDashboard.css">
    <link rel="shortcut icon" href="../images/images-removebg-preview.png" type="image/x-icon">
    <title>View order</title>
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
                    
                    echo "</tr>";
                    
                    echo "</tr>";
                }
                
    
                echo "</table>";
            } else {
                echo "0 results";
            }
            ?>
    </body>
    

</html>

