let loginForm = document.getElementById('loginForm');
let token = "";
let userId = "";
let medlastname = "";
let medFirstname = "";

// Login control
loginForm.addEventListener("submit", async (e)=>{
    try{
        e.preventDefault();
        let identifiant = document.getElementById('identifiant').value;
        let password = document.getElementById('password').value;
    
        // Send and verify login information
        const res = await fetch("/api/medecin/login.php", {
            method: "POST",
            body: JSON.stringify({"identifiant":identifiant, "password": password}),
            headers: {
                "content-Type": "application/json"
            }
        });
        const output = await res.json();

        if(output){
            // Clear fields
            identifiant = "",
            password = ""

            // 
            window.location.href = "/vues/consultation/dashboard.php";
        }
    } catch(error){

    }
    
});