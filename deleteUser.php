<?php
session_start();

$error = ''; 
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'])) {
        $servername = "localhost";
        $dbname = "webshop";
        $username = "root";
        $password = "";
        

        $email = $_POST['email'];
        $currentUserEmail = $_SESSION['email'];

        if ($email === $currentUserEmail) {
            $error = "Cannot delete your own account";
            echo json_encode(array('success' => $success, 'error' => $error));
            exit;
        }

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT * FROM users WHERE email=?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $query = "DELETE FROM users WHERE email=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $email);

            if($stmt->execute()){
                $success = true;
            }
            else{
                $error = "Error deleting user: " . $stmt->error;
            }
        }
        else{
            $error = "No user found with given email address. Try again.";
        }

        $stmt->close();
        $conn->close();

    
    }
    echo json_encode(array('success' => $success, 'error' => $error));
}
?>