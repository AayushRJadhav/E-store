
<?php
session_start();

$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();

    setcookie(
        session_name(),
        "",
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estore | Logged Out</title>

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
            align-items: center;
            justify-content: center;
            background: #f5f6fa;
            padding: 20px;
        }

        .logout-container {
            width: 100%;
            max-width: 450px;
            background: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        }

        .checkmark {
            width: 70px;
            height: 70px;
            line-height: 70px;
            border-radius: 50%;
            margin: 0 auto 20px;
            background: #e5f5f2;
            color: #088178;
            font-size: 38px;
            font-weight: bold;
        }

        h1 {
            color: #088178;
            margin-bottom: 15px;
            font-size: 30px;
        }

        p {
            color: #606063;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .login-btn {
            display: inline-block;
            background: #088178;
            color: #fff;
            padding: 13px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .login-btn:hover {
            background: #06665f;
        }
    </style>
</head>

<body>

<div class="logout-container">
    <div class="checkmark">&#10003;</div>

    <h1>Logged Out!</h1>

    <p>You have successfully logged out of your Estore account.
       Thank you for visiting us.</p>

    <a href="login.php" class="login-btn">Login Again</a>
</div>

</body>
</html>
