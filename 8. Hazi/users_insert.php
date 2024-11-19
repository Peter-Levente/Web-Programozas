<?php
include 'db_connection.php';

// Felhasználó hozzáadása
function addUser($username, $password)
{
    global $con;
    $stmt = $con->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

// Alapértelmezett adatok beszúrása
function insertDefaultUser()
{
    $defaultUsername = "admin";
    $defaultPassword = "password123";

    if (addUser($defaultUsername, $defaultPassword)) {
        echo "Felhasználó sikeresen hozzáadva!";
    } else {
        echo "Hiba történt a felhasználó hozzáadásakor!";
    }
}

// Kapcsolat lezárása
function closeConnection()
{
    global $con;
    if ($con) {
        $con->close();
        echo "<br> Kapcsolat lezárva.";
    }
}

// Művelet végrehajtása
insertDefaultUser();
closeConnection();
?>
