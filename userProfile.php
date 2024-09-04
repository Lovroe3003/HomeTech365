<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeTech 365</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>

<body>

    <?php include 'header.php'; ?>
    <?php
    if (!isset($_SESSION['id'])) {
        header('Location: index.php');
        exit();
    }
    ?>

    <div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 1050;">
        <div id="toast-msg-container" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 1050;"></div>
    </div>

    <?php include 'getUserData.php'; ?>

    <main>
        <div class="container mt-4">
            <h1>User Profile</h1>
            <h3><?php echo htmlspecialchars($firstName).' '.htmlspecialchars($lastName); ?></h3>
            <div class="profile-info">
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>First Name:</strong> <?php echo $firstName; ?></p>
                <p><strong>Last Name:</strong> <?php echo $lastName; ?></p>
                <p><strong>Home Address:</strong> <?php echo $homeAddress; ?></p>
                <p><strong>Wallet Balance:</strong> <?php echo $wallet; ?>€</p>
            </div>
        </div>

        <div class="container mt-4">
        
    </div>

    </main>

<?php include 'modal.php'; ?>
<?php include 'footer.php'; ?>

</body>
</html>