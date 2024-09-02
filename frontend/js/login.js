const form = document.querySelector(".wrapper .form.login form"),
    submitbtn = form.querySelector(".field.button input"),
    error_msg = document.querySelector(".wrapper .error #error_msg"),
    success_msg = document.querySelector(".wrapper .error #success_msg");

form.onsubmit = (e) => {
    e.preventDefault();
};


submitbtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../backend/login.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let data = xhr.responseText.trim();
                if (data === "success") {
                    location.href = "./user_dash.php";
                } else {
                    error_msg.textContent = data;
                    error_msg.style.display = "block";
                    success_msg.style.display = "none";
                }
            }
        }
    };

    let formData = new FormData(form);
    xhr.send(formData);
};
