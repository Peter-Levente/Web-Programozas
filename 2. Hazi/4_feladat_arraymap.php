<?php
function atalakit_array_map(array $tomb, string $mod): array
{

    $mod_func = ($mod == "kisbetus") ? 'strtolower' : 'strtoupper';

    return array_map($mod_func, $tomb);
}

$szinek = array('A' => 'Kek', 'B' => 'Zold', 'C' => 'Piros');

$szinek_list = atalakit_array_map($szinek, "kisbetus");

$last_key = array_key_last($szinek_list);

echo '$szinek = array(';

foreach ($szinek_list as $key => $value) {
    if ($key === $last_key) {
        echo "'$key' => '$value' "; // Utolsó elem után nincs vessző
    } else {
        echo "'$key' => '$value', "; // Minden más esetben van vessző
    }
}

echo ');';