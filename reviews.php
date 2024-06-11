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
// Get product_id from query string
$product_id = $_GET['product_id'];

// Fetch reviews for the product
$sql = 'SELECT * FROM reviews WHERE product_id = ? ORDER BY created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute([$product_id]);
$reviews = $stmt->fetchAll();
?>

<ul id="reviewsList">
    <?php foreach ($reviews as $review): ?>
        <li>Rating: <?php echo htmlspecialchars($review['rating']); ?> stars</li>
    <?php endforeach; ?>
</ul>
