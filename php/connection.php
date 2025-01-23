<?php
$servername = "localhost";
$user = "root";
$pass = "your_password"; // edit if you have set a password
$name = "CAT1";

$conn = new mysqli($servername, $user, $pass, $name);

if($conn == TRUE){
 	echo "Connection succesful";
}

else if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
