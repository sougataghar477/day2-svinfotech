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
[nameInput,emailInput,subjectInput,messageInput]?.forEach(field =>{
    field?.addEventListener("input",()=>{showErrorMessage(field)});
})

function showErrorMessage(field){
    isFormSubmitted=true;
     if(isFormSubmitted){
        if(field?.value===""){
            field.nextElementSibling.textContent="Field must not be empty";
        }
        else{
            field?.nextElementSibling.textContent="";
        }
        if(field?.type ==="textarea" && field?.value.length<20 && field.value !==""){
            field.nextElementSibling.textContent="Message must not be less than 20 characters";
        }
        if(field?.type ==="email" && field?.value!=="" && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)){
            field.nextElementSibling.textContent="Invalid Email";
        }
    }
}

function submitMessage(event){
    event.preventDefault();

    let data = new FormData(event.target);

    fetch("../form/handler.php",{
        method:'POST',
        body:data
    })
    .then(r => r.json())
    .then(d => {
        alert("Form submitted successfully!");
    })
    .catch(error => {
        console.error(error);
        alert("Something went wrong!");
    });
}

submitFormBtn?.addEventListener("click",()=>{
    isFormSubmitted = true;
    console.log(isFormSubmitted);
    [nameInput,emailInput,subjectInput,messageInput]?.forEach(field =>{
    showErrorMessage(field)
});
    setTimeout(() => {
        isFormSubmitted = false;
    }, 2000);
})
// Admin Login
function submitAdminLogin(event){
    event.preventDefault();
    console.log("Hello From Admin");
    let data = new FormData(event.target);
    try {
        fetch("../login/handler.php",{
            method:'POST',
            body:data
        
        })
        .then(r => r.json())
        .then(d => {
            if(d.status==="success"){
               window.location.href = "../dashboard";
            }
            else{
                console.error("Error somewhere")
            }
        })
        
    } 
    catch (error) {
        console.error(error)
    }
}
 
 
 