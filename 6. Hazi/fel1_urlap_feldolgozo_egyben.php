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
        echo "<p><strong>Feltételek elfogadva:</strong> $terms </p>";
    }
}
?>

<h3>Online conference registration</h3>
<form method="post" action="" enctype="multipart/form-data">
    <label for="fname"> First name:
        <input type="text" name="firstName" value="<?php echo $firstName; ?>">
        <span class="error" style="color: red"><?php echo $firstNameError; ?></span>
    </label>
    <br><br>
    <label for="lname"> Last name:
        <input type="text" name="lastName" value="<?php echo $lastName; ?>">
        <span class="error" style="color: red"><?php echo $lastNameError; ?></span>
    </label>
    <br><br>
    <label for=" email"> E-mail:
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error" style="color: red"><?php echo $emailError; ?></span>
    </label>
    <br><br>
    <label for=" attend"> I will attend:<br>
        <input type="checkbox" name="attend[]"
               value="Event1" <?php echo in_array('Event1', $attend) ? 'checked' : ''; ?>>Event 1<br>
        <input type="checkbox" name="attend[]"
               value="Event2" <?php echo in_array('Event2', $attend) ? 'checked' : ''; ?>>Event2<br>
        <input type="checkbox" name="attend[]"
               value="Event3" <?php echo in_array('Event3', $attend) ? 'checked' : ''; ?>>Event2<br>
        <input type="checkbox" name="attend[]"
               value="Event4" <?php echo in_array('Event3', $attend) ? 'checked' : ''; ?>>Event3<br>
        <span class="error" style="color: red"><?php echo $attendError; ?></span>
    </label>
    <br><br>
    <label for="tshirt"> What's your T-Shirt size?<br>
        <select name="tshirt">
            <option value="P" <?php echo ($tshirt == 'P') ? 'selected' : ''; ?>>Please select</option>
            <option value="S" <?php echo ($tshirt == 'S') ? 'selected' : ''; ?>>S</option>
            <option value="M" <?php echo ($tshirt == 'M') ? 'selected' : ''; ?>>M</option>
            <option value="L" <?php echo ($tshirt == 'L') ? 'selected' : ''; ?>>L</option>
            <option value="XL" <?php echo ($tshirt == 'XL') ? 'selected' : ''; ?>>XL</option>
        </select>
        <span class="error" style="color: red"><?php echo $tshirtError; ?></span>
    </label>
    <br><br>
    <label for="abstract"> Upload your abstract<br>
        <input type="file" name="abstract"/>
        <br><br>
        <span class="error" style="color: red"><?php echo $fileSizeError; ?></span>
        <span class="error" style="color: red"><?php echo $pdfError; ?></span>
        <span class="error" style="color: red"><?php echo $fileUploadError; ?></span>
    </label>
    <br><br>
    <input type="checkbox" name="terms"
           value="igen" <?php echo isset($terms) && $terms == 'igen' ? 'checked' : ''; ?>>I agree
    to terms &
    conditions.<br>
    <span class="error" style="color: red"><?php echo $termsError; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Send registration"/>

</form>
