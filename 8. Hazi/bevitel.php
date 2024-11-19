<?php
include 'db_connection.php';

// Hallgató hozzáadása
function addStudent($nev, $szak, $atlag)
{
    global $con;
    $stmt = $con->prepare("INSERT INTO hallgatok (nev, szak, atlag) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $nev, $szak, $atlag);
    $success = $stmt->execute();
    $stmt->close();
    return $success;
}

// Ellenőrzés és hallgató hozzáadása
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nev = $_POST['nev'];
    $szak = $_POST['szak'];
    $atlag = $_POST['atlag'];

    if (addStudent($nev, $szak, $atlag)) {
        header("Location: listazas.php");
        exit();
    } else {
        echo "Hiba történt az adatok mentésekor!";
    }
}
?>

<!-- HTML űrlap -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <label for="nev">Név:</label>
    <input type="text" name="nev" id="nev" required><br>
    <label for="szak">Szak:</label>
    <input type="text" name="szak" id="szak" required><br>
    <label for="atlag">Átlag:</label>
    <input type="number" step="0.01" name="atlag" id="atlag" required><br>
    <input type="submit" value="Elküld">
</form>
