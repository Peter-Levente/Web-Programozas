<?php
$firstName = $lastName = $email = $tshirt = $abstract = $terms = '';
$firstNameError = '';
$lastNameError = '';
$attendError = '';
$emailError = '';
$tshirtError = '';
$fileSizeError = '';
$pdfError = '';
$fileUploadError = '';
$termsError = '';
$attend = [];
$maxFileSize = 3 * 1024 * 1024; // 3 MB
$allowedFileTypes = ['application/pdf'];


if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if (empty($_POST['firstName'])) {
        $firstNameError = "A 'First name' mező kötelező.";
    } else {
        $firstName = htmlspecialchars($_POST['firstName']);
    }

    if (empty($_POST['lastName'])) {
        $lastNameError = "A 'Last name' mező kötelező.";
    } else {
        $lastName = htmlspecialchars($_POST['lastName']);
    }

    if (empty($_POST['email'])) {
        $emailError = "Az 'E-mail' mező kötelező.";
    } else {
        $email = htmlspecialchars($_POST['email']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Kérlek, adj meg egy érvényes e-mail címet.";
        }
    }

    if (empty($_POST['attend'])) {
        $attendError = "Legalább egy eseményt ki kell választani.";
    } else {
        $attend = $_POST['attend'];
    }

    if (empty($_POST['tshirt']) || $_POST['tshirt'] == 'P') {
        $tshirtError = "Kérlek, válassz T-Shirt méretet.";
    } else {
        $tshirt = $_POST['tshirt'];
    }

    if (isset($_FILES['abstract'])) {
        if ($_FILES['abstract']['error'] == UPLOAD_ERR_OK) {
            if ($_FILES['abstract']['size'] > $maxFileSize) {
                $fileSizeError = "Az abstract fájl maximális mérete 3 MB.";
            } elseif (!in_array($_FILES['abstract']['type'], $allowedFileTypes)) {
                $pdfError = "Csak PDF fájlokat fogadunk el.";
            } else {
                $abstract = $_FILES['abstract']['name']; // Fájl neve
            }
        } else {
            $fileUploadError = "Az abstract fájl feltöltése kötelező.";
        }
    }

    if (empty($_POST['terms'])) {
        $termsError = "A feltételek elfogadása kötelező.";
    } else {
        $terms = $_POST['terms'];
    }

    if (empty($firstNameError) && empty($lastNameError) && empty($emailError) && empty($attendError) &&
        empty($tshirtError) && empty($fileSizeError) && empty($pdfError) && empty($fileUploadError) &&
        empty($termsError)) {

        echo "<h4>Beküldött adatok:</h4>";
        echo "<p><strong>Első név:</strong> $firstName</p>";
        echo "<p><strong>Utolsó név:</strong> $lastName</p>";
        echo "<p><strong>E-mail:</strong> $email</p>";
        echo "<p><strong>Részvétel:</strong> " . implode(", ", $attend) . "</p>";
        echo "<p><strong>T-Shirt méret:</strong> $tshirt</p>";
        echo "<p><strong>Abstract fájl:</strong> " . htmlspecialchars($_FILES['abstract']['name']) . "</p>"; // Fájl neve
        echo "<p><strong>Feltételek elfogadva:</strong> $terms</p>";
    } else {
        // Vissza a formra a hibák megjelenítéséhez
        include 'form.php'; // Visszatér a form-hoz
    }
}
?>
