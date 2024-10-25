<?php
$name = $email = $password = $confirmPassword = $birthdate = $gender = $interests = $country = '';
$interests = [];
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
// Név ellenőrzése
    if (empty($_POST['name'])) {
        $errors['name'] = "A 'Név' mező kötelező.";
    } else {
        $name = htmlspecialchars($_POST['name']);
    }

// E-mail ellenőrzése
    if (empty($_POST['email'])) {
        $errors['email'] = "Az 'E-mail' mező kötelező.";
    } else {
        $email = htmlspecialchars($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Kérlek, adj meg egy érvényes e-mail címet.";
        }
    }

// Jelszó ellenőrzése
    if (empty($_POST['password'])) {
        $errors['password'] = "A 'Jelszó' mező kötelező.";
    } else {
        $password = $_POST['password'];
        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[\W_]/', $password)) {
            $errors['password'] = "A jelszónak minimum 8 karakterből kell állnia, és tartalmaznia kell legalább 1 nagybetűt, 1 számot és 1 speciális karaktert.";
        }
    }

// Jelszó megerősítése
    if (empty($_POST['confirmPassword'])) {
        $errors['confirmPassword'] = "A 'Jelszó megerősítése' mező kötelező.";
    } else {
        $confirmPassword = $_POST['confirmPassword'];
        if ($password !== $confirmPassword) {
            $errors['confirmPassword'] = "A jelszó és a jelszó megerősítése nem egyezik.";
        }
    }

// Születési dátum ellenőrzése
    if (empty($_POST['birthdate'])) {
        $errors['birthdate'] = "A 'Születési dátum' mező kötelező.";
    } else {
        $birthdate = $_POST['birthdate'];
        if (!DateTime::createFromFormat('Y-m-d', $birthdate)) {
            $errors['birthdate'] = "Kérlek, adj meg egy érvényes dátumot.";
        }
    }

// Nem ellenőrzése
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $errors['gender'] = "A 'Nem' mező kötelező.";
    }

// Érdeklődési területek
    if (isset($_POST['interests'])) {
        $interests = $_POST['interests'];
    }

// Ország ellenőrzése
    if (isset($_POST['country']) && $_POST['country'] !== '') {
        $country = $_POST['country'];
    }

// Hibák ellenőrzése
    if (empty($errors)) {
        echo "<h4>Beküldött adatok:</h4>";
        echo "<p><strong>Név:</strong> $name</p>";
        echo "<p><strong>E-mail:</strong> $email</p>";
        echo "<p><strong>Születési dátum:</strong> $birthdate</p>";
        echo "<p><strong>Nem:</strong> $gender</p>";
        if (!empty($interests)) {
            echo "<p><strong>Érdeklődési területek:</strong> " . implode(", ", $interests) . "</p>";
        }
        if (!empty($country)) {
            echo "<p><strong>Ország:</strong> $country</p>";
        }

        echo '<br><br>';

    }
}
?>

<h3>Regisztrációs Űrlap</h3>
<p><strong>Kötelező mezők:</strong> <span style="color: red">*</span> = kötelező</p>
<p><strong>Opcionális mezők:</strong> Érdeklődési területek, Ország</p>

<form method="post" action="">
    <label for="name">Név:<span style="color: red">*</span>
        <input type="text" name="name" value="<?php echo $name; ?>">
        <span class="error"
              style="color: red"><?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
    </label>
    <br><br>

    <label for="email">E-mail:<span style="color: red">*</span>
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error" style="color: red"><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></span>
    </label>
    <br><br>

    <label for="password">Jelszó:<span style="color: red">*</span>
        <input type="password" name="password"
               value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>">
        <span class="error"
              style="color: red"><?php echo isset($errors['password']) ? $errors['password'] : ''; ?></span>
    </label>
    <br><br>

    <label for="confirmPassword">Jelszó megerősítése:<span style="color: red">*</span>
        <input type="password" name="confirmPassword"
               value="<?php echo isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : ''; ?>">
        <span class="error"
              style="color: red"><?php echo isset($errors['confirmPassword']) ? $errors['confirmPassword'] : ''; ?></span>
    </label>
    <br><br>

    <label for="birthdate">Születési dátum:<span style="color: red">*</span>
        <input type="date" name="birthdate" value="<?php echo $birthdate; ?>">
        <span class="error"
              style="color: red"><?php echo isset($errors['birthdate']) ? $errors['birthdate'] : ''; ?></span>
    </label>
    <br><br>

    <label>Nem:<span style="color: red">*</span>
        <input type="radio" name="gender" value="male" <?php echo ($gender == 'male') ? 'checked' : ''; ?>> Férfi
        <input type="radio" name="gender" value="female" <?php echo ($gender == 'female') ? 'checked' : ''; ?>> Nő
        <input type="radio" name="gender" value="other" <?php echo ($gender == 'other') ? 'checked' : ''; ?>> Egyéb
        <span class="error" style="color: red"><?php echo isset($errors['gender']) ? $errors['gender'] : ''; ?></span>
    </label>
    <br><br>

    <label>Érdeklődési területek (opcionális):
        <br>
        <input type="checkbox" name="interests[]"
               value="sport" <?php echo in_array('sport', $interests) ? 'checked' : ''; ?>> Sport
        <input type="checkbox" name="interests[]"
               value="art" <?php echo in_array('art', $interests) ? 'checked' : ''; ?>> Művészet
        <input type="checkbox" name="interests[]"
               value="science" <?php echo in_array('science', $interests) ? 'checked' : ''; ?>> Tudomány
    </label>
    <br><br>

    <label for="country">Ország (opcionális):
        <select name="country">
            <option value="">Kérlek, válassz...</option>
            <option value="hungary" <?php echo ($country == 'hungary') ? 'selected' : ''; ?>>Magyarország</option>
            <option value="usa" <?php echo ($country == 'usa') ? 'selected' : ''; ?>>Egyesült Államok</option>
            <option value="uk" <?php echo ($country == 'uk') ? 'selected' : ''; ?>>Egyesült Királyság</option>
        </select>
    </label>
    <br><br>

    <input type="submit" value="Regisztráció"/>
</form>