<?php

$masodpercek = 924;

if (is_int($masodpercek)) {
    $orak = intdiv($masodpercek, 3600);
    $maradek_masodperc = $masodpercek % 3600;
    $percek = intdiv($maradek_masodperc, 60);

    echo "<strong>Átalakított idő:</strong> $orak óra és $percek perc.";
} else {
    echo "<span style='color: red;'>Hiba: A megadott érték nem egész szám.</span>";
}

?>