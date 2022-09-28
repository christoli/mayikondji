let logout = document.getElementById('logout');
let token = localStorage.getItem("token");

// Click on Deconnexion button
logout.addEventListener("click", async () => {

   try{
        const res = await fetch("/api/medecin/logout.php", {
            method: "DELETE",
            body: JSON.stringify({"token": token}),
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();

        if(output.success){
            localStorage.clear();
            // Redirection au login
            window.location.href = "/vues/consultation/login.php";
        } else {
            alert("La déconnexion a échouée. Veuillez réessayer.");
        }
   } catch(error){
        alert(error.message);
   }
});