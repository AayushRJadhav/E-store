
<?php
$host = "localhost";
$dbname = "estore_db";
$username = "root";
$password = ""; // Default XAMPP setup; change if your MySQL has a password.

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    exit("Database connection failed. Check your XAMPP MySQL settings.");
}
?>
