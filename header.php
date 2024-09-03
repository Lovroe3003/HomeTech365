<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Logo</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown" id="category-dropdown-container">
                        <a class="nav-link data-toggle" type="button" data-toggle="dropdown" name="category">Categories</a>
                        <div class="dropdown-menu" aria-labelledby="categoryDropdown" id=category-dropdown>
                            <a class="dropdown-item category-item" href="#" data-category="tv">Television</a>
                            <a class="dropdown-item category-item" href="#" data-category="audio-video">Audio-video</a>
                            <a class="dropdown-item category-item" href="#" data-category="smartphone">Smartphone</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item category-item" href="#" data-category="kitchen-appl">Kitchen appliances</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item category-item" href="#" data-category="hvac">Heating and cooling</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item category-item" href="#" data-category="garden">Garden and leisure</a>
                        </div>
                    </li>
                </ul>
                <?php
                    session_start();
                    if (isset($_SESSION['id']) && $_SESSION['admin'] === false) {
                        $firstName = $_SESSION['first_name'];    
                        echo '<ul class="navbar-nav ml-auto">';
                        echo '<li class="nav-item">';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" id ="cart-link" href="#">';
                        echo 'Cart';
                        echo '<br>';
                        echo '<span class="cart-badge"></span>';
                        echo '</a>';
                        echo '</li>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="userProfile.php">';
                        echo htmlspecialchars($firstName);
                        echo '<br>';
                        echo '<span class="wallet"></span>';
                        echo '</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="logout.php">Log Out</a>';
                        echo '</li>';
                        echo '</ul>';
                    } 
                    else if (isset($_SESSION['id']) && $_SESSION['admin'] === true) {
                       
                        echo '<ul class="navbar-nav ml-auto">';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#" data-toggle="modal" data-target="#add-product-modal">Add item</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#" data-toggle="modal" data-target="#delete-user-modal">Delete user</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="logout.php">Log Out</a>';
                        echo '</li>';
                        echo '</ul>';
                    }  
                    else {
                        echo '<ul class="navbar-nav ml-auto">';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#" data-toggle="modal" data-target="#login-modal">Login</a>';
                        echo '</li>';
                        echo '<li class="nav-item">';
                        echo '<a class="nav-link" href="#" data-toggle="modal" data-target="#register-modal">Register</a>';
                        echo '</li>';
                        echo '</ul>';
                    }
                    ?>
            </div>
        </nav>
    </div>


</header>

<script>
    // JavaScript to redirect to the URL with the selected category
    document.querySelectorAll('.category-item').forEach(function(item) {
        item.addEventListener('click', function() {
            var selectedCategory = this.getAttribute('data-category');
            var currentUrl = window.location.href.split('?')[0]; // Get the current URL without query params
            window.location.href = currentUrl + '?category=' + selectedCategory; // Redirect with category query parameter
        });
    });
</script>