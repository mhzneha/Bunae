<?php
    $conn= new mysqli("127.0.0.1", "root","", "bunae");
    if($conn->connect_error){
        die("connection failed". $conn->connect_errno);
    }
?>