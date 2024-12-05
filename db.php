<!-- <?php
    $conn= new mysqli("127.0.0.1", "root","", "bunae");
    if($conn->connect_error){
        die("connection failed". $conn->connect_errno);
    }
?> -->
<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "bunae";

// Create connection
$conn = mysqli_connect($server, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
