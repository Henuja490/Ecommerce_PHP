<?php
session_start();
setcookie("UserID", "", time()-3600);
setcookie("Username", "", time()-3600);
header("Location: index.php");
?>
