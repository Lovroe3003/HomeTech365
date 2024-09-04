<?php
$servername = "localhost";
$dbname = "webshop";
$username = "root";
$password = "";

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

try {
    $pdo = new PDO("mysql: host=$servername; dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM products WHERE name LIKE :search";
    $params = [':search' => '%' . $search . '%'];
    
    if (!empty($category)) {
        $query .= " AND category = :category";
        $params[':category'] = $category;
    }

    if ($sort == 'name-asc') {
        $query .= " ORDER BY name ASC";
    } elseif ($sort == 'name-desc') {
        $query .= " ORDER BY name DESC";
    } elseif ($sort == 'price-asc') {
        $query .= " ORDER BY price ASC";
    } elseif ($sort == 'price-desc') {
        $query .= " ORDER BY price DESC";
    }

    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {

        echo '<div id="item-' . htmlspecialchars($product['id']) . '" class="col-md-6 col-lg-6 mb-4 d-flex align-items-stretch">';
        echo '<div class="item d-flex flex-column align-items-center text-center p-3 w-100 h-100">';
        echo '<div class="image-container">';
        echo '<img class="image img-fluid" src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '">';
        echo '</div>';

        echo '<div class="basic-info-container mt-3">';
        echo '<p class="product-name">' . htmlspecialchars($product['name']) . '</p>';
        echo '<p class="product-price">' . htmlspecialchars($product['price']) . '€</p>';
        echo '</div>';

        echo '<div class="buttons row row-cols-2 justify-content-center">';
        echo '<button class="details-btn btn btn-block btn-md" data-id="' . htmlspecialchars($product['id']) . '">View details</button>';
        if (isset($_SESSION['id']) && $_SESSION['admin'] === false) {
            echo '<button class="quantity-btn btn btn-block btn-md" data-id="' . htmlspecialchars($product['id']) . '">Add to cart</button>';
        }
        if (isset($_SESSION['id']) && $_SESSION['admin'] === true) {
            echo '<button class="admin-delete-btn btn btn-block btn-md" data-id="' . htmlspecialchars($product['id']) . '">Delete item</button>';
            echo '<button class="admin-change-price-btn btn btn-block btn-md" data-id="' . htmlspecialchars($product['id']) . '">Change price</button>';
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>