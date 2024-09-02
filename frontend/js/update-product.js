document.addEventListener('DOMContentLoaded', (event) => {
    const updateButtons = document.querySelectorAll('.btn-update');
    const floatingForm = document.getElementById('floating-update-form');
    const closeBtn = document.getElementById('close-btnn');

    updateButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productCode = this.getAttribute('data-product-code');

            fetch('../backend/get_product_details.php?product_code=' + productCode)
                .then(response => response.json())
                .then(data => {
                    if (data) {
                        document.getElementById('product_code').value = data.product_code;
                        document.getElementById('product_name').value = data.product_name;
                        document.getElementById('product_price').value = data.product_price;
                        document.getElementById('product_type').value = data.product_type;
                        document.getElementById('product_ammount').value = data.product_ammount;
                        floatingForm.style.display = 'flex';
                    }
                });
        });
    });

    closeBtn.addEventListener('click', () => {
        floatingForm.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === floatingForm) {
            floatingForm.style.display = 'none';
        }
    });
});