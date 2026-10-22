
<?php
session_start();
require_once "db.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (
        $name === "" ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        strlen($password) < 8
    ) {
        $error = "Enter a valid name and email. Password must be at least 8 characters.";
    } else {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare(
                "INSERT INTO customers (name, email, password)
                 VALUES (?, ?, ?)"
            );

            $stmt->execute([$name, $email, $hash]);

            $success = "Registration successful! You can now log in.";
        } catch (PDOException $e) {
            if ($e->getCode() === "23000") {
                $error = "This email is already registered.";
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Estore | Register</title>
<style>
* { box-sizing: border-box; font-family: Arial, sans-serif; }
body {
    margin: 0; min-height: 100vh; display: flex;
    align-items: center; justify-content: center;
    background: #e3e6f3; padding: 20px;
}
.container {
    width: 100%; max-width: 420px; background: white;
    padding: 30px; border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,.1);
}
h1 { text-align: center; color: #088178; }
label { display: block; margin: 15px 0 7px; font-weight: bold; }
input {
    width: 100%; padding: 12px;
    border: 1px solid #ccc; border-radius: 6px;
}
button, .link {
    display: block; width: 100%; padding: 12px;
    margin-top: 20px; border: 0; border-radius: 6px;
    background: #088178; color: white; text-align: center;
    text-decoration: none; cursor: pointer; font-size: 16px;
}
.error, .success { padding: 10px; border-radius: 5px; }
.error { background: #fdecea; color: #c0392b; }
.success { background: #e5f5f2; color: #06665f; }
</style>
</head>
<body>
<div class="container">
    <h1>Estore</h1>
    <h2>Create Account</h2>

    <?php if ($error !== ""): ?>
        <p class="error"><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></p>
    <?php endif; ?>

    <?php if ($success !== ""): ?>
        <p class="success"><?= htmlspecialchars($success, ENT_QUOTES, "UTF-8") ?></p>
        <a class="link" href="login.php">Go to Login</a>
    <?php else: ?>
        <form method="POST" action="register.php">
            <label for="name">Full Name</label>
            <input id="name" name="name" maxlength="100" required>

            <label for="email">Email Address</label>
            <input id="email" name="email" type="email"
                   maxlength="150" required>

            <label for="password">Password (minimum 8 characters)</label>
            <input id="password" name="password" type="password"
                   minlength="8" autocomplete="new-password" required>

            <button type="submit">Register</button>
        </form>
        <p>Already registered? <a href="login.php">Login here</a></p>
    <?php endif; ?>
</div>
</body>
</html>
