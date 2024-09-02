document.getElementById('add-product-btn').onclick = function(event) {
    event.stopPropagation();
    document.getElementById('floating-form').style.display = 'flex';
};

document.getElementById('close-btn').onclick = function(event) {
    event.stopPropagation();
    document.getElementById('floating-form').style.display = 'none';
};

document.getElementById('floating-form').onclick = function(event) {
    if (event.target == document.getElementById('floating-form')) {
        document.getElementById('floating-form').style.display = 'none';
    }
};

document.querySelector('.form-content').onclick = function(event) {
    event.stopPropagation();
};
