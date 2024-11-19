<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web_prog";

global $con;
// Kapcsolat létrehozása
$con = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} else {
    echo 'Connection successfully!' . '<br>';
}


?>
