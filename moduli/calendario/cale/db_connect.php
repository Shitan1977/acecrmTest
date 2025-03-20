<?php
/* Database connection start */
$servername = "localhost";
$username = "Shitan";
$password = "!Demetrio1977Adele";
$dbname = "admin_silvestro";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>