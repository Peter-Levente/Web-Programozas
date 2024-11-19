<?php
include "db_connection.php";
session_start();

// Ellenőrzés a bejelentkezésre
function checkLogin()
{
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: login.php");
        exit();
    }
}

// Hallgatók lekérdezése
function getHallgatok()
{
    global $con;
    $sql = "SELECT * FROM hallgatok";
    return $con->query($sql);
}

// Táblázat megjelenítése
function displayHallgatok($result)
{
    echo "<br>";
    echo "<form method='get' action='bevitel.php'>
            <button type='submit'>Új Hallgató</button>
          </form>";
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>
                <tr>
                    <th>Id</th>
                    <th>Nev</th>
                    <th>Szak</th>
                    <th>Átlag</th>
                    <th>Műveletek</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["nev"] . "</td>
                    <td>" . $row["szak"] . "</td>
                    <td>" . $row["atlag"] . "</td>
                    <td>
                        <a href='update.php?id=" . $row["id"] . "'>UPDATE</a> | 
                        <a href='delete.php?id=" . $row["id"] . "'>DELETE</a>
                    </td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "Nincs eredmény.";
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

// Fő program logika
checkLogin();
$result = getHallgatok();
displayHallgatok($result);
closeConnection();
?>
