<?php
// Változók inicializálása
$firstName = isset($firstName) ? $firstName : '';
$lastName = isset($lastName) ? $lastName : '';
$email = isset($email) ? $email : '';
$tshirt = isset($tshirt) ? $tshirt : '';
$attend = isset($attend) ? $attend : [];
$terms = isset($terms) ? $terms : '';

// Hibák inicializálása
$firstNameError = isset($firstNameError) ? $firstNameError : '';
$lastNameError = isset($lastNameError) ? $lastNameError : '';
$emailError = isset($emailError) ? $emailError : '';
$attendError = isset($attendError) ? $attendError : '';
$tshirtError = isset($tshirtError) ? $tshirtError : '';
$fileSizeError = isset($fileSizeError) ? $fileSizeError : '';
$pdfError = isset($pdfError) ? $pdfError : '';
$fileUploadError = isset($fileUploadError) ? $fileUploadError : '';
$termsError = isset($termsError) ? $termsError : '';
?>


<h3>Online conference registration</h3>
<form method="post" action="process.php" enctype="multipart/form-data">
    <label for="fname"> First name:
        <input type="text" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
        <span class="error" style="color: red"><?php echo $firstNameError; ?></span>
    </label>
    <br><br>
    <label for="lname"> Last name:
        <input type="text" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        <span class="error" style="color: red"><?php echo $lastNameError; ?></span>
    </label>
    <br><br>
    <label for="email"> E-mail:
        <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <span class="error" style="color: red"><?php echo $emailError; ?></span>
    </label>
    <br><br>
    <label for="attend"> I will attend:<br>
        <input type="checkbox" name="attend[]"
               value="Event1" <?php echo in_array('Event1', $attend) ? 'checked' : ''; ?>>Event 1<br>
        <input type="checkbox" name="attend[]"
               value="Event2" <?php echo in_array('Event2', $attend) ? 'checked' : ''; ?>>Event 2<br>
        <input type="checkbox" name="attend[]"
               value="Event3" <?php echo in_array('Event3', $attend) ? 'checked' : ''; ?>>Event 3<br>
        <input type="checkbox" name="attend[]"
               value="Event4" <?php echo in_array('Event4', $attend) ? 'checked' : ''; ?>>Event 4<br>
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
    <input type="checkbox" name="terms" value="igen" <?php echo isset($terms) && $terms == 'igen' ? 'checked' : ''; ?>>I
    agree to
    terms & conditions.<br>
    <span class="error" style="color: red"><?php echo $termsError; ?></span>
    <br><br>
    <input type="submit" name="submit" value="Send registration"/>
</form>


