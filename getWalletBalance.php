<?php

session_start();
$servername = "localhost";
$dbname = "webshop";
$username = "root";
$password = "";

if(isset($_SESSION['id'])){
    $userId = $_SESSION['id'];

    try{
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT wallet FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $walletAmount = $result['wallet'];
            echo json_encode(['balance' => $walletAmount]); // Returning 'balance' for consistency
        } else {
            echo json_encode(['error' => 'No wallet data found for this user.']);
        }
    }
    catch(PDOException $e){
        echo json_encode(['error' => 'Database error:' . $e->getMessage()]);
    }
}else{
    echo json_encode(['error' => 'No user ID to get wallet balance']);
}

?>