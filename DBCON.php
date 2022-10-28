<?php
$servername = "localhost";
$username = "Gooba";
$password = "";
$dbname = "library";
//Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);
//Check Connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
