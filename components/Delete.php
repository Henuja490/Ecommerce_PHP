<?php
    require('database.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'] ;
        $user_id = $_COOKIE['UserID'];
        $sql = "SELECT Stock from product_details WHERE product_ID=$id";
        $result = $db->query($sql);
        $row= $result->fetch_assoc();

        $now_stock = $row['Stock'];
        $sql1 = "SELECT quantity from Cart WHERE product_ID=$id AND UserID=$user_id ";
        $result1 = $db->query($sql1);
        $row1= $result1->fetch_assoc();

        $stock = $now_stock+ $row1['quantity'];
        $sql3 = "UPDATE product_details SET Stock = $stock WHERE product_ID= $id  ";
        $result2 = $db->query($sql3);

        $sql2 = "DELETE from cart WHERE product_ID=$id AND UserID=$user_id ";
        $result3 = $db->query($sql2);
        header("Location: Cart.php");
    }
?>