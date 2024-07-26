<?php
require("database.php");
session_start();


if(isset($_GET["id"])){
  $id = $_GET["id"];
  $sql = "SELECT users.UserName,users.Address,users.Phoneno,orders.Order_process  FROM orders INNER JOIN users ON users.UserID=orders.UserID WHERE orders.OrderID='$id';";

  $result = $db->query($sql);
  $row = $result->fetch_assoc();
  
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $available = $_POST["available"];
    $update_sql = "UPDATE  orders
                   SET  Order_process = '$available'
                   WHERE OrderID='$id'";

    if($db->query($update_sql) === TRUE) {
        header("Location: Order.php");
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
                UserName: <input type="text" placeholder="Product name" name="pname" readOnly value="<?php echo($row["UserName"])?>">
                Address: <input type="text" readOnly value="<?php echo($row["Address"]) ?>">
                Phoneno: <input type="text" readOnly placeholder="Phone number" name="Stock" value="<?php echo($row["Phoneno"])?>">
                Avalability: <select name="available">
                    <option value="Pending">Pending</option>
                    <option value="Preparing">Preparing</option>
                    <option value="Delivered">Delivered</option>
                    
                </select>
                
                <button>Submit</button>
            </form>
        </div>
    
</body>
</html>