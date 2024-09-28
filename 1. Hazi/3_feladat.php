<?php

$a = 10;
$b = 3;

$osszeadas = $a + $b;
$kivonas = $a - $b;
$szorzas = $a * $b;
$osztas = $a / $b;
$hatvanyozas = pow($a, $b); // Vagy $a ** $b

echo "Az $a és $b összege: $osszeadas<br>";
echo "Az $a és $b különbsége: $kivonas<br>";
echo "Az $a és $b szorzata: $szorzas<br>";
echo "Az $a és $b hányadosa: $osztas<br>";
echo "Az $a $b-edik hatványa: $hatvanyozas<br>";

?>