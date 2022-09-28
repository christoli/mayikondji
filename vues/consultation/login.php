<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body class="bg-gray x-overflow">

    <!-- Navigation-->
    <nav class="navbar navbar-light static-top shadow">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../../assets/images/logo.png" alt="Mayi Kondji" width="80" height="64">
            </a>
            <span class="fs-5 text-blue">Gestion des consultations</span>
        </div>
    </nav>
   <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 col-lg-4 mt-4">
                    <div class="alert alert-danger" id="errorMsg" role="alert">
                    </div>
                    <form class="mt-5 p-3 shadow login-form" id="loginForm">
                        <h2 class="mb-4 text-center">Connexion</h2>
                        <div class="mb-3">
                            <!-- <label for="identifiant" class="form-label">Identifiant</label> -->
                            <input type="text" class="form-control" id="identifiant" placeholder="Identifiant" >
                        </div>
                        <div class="mb-4">
                            <!-- <label for="password" class="form-label">Mot de passe</label> -->
                            <input type="password" class="form-control" id="password" placeholder="Mot de passe">
                        </div>
                        <div class="mb-3 text-center">
                            <button type="submit" class="btn btn-primary bg-blue">Se connecter</button>
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
    <script src="../../assets/js/login.js"></script>
</body>
</html>