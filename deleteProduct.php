<?php

session_start();

$servername = "localhost";
$dbname = "webshop";
$username = "root";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("DELETE FROM products WHERE id = :product_id");
            $stmt->bindParam(':product_id', $productId);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to delete product']);
            }

        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Product ID is missing']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

?>
