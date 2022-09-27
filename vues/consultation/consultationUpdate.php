<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la consultation</title>
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
            <div class="row text-center mt-4">
             <span class="fs-5" id="patientName"></span> 
            </div>
            <div class="row justify-content-center">
            <div class="col-10">
                    <form class="row g-3 pb-4 pe-3 ps-3 pt-3 mt-5 bg-white radius shadow">
                        <div class=" col-md-6 form-floating">
                            <textarea class="form-control" id="motif" style="height: 70px" required></textarea>
                            <label for="motif" class="fs-5">Motif</label>
                        </div>
                        <div class=" col-md-6 form-floating">
                            <textarea class="form-control" id="antecedant" style="height: 70px" required></textarea>
                            <label for="antecedant"  class="fs-5">Antecedant</label>
                        </div>
                        <div class=" col-md-6 form-floating">
                            <textarea class="form-control" id="description" style="height: 70px" required></textarea>
                            <label for="description" class="fs-5">Description de la maladie</label>
                        </div>
                        <div class=" col-md-6 form-floating">
                            <textarea class="form-control" id="examen" style="height: 70px" required></textarea>
                            <label for="examen" class="fs-5">Examen</label>
                        </div>
                        <div class=" col-md-6 form-floating">
                            <textarea class="form-control" id="diagnostic" style="height: 70px" required></textarea>
                            <label for="diagnostic" class="fs-5">Diagnostic</label>
                        </div>
                        <div class=" col-md-6 form-floating">
                            <textarea class="form-control" id="traitement" style="height: 70px" required></textarea>
                            <label for="traitement" class="fs-5">Traitement</label>
                        </div>
                        <div class="col-12 text-center mt-5">
                            <button type="submit" class="btn btn-primary">Modifier</button>
                        </div>
                    </form>
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