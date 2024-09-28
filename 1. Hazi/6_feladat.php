<?php
/* $honap = "szeptember"; 

if ($honap == "december" || $honap == "január" || $honap == "február") {
    echo "Tél";
} elseif ($honap == "március" || $honap == "április" || $honap == "május") {
    echo "Tavasz";
} elseif ($honap == "június" || $honap == "július" || $honap == "augusztus") {
    echo "Nyár";
} elseif ($honap == "szeptember" || $honap == "október" || $honap == "november") {
    echo "Ősz";
} else {
    echo "Hibás hónap név.";
} */

$honap = "július";

switch ($honap) {
    case "december":
    case "január":
    case "február":
        echo "Tél";
        break;
    case "március":
    case "április":
    case "május":
        echo "Tavasz";
        break;
    case "június":
    case "július":
    case "augusztus":
        echo "Nyár";
        break;
    case "szeptember":
    case "október":
    case "november":
        echo "Ősz";
        break;
    default:
        echo "Hibás hónap név.";
        break;
}
?>