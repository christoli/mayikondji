let motifField = document.getElementById('motif');
let antecedantField = document.getElementById('antecedant');
let descriptionField = document.getElementById('description');
let examenField = document.getElementById('examen');
let diagnosticField = document.getElementById('diagnostic');
let traitementField = document.getElementById('traitement');
let patientFullname = document.getElementById('patientName');
let errorMsg = document.getElementById('errorMsg');
errorMsg.style.display = "none";

// Show consultation data for update
patientFullname.textContent = localStorage.getItem('patientName');
motifField.value = localStorage.getItem('motif');
antecedantField.value = localStorage.getItem('antecedant');
descriptionField.value = localStorage.getItem('description');
examenField.value = localStorage.getItem('examen');
traitementField.value = localStorage.getItem('traitement');
diagnosticField.value = localStorage.getItem('diagnostic');

//  Update consultation
consultUpdateForm.addEventListener("submit", async (e)=>{
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
        const res = await fetch("/api/consultation/update.php", {
            method: "PUT",
            body: JSON.stringify({"id":localStorage.getItem("updateConsultId"),"motif": motif, "antecedant": antecedant, "description_maladie": description, "examen": examen, "diagnostic":diagnostic, "traitement": traitement,"userId" : localStorage.getItem('userId'), "token": token}),
            headers: {
                "content-Type": "application/json"
            }
        });
        const output = await res.json();

        if(output.success){
            motif = "",
            antecedant = ""
            description = ""
            examen = ""
            diagnostic = ""
            traitement = ""
            alert("Consultation modifiée avec succes");

            // Redirection
            window.location.href = "/vues/consultation/dashboard.php";
        } 
        window.location.href = "/vues/consultation/dashboard.php";
    } catch(error){
        window.location.href = "/vues/consultation/dashboard.php";
            console.log(error.message);
    }


})