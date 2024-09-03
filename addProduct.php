<?php
session_start();

$servername = "localhost";
$dbname = "webshop";
$username = "root";
$password = "";

$error = ''; 
$success = false;

if (isset($_POST['category'], $_POST['name'], $_POST['price'], $_POST['description'], $_POST['product-image'])) {
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $category = $_POST['category'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_POST['product-image'];

        $query = "INSERT INTO products (category, name, price, description, image) VALUES (:category, :name, :price, :description, :image)";
        $stmt = $pdo->prepare($query);

        // Bind the parameters
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);

        // Execute the statement
        if ($stmt->execute()) {
            // If successful, send a JSON response with success
            echo json_encode(['success' => true, 'message' => 'Product added successfully']);
        } else {
            // If not successful, send an error message
            echo json_encode(['success' => false, 'message' => 'Failed to add the product']);
        }
    } catch (PDOException $e) {
        // Catch any database errors
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Handle missing form data
    echo json_encode(['success' => false, 'message' => 'All product fields are required']);
}
?>
