<?php
include "ArrayManipulator.php";

$arrayManipulator = new ArrayManipulator([1, 2, 3, 4, 5]);

echo "Lekért adat (__get): ";
print_r($arrayManipulator->data);
//Hiba teszt
//print_r($arrayManipulator->dat);


//Hiba teszt
//$arrayManipulator->dat=[6,7,8,9,"szo"];
$arrayManipulator->data = [6, 7, 8, 9, "szo"];
echo "'<br>Új adat (__set): ";
print_r($arrayManipulator->data);

//isset() teszt
if (isset($arrayManipulator->data)) {
    echo "'<br>A 'data' tulajdonság létezik és be van állítva.\n";
}

//unset() teszt
//unset($arrayManipulator->data);

if (!isset($arrayManipulator->data)) {
    echo "'<br>'A 'data' tulajdonság már nincs beállítva.\n"; // Kiírja ezt
}


// __toString használata
echo "<br>__toString használata";
echo '<br>' . $arrayManipulator;
echo '<br>';


// Klónozás
echo "<br> Klónozás:<br>";
$clonedArrayManipulator = clone $arrayManipulator;

// Lekérjük a data tömböt
$data = $clonedArrayManipulator->data;

$data[] = 4; // Hozzáad egy elemet a klónozott objektumhoz

// Visszaállítjuk az új tömböt a klónozott objektumba
$clonedArrayManipulator->data = $data;

echo "<br> Eredeti tomb:<br>";
echo $arrayManipulator . "<br>";
echo "<br> Klon tomb:<br>";
echo $clonedArrayManipulator;