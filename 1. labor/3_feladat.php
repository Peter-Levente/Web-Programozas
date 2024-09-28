<?php

function sakkTabla($meret)
{
    echo "<table border='1'>";

    for ($sor = 0; $sor < $meret; $sor++) {
        echo "<tr>";

        for ($oszlop = 0; $oszlop < $meret; $oszlop++) {

            if (($sor + $oszlop) % 2 == 0) {
                echo "<td style='background-color:white; width:100px; height:100px'></td>";
            } else {
                echo "<td style='background-color:black; width:100px; height:100px'></td>";
            }
        }
        echo "</tr>";   
    }
    echo "</table>";
}

sakkTabla(meret: 8);
