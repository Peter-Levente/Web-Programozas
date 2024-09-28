<?php

$array = [5, '5', '05', 12.3, '16.7', 'five', 'true', 0xDECAFBAD, '10e200'];

foreach ($array as $value) {
    $type = gettype($value);
    $isNumeric = is_numeric($value) ? 'Igen' : "Nem";

    echo "Érték: $value, Típus: $type, Numerikus: $isNumeric<br>";
}

?>