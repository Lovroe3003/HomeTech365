<div class="modal fade" id="login-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="login-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="login-modal-label">Login</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="login-form" method="post">
                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password:</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit-login-form-btn">Log In</button>
                    <div id="login-message" class="mt-3"></div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="register-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="register-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="login-modal-label">Register</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="register-form" method="post" action="register.php">
                    <div class="form-group row">
                        <label for="register-email" class="col-sm-4 col-form-label">Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="register-email" name="email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="register-password" class="col-sm-4 col-form-label">Password:</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="register-password" name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="register-first-name" class="col-sm-4 col-form-label">First Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="register-first-name" name="first_name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="register-last-name" class="col-sm-4 col-form-label">Last Name:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="register-last-name" name="last_name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="register-home-address" class="col-sm-4 col-form-label">Home Address:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="register-home-address" name="home_address" rows="2" required></textarea>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit-register-form-btn">Sign In</button>
                    <div id="register-message" class="mt-3"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="details-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="details-modal-label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="details-modal-label">Product details:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p id="product-description"></p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="select-quantity-modal" tabindex="-1" role="dialog" aria-labelledby="select-quantity-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="select-quantity-modal-label">Select Quantity</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="quantity-form">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" min="1" value="1" required>
                    </div>
                    <button type="submit" class="add-to-cart-btn btn btn-block">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="cart-modal" tabindex="-1" role="dialog" aria-labelledby="cart-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="cart-modal-label">Your Cart</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group cart-items"></ul>
                <div class="text-center mt-3">
                    <button class="btn btn-block buy-btn">Buy</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-user-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="delete-user-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="delete-user-modal-label">Delete user</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <p>Enter enter email of a user you want to delete</p>
            <form id="delete-user-form" method="post" action="register.php">
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email:</label>
                    <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" id="submit-user-delete-form-btn">DELETE USER</button>
                <div id="delete-user-message" class="mt-3"></div>
            </form>
        </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add-product-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="add-product-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="add-product-modal-label">Add Product</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add-product-form" method="post">
                    <div class="form-group row">
                        <label for="category" class="col-sm-3 col-form-label">Category:</label>
                        <div class="col-sm-9">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle w-100" type="button" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Category
                                </button>
                                <div class="dropdown-menu" aria-labelledby="categoryDropdown">
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
                                <input type="hidden" id="selected-category" name="category">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Name:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="price" class="col-sm-3 col-form-label">Price:</label>
                        <div class="col-sm-9">
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-3 col-form-label">Description:</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="product-image" class="col-sm-3 col-form-label" >Product Image:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="product-image" name="product-image" placeholder="img/productName.type" accept="img/*" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submit-add-product-form-btn">Add product</button>
                    <div id="add-product-message" class="mt-3"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.category-item').on('click', function(e) {
            e.preventDefault();
            var category = $(this).data('category');
            $('#selected-category').val(category);
            $('#categoryDropdown').text($(this).text());
        });
    });
</script>

<div class="modal fade" id="delete-product-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="delete-product-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="delete-product-modal-label">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" id="confirm-delete-btn">Delete</button>
                <div id="delete-product-message" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="change-price-modal" data-backdrop="static" tabindex="-1" aria-labelledby="change-price-modal-Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="change-price-modal-Label">Change Product Price</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="change-price-form" method="post" >
                <div class="form-group row">
                    <label for="new-price" class="col-sm-3 col-form-label">New price:</label>
                    <div class="col-sm-9">
                        <input type="number" step="0.01" class="form-control" id="new-price" name="new-price" placeholder="0.00">
                    </div>
                    <input type="hidden" id="product-id" name="product-id">
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="submit-change-price-btn">Submit change</button>
                <div id="change-price-message" class="mt-3"></div>
            </form>
        </div>
      </div>
    </div>
</div>