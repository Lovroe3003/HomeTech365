<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeTech 365</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>

<body>

    <?php include 'header.php'; ?>
    <div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 1050;">
        <div id="toast-msg-container" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 1050;"></div>
    </div>

    <div class="container mt-3 search-box">
        <form id="search-box">
            <div class="row align-items-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <input type="search" value="" placeholder="Search items" id="search-input" name="search" class="form-control form-control-lg mr-sm-2">
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <select name="sort" id="sort-select" class="form-control-lg" >
                        <option value="default" selected disabled hidden>Sort By</option>
                        <option value="name-asc">Name: A-Z</option>
                        <option value="name-desc">Name: Z-A</option>
                        <option value="price-asc">Price: ascending</option>
                        <option value="price-desc">Price: descending</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-dark btn-lg btn-block" id="search-btn">Search</button>
                </div>
            </div>
        </form>
    </div>

    <div class="container mt-4">
        <div id="products" class="row align-items-center">
            <?php include 'displayItems.php'; ?>
        </div>
    </div>

    <?php include 'modal.php'; ?>
    <?php include 'footer.php'; ?>
    

</body>

</html>