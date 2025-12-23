let nameError = document.querySelector("#nameError");
let emailError = document.querySelector("#emailError");
let subjectError = document.querySelector("#subjectError");
let messageError = document.querySelector("#messageError");

let nameInput = document.querySelector("#full_name");
let emailInput = document.querySelector("#email");
let subjectInput = document.querySelector("#subject");
let messageInput = document.querySelector("#message");

let submitFormBtn = document.querySelector("#submitFormBtn");
let isFormSubmitted = false;

console.log(isFormSubmitted);

// Attach input listeners safely
[nameInput, emailInput, subjectInput, messageInput].forEach(field => {
    if (field) {
        field.addEventListener("input", function () {
            showErrorMessage(field);
        });
    }
});

function showErrorMessage(field) {
    isFormSubmitted = true;

    if (!field) return;

    let errorEl = field.nextElementSibling;
    if (!errorEl) return;

    // Empty field check
    if (field.value === "") {
        errorEl.textContent = "Field must not be empty";
        return;
    } else {
        errorEl.textContent = "";
    }

    // Message length check (textarea)
    if (
        field.tagName === "TEXTAREA" &&
        field.value.length < 20 &&
        field.value !== ""
    ) {
        errorEl.textContent = "Message must not be less than 20 characters";
        return;
    }

    // Email validation
    if (
        field.type === "email" &&
        field.value !== "" &&
        !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)
    ) {
        errorEl.textContent = "Invalid Email";
        return;
    }
}

function submitMessage(event) {
    event.preventDefault();

    let data = new FormData(event.target);

    fetch("../form/handler.php", {
        method: "POST",
        body: data
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === "success") {
            alert(data.message);
            event.target.reset();
        } else {
            alert(data.message);
        }
    })
    .catch(err => {
        console.error(err);
        alert("Server error");
    });
}


// Submit button validation
if (submitFormBtn) {
    submitFormBtn.addEventListener("click", function () {
        isFormSubmitted = true;
        console.log(isFormSubmitted);

        [nameInput, emailInput, subjectInput, messageInput].forEach(field => {
            if (field) showErrorMessage(field);
        });

        setTimeout(() => {
            isFormSubmitted = false;
        }, 2000);
    });
}

// Admin Login
function submitAdminLogin(event) {
    event.preventDefault();
    console.log("Hello From Admin");

    let data = new FormData(event.target);

    fetch("../login/handler.php", {
        method: "POST",
        body: data
    })
        .then(r => r.json())
        .then(d => {
            if (d.status === "success") {
                window.location.href = "../dashboard/";
            } else {
                console.error("Login failed");
            }
        })
        .catch(error => {
            console.error(error);
        });
}
