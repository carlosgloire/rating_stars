<?php
// Database connection
$host = 'localhost'; // your database host
$db   = 'reviews_management'; // your database name
$user = 'root'; // your database username
$pass = ''; // your database password

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

// Get form data
$product_id = $_POST['product_id'];
$rating = $_POST['rating'];

// Insert review into the database
$sql = 'INSERT INTO reviews (product_id, rating) VALUES (?, ?)';
$stmt = $pdo->prepare($sql);
$stmt->execute([$product_id, $rating]);

// Redirect back to the review page (or to a "thank you" page)
header('Location: index.php?product_id=' . $product_id);
exit();
?>
