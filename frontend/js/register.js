const form = document.querySelector(".wrapper .form.signup form"),
submitbtn = form.querySelector(".field.button input"),
error_msg = document.querySelector(".wrapper .error p");

form.onsubmit = (e) => {
    e.preventDefault(); 
};

submitbtn.onclick = () => {
let xhr = new XMLHttpRequest();
xhr.open("POST", "../../backend/register.php", true);
xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
    if (xhr.status == 200) {
        let data = xhr.responseText;
        if (data.trim() === "success") {
            location.href = "./login.php";
        } else {
        error_msg.textContent = data;
        error_msg.style.display = "block";
        }
    }
    }
};
let formData = new FormData(form);
xhr.send(formData);
};
