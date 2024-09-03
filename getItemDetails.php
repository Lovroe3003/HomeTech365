<?php

$servername = "localhost";
$dbname = "webshop";
$username = "root";
$password = "";


try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id'])) {
        $itemId = $_GET['id'];
        $stmt = $pdo->prepare("SELECT name, description FROM products WHERE id = ?");
        $stmt->execute([$itemId]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($item) {
            echo json_encode($item);
        } else {
            echo json_encode(['error' => 'item not found']);
        }
    } else {
        echo json_encode(['error' => 'No item ID provided']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Connection failed: ' . $e->getMessage()]);
}
?>