<?php
session_start();

$servername = "localhost";
$dbname = "webshop";
$username = "root";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['product_id']) && isset($_POST['new-price'])) {
        $productId = $_POST['product_id'];
        $newPrice = $_POST['new-price'];

        if (!is_numeric($newPrice) || $newPrice <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid price. Please enter a valid number.']);
            exit;
        }

        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "UPDATE products SET price = :new_price WHERE id = :product_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':new_price', $newPrice);
            $stmt->bindParam(':product_id', $productId);

            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Price updated successfully.']);
            } 
            else {
                echo json_encode(['success' => false, 'message' => 'Failed to update the price.']);
            }
        } 
        catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } 
    else {
        echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
    }
}
?>
