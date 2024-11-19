<?php
include 'db_connection.php';

// Hallgatók adatai
$studentsData = array(
    array('John Doe', 'Informatika', 5.2),
    array('Alice Smith', 'Műszaki Informatika', 7.9),
    array('Bob Johnson', 'Gazdaságinformatika', 8.8),
    array('Eva Wilson', 'Matematika', 9.5),
    array('Mike Brown', 'Fizika', 5.0),
    array('Sarah Davis', 'Kémia', 3.7),
    array('David Lee', 'Biológia', 8.1),
    array('Linda Martinez', 'Informatika', 8.8),
    array('Tom Miller', 'Műszaki Informatika', 5.3),
    array('Karen Wilson', 'Gazdaságinformatika', 6.5)
);

// Funkció a hallgatók adatainak beszúrására
function insertStudent($nev, $szak, $atlag)
{
    global $con;
    $sql = "INSERT INTO hallgatok (nev, szak, atlag) VALUES (?, ?, ?)";

    // Előkészített utasítás
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("ssd", $nev, $szak, $atlag);  // "s" - string, "d" - double
        if ($stmt->execute()) {
            echo "Sikeres felvitel: $nev - $szak - $atlag<br>";
        } else {
            echo "Hiba a felvitelkor: " . $stmt->error . "<br>";
        }
        $stmt->close();
    } else {
        echo "Hiba a lekérdezés előkészítésénél: " . $con->error . "<br>";
    }
}

// Az összes hallgató adatainak feltöltése
foreach ($studentsData as $student) {
    $nev = $student[0];
    $szak = $student[1];
    $atlag = $student[2];

    insertStudent($nev, $szak, $atlag);
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

// Kapcsolat lezárása
closeConnection();

?>
