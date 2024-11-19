<?php
session_start();
include 'db_connection.php';

// Felhasználó hitelesítése
function authenticateUser($username, $password)
{
    global $con;
    $stmt = $con->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result(); // Eredmények lekérdezése

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($password === $row['password']) {
            return true;
        } else {
            return false;
        }
    } else {
        $stmt->close();
        return null; // Felhasználónév nem található
    }
}

// Hitelesítési folyamat kezelése
function handleLogin()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $authResult = authenticateUser($username, $password);

        if ($authResult === true) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            header("Location: listazas.php");
            exit();
        } elseif ($authResult === null) {
            echo "A felhasználónév nem létezik.";
        } else {
            echo "Hibás jelszó!";
        }
    }
}


// Fő művelet
handleLogin();
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
</head>
<body>
<h1>Bejelentkezés</h1>
<form method="post" action="login.php">
    <label for="username">Felhasználónév:</label>
    <input type="text" name="username" id="username" required><br><br>
    <label for="password">Jelszó:</label>
    <input type="password" name="password" id="password" required><br><br>
    <button type="submit">Bejelentkezés</button>
</form>
</body>
</html>
