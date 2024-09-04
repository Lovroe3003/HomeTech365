document.addEventListener('DOMContentLoaded', function() {

    const cartLink = document.getElementById('cart-link');
    const cartBadge = document.querySelector('.cart-badge');
    const buyButton = document.querySelector('.buy-btn');
    const cartItemsList = document.querySelector('.cart-items');
    const wallet = document.querySelector('.wallet');
    const loginForm = document.getElementById('login-form');
    const loginMessage = document.getElementById('login-message');
    const registerForm = document.getElementById('register-form');
    const registerMessage = document.getElementById('register-message');
    const deleteUserForm = document.getElementById('delete-user-form');
    const deleteUserMessage = document.getElementById('delete-user-message');
    const addProductForm = document.getElementById('add-product-form');
    const addProductMessage = document.getElementById('add-product-message');
    const confirmDeleteBtn = document.getElementById('confirm-delete-btn');
    const deleteProductMessage = document.getElementById('delete-product-message');
    const changePriceForm = document.getElementById('change-price-form');
    const changePriceMessage = document.getElementById('change-price-message');

    let productId = -1;
    let deleteProductId = null;
    let changePriceId;

    updateCartBadge();
    

    if (window.location.hash) {
        history.replaceState(null, null, window.location.href.split('#')[0]);
    }

    
    if(!window.location.href.endsWith("userProfile.php")){
        document.getElementById('search-input').addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                updateURL();
            }
        });
        document.getElementById('sort-select').addEventListener('change', updateURL);
        document.getElementById('category-dropdown').addEventListener('change', updateURL);
        

        function updateURL() {
            const searchValue = document.getElementById('search-input').value;
            const sortValue = document.getElementById('sort-select').value;
            const categoryValue = document.getElementById('category-dropdown').value;
        
            let url = new URL(window.location.href);
        
            if (url.hash) {
                url.hash = '';
            }

            if (searchValue) {
                url.searchParams.set('search', searchValue);
            } 
            else {
                url.searchParams.delete('search');
            }
            
            if (sortValue) {
                url.searchParams.set('sort', sortValue);
            } 
            else {
                url.searchParams.delete('sort');
            }

            if (categoryValue) {
                url.searchParams.set('category', categoryValue); 
            } 
            else {
                url.searchParams.delete('category');
            }

            window.location.href = url.href;
        }
    }else{
        document.getElementById('category-dropdown-container').style.display='none';

    }
    
    window.onload = function() {

        const urlParams = new URLSearchParams(window.location.search);
        const searchValue = urlParams.get('search') || '';
        const sortValue = urlParams.get('sort') || '';
        const categoryValue = urlParams.get('category') || '';
    
        document.getElementById('search-input').value = searchValue;
        document.getElementById('sort-select').value = sortValue;
        document.getElementById('category-dropdown').value = categoryValue;
    }

    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(loginForm);
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'login.php');
            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    try {
                        const response = JSON.parse(xhttp.responseText);
                        if (response.success) {
                            loginMessage.innerHTML = '<div class="alert alert-success mt-3" role="alert">Successfully logged in!</div>';
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            loginMessage.innerHTML = '<div class="alert alert-danger mt-3" role="alert">Incorrect email address or password. Please try again.</div>';
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                    }
                } else {
                    console.error('Request failed. Status:', xhttp.status);
                }
            };
            xhttp.onerror = function() {
                console.error('Request error.');
            };
            xhttp.send(formData);
        });
    }    
    
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(registerForm);
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'register.php');
            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    try {
                        const response = JSON.parse(xhttp.responseText);
                        if (response.success) {
                            registerMessage.innerHTML = '<div class="alert alert-success mt-3" role="alert">Register successful! You can log in.</div>';
                            setTimeout(function() {
                                $('#register-modal').modal('hide');
                                registerMessage.innerHTML = '';
                                registerForm.reset();
                                location.reload();
                            }, 2500);
                        } else {
                            registerMessage.innerHTML = '<div class="alert alert-danger mt-3" role="alert">' + response.error + '</div>';
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                    }
                } else {
                    console.error('Request failed. Status:', xhttp.status);
                }
            };
            xhttp.onerror = function() {
                console.error('Request error.');
            };
            xhttp.send(formData);
        });
    }

    if (deleteUserForm) {
        deleteUserForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(deleteUserForm);
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'deleteUser.php');
            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    try {
                        const response = JSON.parse(xhttp.responseText);
                        if (response.success) {
                            deleteUserMessage.innerHTML = '<div class="alert alert-success mt-3" role="alert">User successfuly deleted</div>';
                            setTimeout(function() {
                                $('#delete-user-modal').modal('hide');
                                deleteUserMessage.innerHTML = '';
                                deleteUserForm.reset();
                                location.reload();
                            }, 2500);
                        } else {
                            deleteUserMessage.innerHTML = '<div class="alert alert-danger mt-3" role="alert">' + response.error + '</div>';
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                    }
                } else {
                    console.error('Request failed. Status:', xhttp.status);
                }
            };
            xhttp.onerror = function() {
                console.error('Request error.');
            };
            xhttp.send(formData);
        });
    }

    if (cartLink) {
        cartLink.addEventListener('click', function() {
            checkCart();
            $('#cart-modal').modal('show');
        });
    }    

    buyButton.addEventListener('click', buy);

    window.addEventListener('load', getWalletBalance);

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            event.preventDefault();
            const quantity = document.getElementById('quantity').value;
            addToCart(productId, quantity);
        });
    });

    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            productId = this.getAttribute('data-id');
            $('#select-quantity-modal').modal('show');
        });
    });

    document.querySelectorAll('.details-btn').forEach(button => {
        button.addEventListener('click', function() {
            productId = this.getAttribute('data-id');
            showProductDetails(productId);
        });
    });


    
    function showProductDetails(productId) {
        const xhttp = new XMLHttpRequest();
        xhttp.open('GET', `getItemDetails.php?id=${productId}`, true);
        xhttp.onload = function() {
            if (xhttp.status === 200) {
                const product = JSON.parse(xhttp.responseText);
                document.getElementById('details-modal-label').textContent = product.name;
                document.getElementById('product-description').innerHTML = product.description;
                $('#details-modal').modal('show');
            } else {
                console.error('Failed to get product details.');
            }
        };
        xhttp.onerror = function() {
            console.error('Error getting product details.');
        };
        xhttp.send();
    }

    function addToCart(productId, quantity) {
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'addToCart.php');
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.onload = function() {
            if (xhttp.status === 200) {
                try {
                    const response = JSON.parse(xhttp.responseText);
                    if (response.success) {
                        updateCartBadge();
                        $('#select-quantity-modal').modal('hide');
                        showToast("Product added to cart.", "success");
                    } else {
                        showToast(response.message, "danger");
                    }
                } catch (error) {
                    console.error("Error parsing JSON response:", error);
                    console.error("Response:", xhttp.responseText);
                }
            } else {
                showToast('An error occurred while processing the request.', "danger");
            }
        };
        xhttp.onerror = function() {
            showToast('An error occurred while processing the request.', "danger");
        };
        xhttp.send(`product_id=${productId}&quantity=${quantity}`);
    }

    function updateCartBadge() {
        const xhttp = new XMLHttpRequest();
        xhttp.open('GET', 'getCartItems.php');
        xhttp.onload = function() {
            if (xhttp.status === 200) {
                const cartContents = JSON.parse(xhttp.responseText);
                let totalItems = 0;
                cartContents.forEach(item => {
                    totalItems += parseInt(item.quantity);
                });
                cartBadge.textContent = `(${totalItems})`;
            } else {
                console.error('Failed to fetch cart contents.');
            }
        };
        xhttp.onerror = function() {
            console.error('Error fetching cart contents.');
        };
        xhttp.send();
    }

    function checkCart() {
        const xhttp = new XMLHttpRequest();
        xhttp.open('GET', 'getCartItems.php');
        xhttp.onload = function() {
            if (xhttp.status === 200) {
                try {
                    const cartContents = JSON.parse(xhttp.responseText);
                    if (cartContents.length > 0) {
                        let message = "";
                        let totalPrice = 0;
                        cartContents.forEach(item => {
                            totalPrice += item.price * item.quantity;
                            message += `
                                <div class="cart-row">
                                    <div class="cart-column">
                                        <h5 class="item-name">${item.name}</h5>
                                        <h6 class="item-name">Quantity: ${item.quantity}</h6>
                                        <h6 class="item-name">Price: $${item.price}</h6>
                                        <h6 class="item-name">Total price: $${item.quantity * item.price}</h6>
                                    </div>
                                    <input type="number" class="form-control quantity-input remove-quantity" data-id="${item.product_id}" min="1" max="${item.quantity}" value="1">
                                    <button class="remove-btn btn-block" data-id="${item.product_id}">Remove</button>
                                </div>
                            `;
                        });
                        message += `<h4 class="cart-total-price mt-3">Total price: $${totalPrice.toFixed(2)}</h4>`;
                        cartItemsList.innerHTML = message;
                        buyButton.style.display = 'block';
                    } else {
                        cartItemsList.innerHTML = "<h5>Your shopping cart is empty!</h5>";
                        buyButton.style.display = 'none';
                    }

                    document.querySelectorAll('.remove-btn').forEach(button => {
                        button.addEventListener('click', function() {
                            const productId = this.getAttribute('data-id');
                            const quantity = this.parentElement.querySelector('.quantity-input').value;
                            removeFromCart(productId, quantity);
                        });
                    });
                } catch (error) {
                    console.error("Error parsing JSON response:", error);
                    console.error("Response:", xhttp.responseText);
                }
            } else {
                showToast("Failed to fetch cart contents.", "danger");
            }
        };
        xhttp.onerror = function() {
           showToast("Error fetching cart contents", "danger");
        };
        xhttp.send();
    }

    function removeFromCart(productId, quantity) {
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'removeFromCart.php');
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.onload = function() {
            if (xhttp.status === 200) {
                try {
                    const response = JSON.parse(xhttp.responseText);
                    if (response.success) {
                        updateCartBadge();
                        checkCart();
                        showToast(response.message, 'success');
                    } else {
                        showToast(response.message, 'danger');
                    }
                } catch (error) {
                    console.error("Error parsing JSON response:", error);
                    console.error("Response:", xhttp.responseText);
                }
            } else {
                showToast('Failed to remove product from cart.', 'danger');
            }
        };
        xhttp.onerror = function() {
            showToast('Error removing product from cart.', 'danger');
        };
        xhttp.send(`product_id=${productId}&quantity=${quantity}`);
    }

    function clearCart() {
        cart = {};
        cartItemsCount = 0;
        cartBadge.textContent = "(0)";

        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'clearCart.php');
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.onload = function() {
            if (xhttp.status === 200) {
                try {
                    const response = JSON.parse(xhttp.responseText);
                    if (response.success) {
                        cartItemsList.innerHTML = "<p>Cart is empty!</p>";
                        buyButton.style.display = 'none';
                        updateCartBadge();
                    } else {
                        showToast('Error clearing cart: ' + response.error, 'danger');
                    }
                } catch (error) {
                    console.error("Error parsing JSON response:", error);
                    console.error("Response:", xhttp.responseText);
                }
            } else {
                showToast('Failed to clear cart: ' + response.error, 'danger');
            }
        };
        xhttp.onerror = function() {
            showToast('Error clearing cart: ' + response.error, 'danger');
        };
        xhttp.send();
    }

    function buy() {
        const xhttpCart = new XMLHttpRequest();
        xhttpCart.open('GET', 'getCartItems.php');
        xhttpCart.onload = function() {
            if (xhttpCart.status === 200) {
                try {
                    const cartContents = JSON.parse(xhttpCart.responseText);
                    if (cartContents.length > 0) {
                        let totalPrice = 0;
                        cartContents.forEach(item => {
                            totalPrice += item.price * item.quantity;
                        });
    
                        const xhttpWallet = new XMLHttpRequest();
                        xhttpWallet.open('GET', 'getWalletBalance.php');
                        xhttpWallet.onload = function() {
                            if (xhttpWallet.status === 200) {
                                try {
                                    const walletData = JSON.parse(xhttpWallet.responseText);
                                    let walletBalanceInDB = parseFloat(walletData.balance);
                                    console.log(walletBalanceInDB); 
                                    console.log(totalPrice);
                                    if (totalPrice <= walletBalanceInDB) {
                                        walletBalanceInDB -= totalPrice;
                                        updateWallet(walletBalanceInDB);
                                        updateWalletBalanceInDB(walletBalanceInDB);
                                        clearCart();
                                        updateCartBadge();
                                        $('#cart-modal').modal('hide');
                                        showToast("Thank you for your purchase!", "success");                                        
                                    } else {
                                        showToast("You don't have enough money!", "danger");
                                    }
                                } catch (error) {
                                    console.error("Error parsing JSON response:", error);
                                    console.error("Response:", xhttpWallet.responseText);
                                }
                            } else {
                                showToast('Failed to fetch wallet balance.', 'danger');
                            }
                        };
                        xhttpWallet.onerror = function() {
                            showToast('Error fetching wallet balance.', 'danger');
                        };
                        xhttpWallet.send();
                    } else {
                        showToast("Your cart is empty!", "danger");
                    }
                } catch (error) {
                    console.error("Error parsing JSON response:", error);
                    console.error("Response:", xhttpCart.responseText);
                }
            } else {
                showToast("Failed to fetch cart contents.", "danger");
            }
        };
        xhttpCart.onerror = function() {
            showToast("Error fetching cart contents.", "danger");
        };
        xhttpCart.send();
    }

    function getWalletBalance() {
        const xhttp = new XMLHttpRequest();
        xhttp.open('GET', 'getWalletBalance.php');
        xhttp.onload = function() {
            if (xhttp.status === 200) {
                try {
                    const response = JSON.parse(xhttp.responseText);
                    if (response.balance !== undefined) {
                        wallet.textContent = '$' + response.balance;
                    } else {
                        console.error('Wallet balance not found in response:', response);
                    }
                } catch (error) {
                    console.error('Error parsing JSON response:', error);
                    console.error('Response:', xhttp.responseText);
                }
            } else {
                console.error('Error getting wallet balance. Status:', xhttp.status);
            }
        };
        xhttp.onerror = function() {
            console.error('Error getting wallet balance. Network error.');
        };
        xhttp.send();
    }

    function updateWalletBalanceInDB(newAmount) {
        const xhttp = new XMLHttpRequest();
        xhttp.open('POST', 'updateWalletBalance.php');
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.onload = function() {
            console.log(xhttp.responseText);
            if (xhttp.status === 200) {
                const response = JSON.parse(xhttp.responseText);
                if (response.success) {
                    console.log('Wallet updated successfully.');
                } else {
                    console.error('Error updating wallet:', response.error);
                }
            } else {
                console.error('Failed to update wallet. Server returned status:', xhttp.status);
            }
        };
        xhttp.onerror = function() {
            console.error('Error updating wallet. XMLHttpRequest error.');
        };
        xhttp.send(`new_amount=${newAmount}`);
    }

    function updateWallet(amount) {
        wallet.textContent = `$${amount.toFixed(2)}`;
    }

    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.classList.add('toast', `bg-${type}`, 'text-white', 'toast');
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        if (type == "danger"){
            type = "Warning";
        }
        if (type == "success"){
            type = "Success";
        }
        toast.innerHTML = 
        `
            <div class="toast-header">
                <strong class="mr-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                <button type="button" class="ml-4 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        `;
        document.getElementById('toast-msg-container').appendChild(toast);
        $(toast).toast({ delay: 3000 });
        $(toast).toast('show');
        $(toast).on('hidden.bs.toast', function() {
            toast.remove();
        });
    }

    if (addProductForm) {
        addProductForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(addProductForm);
            
            const xhttp = new XMLHttpRequest();
            xhttp.open('POST', 'addProduct.php');
            
            xhttp.onload = function() {
                if (xhttp.status === 200) {
                    try {
                        const response = JSON.parse(xhttp.responseText);
                        if (response.success) {
                            addProductMessage.innerHTML = '<div class="alert alert-success mt-3" role="alert">' + response.message + '</div>';
                            setTimeout(function() {
                                $('#add-product-modal').modal('hide');
                                addProductMessage.innerHTML = '';
                                addProductForm.reset();
                                location.reload();
                            }, 2500);
                        } else {
                            addProductMessage.innerHTML = '<div class="alert alert-danger mt-3" role="alert">' + response.message + '</div>';
                        }
                    } catch (error) {
                        console.error('Error parsing JSON response:', error);
                    }
                } else {
                    console.error('Request failed. Status:', xhttp.status);
                }
            };
            
            xhttp.onerror = function() {
                console.error('Request error.');
            };
            
            xhttp.send(formData);
        });
    }

    const deleteButtons= document.querySelectorAll('.admin-delete-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            productId = this.getAttribute('data-id');
            openDeleteModal(productId);
        });
    });

    function openDeleteModal(productId) {
        deleteProductId = productId;
        $('#delete-product-modal').modal('show');
    }

    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function() {
            if (deleteProductId) {
                const xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'deleteProduct.php');

                const formData = new FormData();
                formData.append('product_id', deleteProductId);

                xhttp.onload = function() {
                    if (xhttp.status === 200) {
                        try {
                            const response = JSON.parse(xhttp.responseText);
                            if (response.success) {
                                deleteProductMessage.innerHTML = '<div class="alert alert-success mt-3" role="alert">Product deleted successfully!</div>';
                                setTimeout(function() {
                                    $('#delete-product-modal').modal('hide');
                                    deleteProductMessage.innerHTML = '';
                                    location.reload();
                                }, 1000);
                            } 
                            else {
                                deleteProductMessage.innerHTML = '<div class="alert alert-danger mt-3" role="alert">' + response.message + '</div>';
                            }
                        } 
                        catch (error) {
                            console.error('Error parsing JSON response:', error);
                        }
                    } 
                    else {
                        console.error('Request failed. Status:', xhttp.status);
                    }
                };

                xhttp.onerror = function() {
                    console.error('Request error.');
                };

                xhttp.send(formData);
            }
        });
    }

    const changePriceButtons= document.querySelectorAll('.admin-change-price-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            productId = this.getAttribute('data-id');
            openChangePriceModal(productId);
        });
    });

    function openChangePriceModal(productId) {
        changePriceId = productId;
        $('#change-price-modal').modal('show');
    }

    if (changePriceForm) {
        changePriceForm.addEventListener('submit', function(e) {
            e.preventDefault();
            if(changePriceId){
                const xhttp = new XMLHttpRequest();
                xhttp.open('POST', 'changePrice.php', true);

                const formData = new FormData(changePriceForm);
                formData.append('product_id', changePriceId);
                console.log(changePriceId);

                xhttp.onload = function() {
                    if (xhttp.status === 200) {
                        try {
                            const response = JSON.parse(xhttp.responseText);
                            if (response.success) {
                                changePriceMessage.innerHTML = '<div class="alert alert-success mt-3" role="alert">' + response.message + '</div>';
                                setTimeout(function() {
                                    $('#change-price-modal').modal('hide');
                                    changePriceMessage.innerHTML = '';
                                    changePriceForm.reset();
                                    location.reload();
                                }, 2500);
                            } else {
                                changePriceMessage.innerHTML = '<div class="alert alert-danger mt-3" role="alert">' + response.message + '</div>';
                            }
                        } catch (error) {
                            console.error('Error parsing JSON response:', error);
                        }
                    } 
                    else {
                        console.error('Request failed. Status:', xhttp.status);
                    }
                };
                xhttp.onerror = function() {
                    console.error('Request error.');
                };
                
                xhttp.send(formData);
            }
        });
    }



});
