<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultation</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-light static-top shadow">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">
                <img src="../../assets/images/logo_120x96.png" alt="Mayi Kondji" width="80" height="64">
            </a>
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="#" class="nav-link px-2 link-dark fs-5 hover">Consultations</a></li>
                <li><a href="#" class="nav-link px-2 link-dark fs-5 hover">Patients</a></li>
            </ul>
            <div class="col-md-5 text-end">
                <a href="createPatient.php"><button type="button" class="btn btn-primary">Consulter un patient</button></a>
                <a href="#"><button type="button" class="btn btn-outline-primary me-2 btn-logout">Déconnexion</button></a>
            </div>
        </div>
    </nav>
   <main class="container">
        <div class="container">
            <div class="row text-center mt-4 mb-5">
             <span class="fs-5" id="patientName"></span> 
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-3">
                <div class="col">
                    <div class="card">
                    <div class="card-header">Motif</div>
                    <div class="card-body">
                        <p class="card-text" id="motifView">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Antecedant</div>
                    <div class="card-body">
                        <p class="card-text" id="antecedantView">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Description de la maladie</div>
                    <div class="card-body">
                        <h5 class="card">
                        <p class="card-text" id="descriptionView">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Examen</div>
                    <div class="card-body">

                        <p class="card-text" id="examenView">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Diagnostic</div>
                    <div class="card-body">
                        <p class="card-text" id="diagnosticView">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-header">Traitement</div>
                    <div class="card-body">
                        <p class="card-text" id="traitementView">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    </div>
                </div>
                <div class="col-md-12 text-center mt-5">
                    <button class="btn btn-primary" id="updateConsultation">Modifier</button>
                </div>
            </div>
        </div>
   </main>
   
   <footer class="login-footer">
    <div class="row pt-2 pb-2">
        <div class="col-12 text-center">
            <p class="">
            &copy; Copyright <?= date('Y'); ?>. MayiKondji
            </p>
        </div>
    </div>
</footer>
</body>
</html>