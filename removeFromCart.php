<?php
$servername = "localhost";
$dbname ="webshop";
$username = "root";
$password = "";

if(isset($_POST['product_id'], $_POST['quantity'])){
    $productId = $_POST['product_id'];
    $quantityToRemove = intval($_POST['quantity']);

    try{
        $servername = "localhost";
        $dbname = "webshop";
        $username = "root";
        $password = "";

        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT quantity FROM cart WHERE product_id = :product_id");
        $stmt->bindParam(':product_id', $productId);

        $stmt->execute();
        $quantityBeforeRemove = $stmt->fetchColumn();


        if ($quantityBeforeRemove !== false) {
            if($quantityToRemove >= $quantityBeforeRemove){
                $stmt = $pdo->prepare("DELETE FROM cart WHERE product_id = :product_id");
            }
            else {
                $quantityAfterRemove = $quantityBeforeRemove - $quantityToRemove;
                $stmt = $pdo->prepare("UPDATE cart SET quantity = :quantity WHERE product_id = :product_id");
                $stmt->bindParam(':quantity', $quantityAfterRemove);
            }

            $stmt->bindParam(':product_id', $productId);
            $stmt->execute();

            echo json_encode(array('success' => true, 'message' => 'Product quantity updated successfully'));
        } 
        else{
            echo json_encode(array('success' => false, 'message' => 'Product not found in cart'));
        }
    } 
    catch (PDOException $e) {
        echo json_encode(array(
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ));
    }
} 
else {echo json_encode(array('success' => false, 'message' => 'No product_id or quantity provided'));}
?>