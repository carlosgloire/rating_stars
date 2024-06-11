<?php
header('Content-Type: application/json');

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reviews_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

$productId = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

if ($productId > 0) {
    $stmt = $conn->prepare("SELECT rating FROM reviews WHERE product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    $reviews = [];
    while ($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }

    echo json_encode($reviews);

    $stmt->close();
} else {
    echo json_encode([]);
}

$conn->close();
?>
