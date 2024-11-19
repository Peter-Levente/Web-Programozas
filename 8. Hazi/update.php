<?php
include 'db_connection.php';

// Funkció az adatbázis frissítéséhez
function updateStudent($id, $nev, $szak, $atlag)
{
    global $con;
    $stmt = $con->prepare("UPDATE hallgatok SET nev = ?, szak = ?, atlag = ? WHERE id = ?");
    $stmt->bind_param("ssdi", $nev, $szak, $atlag, $id);

    if ($stmt->execute()) {
        header("Location: listazas.php");
        exit();
    } else {
        echo "Hiba történt: " . $stmt->error;
    }
    $stmt->close();
}

// Funkció az adatbázis lekérdezéséhez
function getStudentById($id)
{
    global $con;
    $stmt = $con->prepare("SELECT * FROM hallgatok WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    return $row;
}

// Ha a formot beküldik
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nev = $_POST['nev'];
    $szak = $_POST['szak'];
    $atlag = $_POST['atlag'];

    updateStudent($id, $nev, $szak, $atlag);
} else {
    // Ha a formot nem küldték be, akkor lekérdezzük az adatokat az ID alapján
    $id = $_GET['id'];
    $row = getStudentById($id);
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    Nev: <input type="text" name="nev" value="<?php echo htmlspecialchars($row["nev"]); ?>"><br>
    Szak: <input type="text" name="szak" value="<?php echo htmlspecialchars($row["szak"]); ?>"><br>
    Atlag: <input type="text" name="atlag" value="<?php echo htmlspecialchars($row["atlag"]); ?>"><br>
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <input type="submit" name="submit" value="Elküld">
</form>
