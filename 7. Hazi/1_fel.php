<?php
if (!isset($_COOKIE['rand_nmb'])) {
    $rand_nmb = rand(1, 10);
    setcookie('rand_nmb', $rand_nmb, time() + 3600);
} else {
    $rand_nmb = (int)$_COOKIE['rand_nmb'];
}

$msg = '';

if (isset($_POST['elkuldott']) && isset($_POST['talalgatas'])) {
    $talalgatas = (int)$_POST['talalgatas'];

    if (!empty($_POST['talalgatas'])) {
        if ($talalgatas === $rand_nmb) {
            $msg = "A két szám egyenlő";
            setcookie('rand_nmb', '', time() - 3600); // Süti törlése
        } elseif ($rand_nmb > $talalgatas) {
            $msg = "A szám nagyobb.";
        } elseif ($rand_nmb < $talalgatas) {
            $msg = "A szám kisebb.";
        }
    }
}
?>

<form method="post" action="">
    <input type="hidden" name="elkuldott" value="true">
    Melyik számra gondoltam 1 és 10 között?
    <input name="talalgatas" type="text">
    <br>
    <br>
    <input type="submit" value="Elküld">
</form>
<p><?php echo $msg; ?></p>