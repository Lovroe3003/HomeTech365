<?php

$servername = "localhost";
$dbname = "webshop";
$username = "root";
$password = "";

try{
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT email,wallet, first_name, last_name, home_address FROM users WHERE id = :user_id");
    $stmt->bindParam(':user_id', $_SESSION['id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        $email = $user['email'];
        $wallet = $user['wallet'];
        $firstName = $user['first_name'];
        $lastName = $user['last_name'];
        $homeAddress = $user['home_address'];
    }
    else{
        echo "User not found";
        exit;
    }

}
catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    exit;
}

?>