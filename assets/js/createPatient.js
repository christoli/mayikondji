let patientCreateForm = document.getElementById('patientCreateForm');
let cancelPatientCreate = document.getElementById('cancelPatientCreate');
let patientCreateToken = localStorage.getItem("token");
let lastnameField = document.getElementById('lastname');
let firstnameField = document.getElementById('firstname');
let telephoneField = document.getElementById('telephone');
let birthdayField = document.getElementById('birthday');
let adresseField = document.getElementById('adresse');
let homme = document.getElementById('homme');
let femme = document.getElementById('femme');
let phoneValidator = /^\d{8}$/;
let errorMsg = document.getElementById('errorMsg');
errorMsg.style.display = "none";

// Patient data variables
let patientId = "";
let patientLastname = "";
let patientFirstname = "";

// Get medecin identifiant
let medecinId = localStorage.getItem("userId");

// Login control
patientCreateForm.addEventListener("submit", async (e)=>{
    try{
        e.preventDefault();
        let lastname = lastnameField.value;
        let firstname = firstnameField.value;
        let telephone = telephoneField.value;
        let birthday = birthdayField.value;
        let adresse = adresseField.value;
        let sexe = homme.checked?"Homme":"Femme";

        if(lastname == "" || firstname == "" || telephone == "" || birthday == "" || adresse == ""){
            lastnameField.classList.add('is-invalid');
            firstnameField.classList.add('is-invalid');
            telephoneField.classList.add('is-invalid');
            birthdayField.classList.add('is-invalid');
            telephoneField.classList.add('is-invalid');
            adresseField.classList.add('is-invalid');
            alert('Veuillez remplir tous les champs !');
        }
        // Phone number validaton
        if(!(telephone.match(phoneValidator))){
            telephoneField.classList.add('is-invalid');
            alert('Votre numero est invalide !');
        }
        // Send and verify login information
        const res = await fetch("/api/patient/create.php", {
            method: "POST",
            body: JSON.stringify({"lastname": lastname, "firstname": firstname, "telephone": telephone, "birthday": birthday, "adresse": adresse, "sexe": sexe, "userId" : medecinId, "token": patientCreateToken}),
            headers: {
                "content-Type": "application/json"
            }
        });
        const output = await res.json();

        if(output.success){
            // Get data
            patientId = output.id;
            patientLastname = output.lastname;
            patientFirstname = output.firstname;
            // Redirection
            window.location.href = "/vues/consultation/createConsultation.php";
        } 
        if(!output.success){
                lastnameField.classList.add('is-invalid');
                firstnameField.classList.add('is-invalid');
                telephoneField.classList.add('is-invalid');
                birthdayField.classList.add('is-invalid');
                telephoneField.classList.add('is-invalid');
                adresseField.classList.add('is-invalid');
                errorMsg.style.display = "block";
                errorMsg.textContent = "Veuillez remplir correctement les champs !";
                setTimeout(() => {
                    errorMsg.style.display = "none";
                    errorMsg.textContent = "";
                }, 5000)
                }
    } catch(error){
            console.log(error.message);
    }
});