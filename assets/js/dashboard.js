// select Consultation
const getConsultations = async () => {
    try {
        let userId = localStorage.getItem("userId");
        const tbody = document.getElementById("tbody");
        let tr = "";
        const res = await fetch("/api/consultation/read.php", {
            method: "GET",
            headers: {
                "Content-Type": "application/json"
            }
        });

        const output = await res.json();
        if (output.empty === "empty") {
            tr = "<tr>Record Not Found</td>"
        } else {
            for (var i in output) {
                tr += `
            <tr>
            <td>${parseInt(i) + 1}</td>
            <td>${output[i].motif}</td>
            <td>${output[i].lastname}</td>
            <td>${output[i].firstname}</td>
            <td>${output[i].description_maladie}</td>
            <td>${output[i].diagnostic}</td>
            <td>${output[i].traitement}</td>
            <td>${output[i].created_at}</td>
            <td><button onclick="editConsult(${output[i].id})" class="btn btn-success">Editer</button></td>
            <td><button onclick="deleteConsult(${output[i].id})"  class="btn btn-danger">Suppr.</button></td>
            </tr>`
            }
        }
        tbody.innerHTML = tr;
    } catch (error) {
        console.log("error " + error)
    }
}

getConsultations();