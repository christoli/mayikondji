<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body class="bg-gray x-overflow">

    <!-- Navigation-->
    <nav class="navbar navbar-light static-top shadow">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">
                <img src="../../assets/images/logo.png" alt="Mayi Kondji" width="80" height="64">
            </a>
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="dashboard.php" class="nav-link px-2 link-dark fs-5 hover text-blue">Liste des consultations</a></li>
            </ul>
            <div class="col-md-5 text-end">
                <a href="createPatient.php"><button type="button" class="btn btn-primary">Consulter un patient</button></a>
                <button type="button" class="btn btn-outline-primary me-2 btn-logout" id="logout">Déconnexion</button>
            </div>
        </div>
    </nav>
   <main class="container mt-5">
   <table id="listeConsult" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Motif</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Description de la maladie</th>
                <th>Diagnostic</th>
                <th>Traitement</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tbody">
                   
        </tbody>
   </main>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function () {
    $('#listeConsult').DataTable();
});
</script>
<script src="../../assets/js/logout.js"></script>
<script src="../../assets/js/dashboard.js"></script>
<script src="../../assets/js/deleteConsult.js"></script>
<script src="../../assets/js/updateConsult.js"></script>


</body>
</html>