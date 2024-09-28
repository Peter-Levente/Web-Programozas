<?php

$szam1 = 10;
$szam2 = 3;
$muvelet = '/';

switch ($muvelet) {
    case '+':
        $eredmeny = $szam1 + $szam2;
        echo "Az összeadás eredménye: $eredmeny";
        break;
    case '-':
        $eredmeny = $szam1 - $szam2;
        echo "A kivonás eredménye: $eredmeny";
        break;
    case '*':
        $eredmeny = $szam1 * $szam2;
        echo "A szorzás eredménye: $eredmeny";
        break;
    case '/':
        if ($szam2 == 0) {
            echo "Hiba: Nem lehet nullával osztani.";
        } else {
            $eredmeny = $szam1 / $szam2;
            echo "Az osztás eredménye: $eredmeny";
        }
        break;
    default:
        echo "Hiba: Érvénytelen műveleti jel.";
        break;
}
?>