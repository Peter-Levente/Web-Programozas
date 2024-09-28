<?php

$highlight_color = 'lightblue';


$szorzotabla = function (int $n) use ($highlight_color) {

    echo "<table border='1' >";

    for ($i = 1; $i <= $n; $i++) {
        echo "<tr>";
        for ($j = 1; $j <= $n; $j++) {
            $value = $i * $j;

            if ($i == $j) {
                echo "<td style='background-color: $highlight_color;'>$value</td>";
            } else {
                echo "<td>$value</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
};

$szorzotabla(10);

?>