<?php
$napok = array(
    "HU" => array("H", "K", "Sze", "Cs", "P", "Szo", "V"),
    "EN" => array("M", "Tu", "W", "Th", "F", "Sa", "Su"),
    "DE" => array("Mo", "Di", "Mi", "Do", "F", "Sa", "So"),
);

$kiemelt_napok = array(1, 3, 5);

foreach ($napok as $nyelv => $nap_list) {
    echo "$nyelv";
    echo ": ";

    foreach ($nap_list as $index => $nap) {
        if (in_array($index, $kiemelt_napok)) {
            echo "<strong>$nap</strong>";
        } else {
            echo "$nap";
        }

        if ($index < count($nap_list) - 1) {
            echo ", ";
        }
    }
    echo "<br>";
}

?>