<?php
    session_start();

    include('bd/connexionDB.php'); // Fichier PHP contenant la connexion à la BDD

  // S'il y a une session alors on ne retourne plus sur cette page  
    if (isset($_SESSION['id'])){
        header('Location: index.php');
        exit;
    }

    // Si la variable "$_Post" contient des informations alors on les traitres
    if(!empty($_POST)){
        extract($_POST);
        $valid = true;

        if (isset($_POST['connexion'])){

            $mail = htmlentities(strtolower(trim($mail)));
            $mdp = trim($mdp);

            if(empty($mail)){ // Vérification si un mail est saisi
                $valid = false;
                $er_mail = "Il faut mettre un mail";
            }

            if(empty($mdp)){ // Vérification si un mdp saisi
                $valid = false;
                $er_mdp = "Il faut mettre un mot de passe";
            }

            // On fait une requête pour savoir si le couple mail / mot de passe existe bien car le mail est unique !
            $req = $DB->query("SELECT * 
                FROM utilisateur 
                WHERE mail = ? AND mdp = ?",
                array($mail, crypt($mdp, "$6$rounds=5000$macleapersonnaliseretagardersecret$")));

            $req = $req->fetch();

            // Si on a pas de résultat alors c'est qu'il n'y a pas d'utilisateur correspondant au couple mail / mot de passe
            if ($req['id'] == ""){
                $valid = false;
                $er_mail = "Le mail ou le mot de passe est incorrecte";
            }

            // S'il y a un résultat alors on va charger la SESSION de l'utilisateur en utilisateur les variables $_SESSION
            if ($valid){

                $_SESSION['id'] = $req['id']; // id de l'utilisateur unique pour les requêtes futures
                $_SESSION['nom'] = $req['nom'];
                $_SESSION['prenom'] = $req['prenom'];
                $_SESSION['mail'] = $req['mail'];

                header('Location:  index.php');
                exit;
            }   
        }
    }
?>


<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Connexion</title>
        <link href="css/bootstrap.min.css" rel="stylesheet"/>
    </head>

    <body>

        <?php
            require_once('menu.php');
        ?>
    

        <div class="container">
            <div class="row">   

                <div class="col-0 col-sm-0 col-md-2 col-lg-3"></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-6">
                    <h1>Se connecter</h1>
                    <form method="post">

                        <?php
                            if (isset($er_mail)){
                        ?>
                            <div><?= $er_mail ?></div>
                        <?php   
                            }
                        ?>
                        <div class="mb-3">
                            <label for="mail1"> Email </label>
                            <input class="form-control" type="email" id="email1" placeholder="Adresse mail" name="mail" value="<?php if(isset($mail)){ echo $mail; }?>" required>
                        </div>

                        <?php
                            if (isset($er_mdp)){
                        ?>
                            <div><?= $er_mdp ?></div>
                        <?php   
                            }
                        ?>
                        <div class="mb-3">
                            <label for="mdp1"> Mot de passe </label>
                            <input class="form-control" id="mdp1" type="password" placeholder="Mot de passe" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" required>
                        </div>


                        <a href="motdepasse.php">Mot de passe oublie</a>

                        <div>

                            <button type="submit" class="btn btn-primary" name="connexion">Se connecter</button>
                        </div>

                    </form>
                </div>
            </div>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>    
    </body>
</html>