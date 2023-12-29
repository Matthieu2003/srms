
<?php

//$servername = "(localhost)\NPCJ-LOAN-LP21\LOCALDB#C9FF51E1";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "connect";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>