
<?php
session_start();
require_once "db.php";

$error = "";

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    try {
        // Find the registered customer in the database
        $stmt = $pdo->prepare(
            "SELECT id, name, email, password
             FROM customers
             WHERE email = ?
             LIMIT 1"
        );

        $stmt->execute([$email]);
        $customer = $stmt->fetch();

        // Verify the password
        if ($customer && password_verify($password, $customer["password"])) {

            // Create a new session ID after login
            session_regenerate_id(true);

            // Store customer information in the session
            $_SESSION["user_id"] = $customer["id"];
            $_SESSION["user_name"] = $customer["name"];
            $_SESSION["user_email"] = $customer["email"];
            $_SESSION["logged_in"] = true;

            // Redirect to the Estore homepage
            header("Location: index.php");
            exit;

        } else {
            $error = "Invalid email or password. Please try again.";
        }

    } catch (PDOException $e) {
        $error = "Unable to process your login right now. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Estore | Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #e3e6f3;
            padding: 20px;
        }

        .login-container {
            width: 90%;
            max-width: 400px;
            padding: 35px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #088178;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            color: #606063;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin: 15px 0 7px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline-color: #088178;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 22px;
            background: #088178;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #06665f;
        }

        .error {
            color: #c0392b;
            background: #fdecea;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .note {
            margin-top: 20px;
            text-align: center;
            color: #606063;
            font-size: 13px;
        }

        .note a {
            color: #088178;
            text-decoration: none;
            font-weight: bold;
        }

        .note a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="login-container">

        <h1>Estore</h1>
        <p class="subtitle">Login to your account</p>

        <?php if ($error !== ""): ?>
            <p class="error">
                <?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="login.php">

            <label for="email">Email Address</label>
            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                autocomplete="username"
                required
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                autocomplete="current-password"
                required
            >

            <button type="submit">Login</button>

        </form>

        <p class="note">Welcome to Estore!</p>

        <p class="note">
            Don't have an account?
            <a href="register.php">Create an account</a>
        </p>

    </div>

</body>
</html>
