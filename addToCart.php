<?php

session_start();

$servername = "localhost";
$dbname ="webshop";
$username = "root";
$password = "";

if(isset($_POST['product_id'], $_POST['quantity'])){
    if(isset($_SESSION['id'])){
        $userId = $_SESSION['id'];
    }
    else{
        echo json_encode(['success' => false, 'message' =>'User not logged in']);
        exit;
    }

    try{
        $servername = "localhost";
        $dbname = "webshop";
        $username = "root";
        $password = "";
    

        $productId = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmtCheck = $pdo->prepare("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id");
        $stmtCheck->bindParam(':user_id', $userId);
        $stmtCheck->bindParam(':product_id', $productId);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() > 0) {
            $stmtUpdateAmount = $pdo->prepare("UPDATE cart SET quantity = quantity + :quantity WHERE user_id = :user_id AND product_id = :product_id");
            $stmtUpdateAmount->bindParam(':quantity', $quantity);
            $stmtUpdateAmount->bindParam(':user_id', $userId);
            $stmtUpdateAmount->bindParam(':product_id', $productId);
            $stmtUpdateAmount->execute();
        } else {
            $stmtAdd = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)");
            $stmtAdd->bindParam(':user_id', $userId);
            $stmtAdd->bindParam(':product_id', $productId);
            $stmtAdd->bindParam(':quantity', $quantity);
            $stmtAdd->execute();
        }

        echo json_encode(['success' => true]);
    }
    catch(PDOException $e){
        echo json_encode(['success' => false, 'message' => 'Database error' . $e->getMessage()]);
    }
}
else{
    echo json_encode(['success' => false, 'message' => 'Missing required data to add to cart']);
}


?>