let motifField = document.getElementById('motif');
let antecedantField = document.getElementById('antecedant');
let descriptionField = document.getElementById('description');
let examenField = document.getElementById('examen');
let diagnosticField = document.getElementById('diagnostic');
let traitementField = document.getElementById('traitement');
let patientFullname = document.getElementById('patientFullname');

patientFullname.value = patientLastname + " " + patientFirstname;
// Get id form
let consultCreateForm = document.getElementById('consultCreateForm');

// On submit
consultCreateForm.addEventListener("submit", async (e)=>{
    try{
        e.preventDefault();
        let motif = motifField.value;
        let antecedant = antecedantField.value;
        let description = descriptionField.value;
        let examen = examenField.value;
        let diagnostic = diagnosticField.value;
        let traitement = traitementField.value;

        if(motif == "" || antecedant == "" || description == "" || examen == "" || traitement == ""){
            motifField.classList.add('is-invalid');
            antecedantField.classList.add('is-invalid');
            descriptionField.classList.add('is-invalid');
            examenField.classList.add('is-invalid');
            diagnosticField.classList.add('is-invalid');
            traitementField.classList.add('is-invalid');
            alert('Veuillez remplir tous les champs !');
        }
        // Send and verify login information
        const res = await fetch("/api/consultation/create.php", {
            method: "POST",
            body: JSON.stringify({"motif": lastname, "antecedant": antecedant, "description_maladie": description, "examen": examen, "traitement": traitement, "userId" : medecinId, "token": patientCreateToken}),
            headers: {
                "content-Type": "application/json"
            }
        });
        const output = await res.json();

        if(output.success){
            alert("Consultation créée avec succes");
            // Redirection
            window.location.href = "/vues/consultation/dashboard.php";
        } else {
                motifField.classList.add('is-invalid');
                antecedantField.classList.add('is-invalid');
                descriptionField.classList.add('is-invalid');
                examenField.classList.add('is-invalid');
                diagnosticField.classList.add('is-invalid');
                traitementField.classList.add('is-invalid');
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

})