<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Produits</h1>
        <div class="products">
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
            // Define products
            $products = [
                ['id' => 1, 'name' => 'Produit 1'],
                ['id' => 2, 'name' => 'Produit 2'],
                ['id' => 3, 'name' => 'Produit 3'],
                ['id' => 4, 'name' => 'Produit 4'],
                ['id' => 5, 'name' => 'Produit 5'],
                ['id' => 6, 'name' => 'Produit 6']
            ];

            foreach ($products as $product) {
                $product_id = $product['id'];
                // Fetch average rating
                $sql = 'SELECT AVG(rating) as avg_rating FROM reviews WHERE product_id = ?';
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$product_id]);
                $result = $stmt->fetch();
                $avg_rating = round($result['avg_rating'], 1);
                ?>
                <div class="product">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <div class="stars">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $avg_rating ? '★' : '☆';
                        }
                        ?>
                        <span>(<?php echo $avg_rating; ?>)</span>
                    </div>
                    <a href="review.html?product_id=<?php echo $product_id; ?>">Laisser un avis</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</body>
</html>
