<?php

function atalakit_classic(array $tomb, string $mod): array
{
    $uj_tomb = array();

    foreach ($tomb as $kulcs => $ertek) {
        if ($mod == "kisbetus") {
            $uj_tomb[$kulcs] = strtolower($ertek);
        } elseif ($mod == "nagybetus") {
            $uj_tomb[$kulcs] = strtoupper($ertek);
        }
    }
    return $uj_tomb;
}

$szinek = array('A' => 'Kek', 'B' => 'Zold', 'C' => 'Piros');

$szinek_list = atalakit_classic($szinek, "nagybetus");

$last_key = array_key_last($szinek_list); 

echo '$szinek = array(';

foreach ($szinek_list as $key => $value) {
    if($key===$last_key){
        echo " '$key' => '$value' ";
    }else{
        echo " '$key' => '$value', ";
    }
}
echo ');';