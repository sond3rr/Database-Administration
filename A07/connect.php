<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "data";


$conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function executeQuery($query){
    global $conn;
    return mysqli_query($conn, $query);
}
?>
