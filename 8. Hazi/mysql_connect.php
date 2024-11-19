<?php
include 'db_connection.php';

// Funkció az adatbázis létrehozásához
function createDatabase()
{
    global $con;
    $sql = "CREATE DATABASE IF NOT EXISTS web_prog";
    if ($con->query($sql) === TRUE) {
        echo "<br> Database created successfully";
    } else {
        echo "Error creating database: " . $con->error;
    }
}

// Funkció az adatbázis kiválasztásához
function selectDatabase()
{
    global $con;
    $con->select_db("web_prog");
}

// Funkció a táblák létrehozásához
function createTable($tableName, $tableSql)
{
    global $con;
    $stmt = $con->prepare($tableSql);
    if ($stmt->execute()) {
        echo "<br> '$tableName' table created successfully";
    } else {
        echo "Error creating '$tableName' table: " . $stmt->error;
    }
    $stmt->close();
}

// Funkció a kapcsolat lezárásához
function closeConnection()
{
    global $con;
    if ($con) {
        $con->close();
        echo "<br> Connection closed successfully";
    }
}

// Adatbázis létrehozása és kiválasztása
createDatabase();
selectDatabase();

// Táblák létrehozása
$hallgatokSql = "CREATE TABLE IF NOT EXISTS hallgatok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL,
    szak VARCHAR(255) NOT NULL,
    atlag DOUBLE NOT NULL
)";
createTable('hallgatok', $hallgatokSql);

$usersSql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";
createTable('users', $usersSql);

// Kapcsolat lezárása
closeConnection();
?>
