document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-remove').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const url = this.href;
            if (confirm("Are you sure you want to remove this product?")) {
                window.location.href = url;
            }
        });
    });
});
