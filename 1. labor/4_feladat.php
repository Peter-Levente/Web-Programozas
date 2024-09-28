<?php

declare(strict_types= 1);

function szorzoTabla(int $szam){
    
    for ($i = 1; $i <= 10; $i++){
        $sum=$i*$szam;
        echo"$i x $szam = $sum";
    }

    
}