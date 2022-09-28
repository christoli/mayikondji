let loginForm = document.getElementById('loginForm');
let identifiantField = document.getElementById('identifiant');
let passwordField = document.getElementById('password');
let errorMsg = document.getElementById('errorMsg');
errorMsg.style.display = "none";
let token = "";
let userId = "";
let medLastname = "";
let medFirstname = "";

// Identifiant input validation
let idValidator = /^[0-9a-zA-Z]+$/;

// Login control
loginForm.addEventListener("submit", async (e)=>{
    try{
        e.preventDefault();
        let identifiant = document.getElementById('identifiant').value;
        let password = document.getElementById('password').value;

        if(identifiant == "" || password == ""){
            identifiantField.classList.add('is-invalid');
            passwordField.classList.add('is-invalid');
            alert('Veuillez remplir tous les champs !');
        }
        // Send and verify login information
        const res = await fetch("/api/medecin/login.php", {
            method: "POST",
            body: JSON.stringify({"identifiant":identifiant, "password": password}),
            headers: {
                "content-Type": "application/json"
            }
        });
        const output = await res.json();

        if(output.success){
            // Clear fields
            identifiant = "";
            password = "";
            // Get data
            userId = output.identifiant;
            medLastname = output.lastname;
            medFirstname = output.firstname;
            token = output.token
            // Save login data in localStorage
            localStorage.setItem("userId", userId);
            localStorage.setItem("token", token);
            localStorage.setItem("lastname", medLastname);
            localStorage.setItem("firstname", medFirstname);
            // Redirection
            window.location.href = "/vues/consultation/dashboard.php";
        } else {
            identifiantField.classList.add('is-invalid');
            passwordField.classList.add('is-invalid');
            // alert('Identifiant ou mot de passe incorrect !');
            errorMsg.style.display = "block";
            errorMsg.textContent = "Identifiant ou mot de passe incorrect !";
            setTimeout(() => {
                errorMsg.style.display = "none";
                errorMsg.textContent = "";
            }, 5000)
        }
    } catch(error){
            errorMsg.style.display = "block";
            errorMsg.textContent = error.message;
            setTimeout(() => {
                errorMsg.style.display = "none";
                errorMsg.textContent = "";
            }, 5000)
    }
    
});