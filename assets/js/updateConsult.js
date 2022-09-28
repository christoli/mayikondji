let motifField = document.getElementById('motif');
let antecedantField = document.getElementById('antecedant');
let descriptionField = document.getElementById('description');
let examenField = document.getElementById('examen');
let diagnosticField = document.getElementById('diagnostic');
let traitementField = document.getElementById('traitement');
let patientName = document.getElementById('patientName');

let consultUpdateForm = document.getElementById('consultUpdateForm');
// edit consultation

const editConsult = async (id) => {

    const res = await fetch(`/api/consultation/read_single.php?id=${id}`, {
        method: "GET",
        headers: { 'Content-Type': 'application/json' }
    })
    const output = await res.json(); 
    console.log(output);
    if (output["empty"] !== "empty") {
        for (var i in output) {
            
            localStorage.setItem("updateConsultId",output['id']);
            localStorage.setItem("motif",output['motif']);
            localStorage.setItem("antecedant",output['antecedant']);
            localStorage.setItem("description",output['description_maladie']);
            localStorage.setItem("examen",output['examen']);
            localStorage.setItem("traitement",output['traitement']);
            localStorage.setItem("diagnostic",output['diagnostic']);
            localStorage.setItem("patientName",output['lastname'] + " " +output['firstname']);

            window.location.href = "/vues/consultation/consultationUpdate.php";
        }
    }

}