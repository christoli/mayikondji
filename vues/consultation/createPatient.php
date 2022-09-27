<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrégistrement du patient</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body class="bg-gray x-overflow">
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
             <span class="fs-5">Enrégistrement du patient</span> 
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    <form class="row g-3 pb-4 pe-3 ps-3 pt-3 mt-4 bg-white radius shadow">
                        <div class="col-md-6 ">
                            <label for="lastname" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="lastname">
                        </div>
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="firstname">
                        </div>
                        <div class="col-md-6">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="telephone">
                        </div>
                        <div class="col-md-6">
                            <label for="birthday" class="form-label">Date de naissance</label>
                            <input type="date" class="form-control" id="birthday">
                        </div>
                        <div class="col-12">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" placeholder="Ville, quartier, rue">
                        </div>
                        <div class="form-check col-md-4 ps-5 mt-4 ms-homme">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="homme">
                            <label class="form-check-label" for="homme">
                                Homme
                            </label>
                        </div>
                        <div class="form-check col-md-4 ps-5 mt-4">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="femme" checked>
                            <label class="form-check-label" for="femme">
                                Femme
                            </label>
                        </div>
                        <div class="col-6 mt-3">
                            <button type="submit" class="btn btn-secondary">Annuler</button>
                        </div>
                        <div class="col-6 text-end mt-3">
                            <button type="submit" class="btn btn-primary">Suivant</button>
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