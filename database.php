<?php 
    try {
        $db = mysqli_connect("localhost","root","","lakviskam");
    } catch (\Throwable $th) {
        throw $th;
    }
    

?>