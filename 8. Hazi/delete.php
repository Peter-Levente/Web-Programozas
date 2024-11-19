<?php
include 'db_connection.php';

function deleteStudent($id)
{
    global $con;
    $stmt = $con->prepare("DELETE FROM hallgatok WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Rekord sikeresen törölve.";
    } else {
        echo "Hiba történt a törlés során: " . $stmt->error;
    }
    $stmt->close();
}

// Függvény hívása
if (isset($_GET['id'])) {
    deleteStudent($_GET['id']);
    header("Location: listazas.php");
    exit();
}
?>
