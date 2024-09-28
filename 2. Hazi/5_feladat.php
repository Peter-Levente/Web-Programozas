<?php

$bevasarlolista = [
    ["nev" => "Kenyer", "mennyiseg" => 2, "egysegar" => 8.5],
    ["nev" => "Viz", "mennyiseg" => 1, "egysegar" => 2.5],
    ["nev" => "Tej", "mennyiseg" => 3, "egysegar" => 3.2],
    ["nev" => "Tojas", "mennyiseg" => 12, "egysegar" => 0.9],
];

function uj_tetel_hozzaadasa(&$lista, $nev, $mennyiseg, $egysegar)
{
    $lista[] = ["nev" => $nev, "mennyiseg" => $mennyiseg, "egysegar" => $egysegar];
}

function tetel_torlese(&$lista, $nev)
{
    foreach ($lista as $index => $tetel) {
        if ($tetel["nev"] === $nev) {
            unset($lista[$index]);
            echo "A(z) $nev törölve lett a listáról.\n";
            return;
        }
    }
    echo "A(z) $nev nem található a listán.\n";

}

function lista_megjelenitese($lista)
{
    echo "Bevásárlólista:\n";
    echo "<br>";
    foreach ($lista as $tetel) {
        echo $tetel["nev"] . ", " . $tetel["mennyiseg"] . " darab, " . $tetel["egysegar"] . " egységár<br>";
        ;
    }

}

function osszesitett_ar($lista)
{
    $osszeg = 0;
    foreach ($lista as $tetel) {
        $osszeg += $tetel["mennyiseg"] * $tetel["egysegar"];
    }
    return $osszeg;
}

lista_megjelenitese($bevasarlolista);

echo "<br>--- Új tétel hozzáadása: Alma ---<br>";
uj_tetel_hozzaadasa($bevasarlolista, "Alma", 5, 1.1);
lista_megjelenitese($bevasarlolista);

echo "<br>--- Tétel törlése: Viz ---<br>";
tetel_torlese($bevasarlolista, "Viz");
echo "<br>";
echo "<br>";
lista_megjelenitese($bevasarlolista);

echo "<br> Az összesített ár: " . osszesitett_ar($bevasarlolista) . " lej<br>";