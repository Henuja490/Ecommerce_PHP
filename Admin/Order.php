<?php
    require("database.php");
    $sql = "SELECT users.UserName,orders.OrderID,users.Address,users.Phoneno,orders.Order_process  FROM orders INNER JOIN users ON users.UserID=orders.UserID WHERE orders.Order_Process != 'Delivered'";
    $result = $db->query($sql);
    $result1 = $db->query($sql);

    function generateButtons($id) {
        return '<td><a href="UpdateOrder.php?id=' . $id . '">Update</a></td><td><a href="ViewOrder.php?id=' . $id . '">View</a></td>';
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
        <h1 id="Order">Order Details</h1>
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
                    echo generateButtons($row1['OrderID']);
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