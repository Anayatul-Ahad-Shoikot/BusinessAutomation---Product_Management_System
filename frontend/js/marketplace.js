document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.querySelector('input[name="query"]');
    const itemsContainer = document.querySelector('.items');

    searchInput.addEventListener('input', function () {
        const query = this.value.trim();

        if (query.length > 0) {
            console.log(`Searching for: ${query}`);
            fetch(`../backend/search_product.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Search Results:', data);
                    displayProducts(data);
                })
                .catch(error => console.error('Error fetching products:', error));
        } else {
            fetchProducts();
        }
    });

    function fetchProducts() {
        fetch('../backend/fetch_all_products.php')
            .then(response => response.json())
            .then(data => {
                console.log('All Products:', data);
                displayProducts(data);
            })
            .catch(error => console.error('Error fetching products:', error));
    }

    function displayProducts(products) {
        itemsContainer.innerHTML = '';

        if (products.length > 0) {
            products.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.className = 'product-item';
                productDiv.innerHTML = `
                    <img src='../assets/product_image/${product.product_image}' alt='${product.product_name}' />
                    <div class='tag'>
                        <h3>${product.product_name}</h3>
                        <h2>$${parseFloat(product.product_price).toFixed(2)}</h2>
                    </div>
                    <div class='tag'>
                        <p>${product.product_type}</p>
                        <p>Units: ${product.product_ammount}</p>
                    </div>
                    <p>By ${product.warehouse_name}</p>
                    <div class='actions'>
                        <a href='#' class='btn-update'>Add to cart</a>
                    </div>
                `;
                itemsContainer.appendChild(productDiv);
            });
        } else {
            itemsContainer.innerHTML = "<p>No products found.</p>";
        }
    }

    fetchProducts();
});
