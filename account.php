
<?php
session_start();

if (empty($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

$email = htmlspecialchars(
    $_SESSION["user_email"] ?? "",
    ENT_QUOTES,
    "UTF-8"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estore | My Account</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f5f6fa;
            color: #222;
        }

        header {
            background: #fff;
            padding: 15px 7%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #088178;
            text-decoration: none;
        }

        nav a {
            color: #222;
            text-decoration: none;
            margin-left: 25px;
            font-weight: bold;
        }

        nav a:hover {
            color: #088178;
        }

        .account-container {
            max-width: 850px;
            margin: 70px auto;
            padding: 20px;
        }

        .welcome {
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome h1 {
            color: #088178;
            font-size: 36px;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #606063;
            font-size: 16px;
        }

        .account-card {
            background: #fff;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .account-card h2 {
            margin-bottom: 25px;
            font-size: 23px;
        }

        .account-info {
            background: #f5f6fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 25px;
            line-height: 2;
            overflow-wrap: anywhere;
        }

        .status {
            color: #088178;
            font-weight: bold;
        }

        .logout-btn {
            display: inline-block;
            background: #088178;
            color: #fff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #06665f;
        }

        footer {
            text-align: center;
            padding: 20px;
            color: #606063;
        }

        @media (max-width: 600px) {
            header {
                padding: 15px 5%;
                flex-wrap: wrap;
                gap: 12px;
            }

            nav a {
                margin-left: 0;
                margin-right: 12px;
            }

            .account-container {
                margin: 35px auto;
            }

            .welcome h1 {
                font-size: 28px;
            }

            .account-card {
                padding: 22px;
            }
        }
    </style>
</head>

<body>

<header>
    <a href="index.html" class="logo">Estore</a>

    <nav>
        <a href="index.php">Home</a>
        <a href="shop.html">Shop</a>
        <a href="login.php">Account</a>
    </nav>
</header>

<main class="account-container">

    <div class="welcome">
        <h1>Welcome to Estore!</h1>
        <p>Your account details are displayed below.</p>
    </div>

    <div class="account-card">
        <h2>My Account Details</h2>

        <div class="account-info">
            <p>
                <strong>Customer Name:</strong>
                <?= htmlspecialchars(
                    $_SESSION["user_name"] ?? "",
                    ENT_QUOTES,
                    "UTF-8"
                ) ?>
            </p>

            <p>
                <strong>Email Address:</strong>
                <?= htmlspecialchars(
                    $_SESSION["user_email"] ?? "",
                    ENT_QUOTES,
                    "UTF-8"
                ) ?>
            </p>

            <p class="status">Status: Logged In</p>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a>
    </div>

</main>
   

<p>
    Customer:
    <?= htmlspecialchars($_SESSION["user_name"] ?? "", ENT_QUOTES, "UTF-8") ?>
</p>

<p>
    Email:
    <?= htmlspecialchars($_SESSION["user_email"] ?? "", ENT_QUOTES, "UTF-8") ?>
</p>

<a href="logout.php">Logout</a>
    </div>
</main>

<footer>
    <p>&copy; 2026 Estore. All rights reserved.</p>
</footer>

</body>
</html>
