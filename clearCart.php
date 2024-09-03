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

        $stmt = $pdo->prepare("DELETE FROM cart WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        echo json_encode(['success' => true]);
    }
    catch(PDOException $e){
        echo json_encode(['success'=>false, 'error'=>'Database error' . $e->getMessage()]);
    }
}
else{
    echo json_encode(['success'=>false, 'error'=>'Parameter error' . 'User ID not correct or provided']);
}


?>