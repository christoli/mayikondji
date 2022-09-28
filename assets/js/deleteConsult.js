// delete consultation
const deleteConsult = async (id) => {
    const res = await fetch("/api/consultation/delete.php", {
        method: "DELETE",
        body: JSON.stringify({"id":id}),
        headers: {
            "Content-Type": "application/json"
        }
    });
    const output = await res.json();
    if (output.success) {
        window.location.href = "/vues/consultation/dashboard.php";
        // console.log(document.getElementsByClassName('deleteRow').parentElement.parentElement);
    } else {
        console.log("Probleme a la suppression");
    }
}
