<?php
session_start();

$servername = "localhost";
$dbname = "webshop";
$username = "root";
$password = "";


if (isset($_SESSION['id']) && isset($_POST['new_amount'])) {
    $userId = $_SESSION['id'];
    $newAmount = $_POST['new_amount'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection fail: " . $conn->connect_error);
    }

    $query = "UPDATE users SET wallet = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $newAmount, $userId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
        exit;
    } 
    else {
        echo json_encode(['success' => false, 'error' => 'Failed to update wallet amount.']);
        exit;
    }
    
    $stmt->close();
    $conn->close();
} 
else {
    echo json_encode(['success' => false, 'error' => 'User ID or new amount not provided.']);
    exit;
}
?>
