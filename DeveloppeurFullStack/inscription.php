<?php
    session_start();

    include('bd/connexionDB.php'); // Fichier php contenant la connection à la BD

    // S'il y a une session alors on ne retourne plus sur cette page
    if (isset($_SESSION['id'])){
        header('Location: index.php'); 
        exit;
    }

    // Si la variable "$_Post" contient des informations alors on les traitres
    if(!empty($_POST)){
        extract($_POST);
        $valid = true;

        // On se place sur le bon formulaire grâce au "name" de la balise "input"
        if (isset($_POST['inscription'])){

            $nom  = htmlentities(trim($nom)); // On récupère le nom
            $prenom = htmlentities(trim($prenom)); // on récupère le prénom
            $mail = htmlentities(strtolower(trim($mail))); // On récupère le mail
            $mdp = trim($mdp); // On récupère le mot de passe 
            $confmdp = trim($confmdp); //  On récupère la confirmation du mot de passe

            //  Vérification du nom
            if(empty($nom)){
                $valid = false;
                $er_nom = ("Le nom d'utilisateur ne peut pas être vide");
            }       

            //  Vérification du prénom
            if(empty($prenom)){
                $valid = false;
                $er_prenom = ("Le prenom d' utilisateur ne peut pas être vide");
            }       

            // Vérification du mail
            if(empty($mail)){
                $valid = false;
                $er_mail = "Le mail ne peut pas être vide";

                // On vérifit que le mail est dans le bon format
            }elseif(!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)){
                $valid = false;
                $er_mail = "Le mail n'est pas valide";

            }else{
                // On vérifit que le mail est disponible
                $req_mail = $DB->query("SELECT mail FROM utilisateur WHERE mail = ?",
                    array($mail));

                $req_mail = $req_mail->fetch();

                if ($req_mail['mail'] <> ""){
                    $valid = false;
                    $er_mail = "Ce mail existe déjà";
                }
            }

            // Vérification du mot de passe
            if(empty($mdp)) {
                $valid = false;
                $er_mdp = "Le mot de passe ne peut pas être vide";

            }elseif($mdp != $confmdp){
                $valid = false;
                $er_mdp = "La confirmation du mot de passe ne correspond pas";
            }

            // Si toutes les conditions sont remplies alors on fait le traitement
            if($valid){

                $mdp = crypt($mdp, "$6$rounds=5000$macleapersonnaliseretagardersecret$");

                $date_creation_compte = date('Y-m-d H:i:s');

                // On insert nos données dans la table utilisateur
                $DB->insert("INSERT INTO utilisateur (nom, prenom, mail, mdp, date_creation_compte) VALUES 
                    (?, ?, ?, ?, ?)", 
                    array($nom, $prenom, $mail, $mdp, $date_creation_compte));

                header('Location: index.php');
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
        <title>Inscription</title>
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

                    <h1>Inscription</h1>
                    <form method="post">

                        <?php
                            // S'il y a une erreur sur le nom alors on affiche
                            if (isset($er_nom)){
                            ?>
                                <div><?= $er_nom ?></div>
                            <?php   
                            }
                        ?>
                         <div class="mb-3">
                            <label for="nom1"> Nom </label>
                            <input class="form-control" type="text" id="nom1" placeholder="Votre nom" name="nom" value="<?php if(isset($nom)){ echo $nom; }?>" required>   
                        </div>

                        <?php
                            if (isset($er_prenom)){
                            ?>
                                <div><?= $er_prenom ?></div>
                            <?php   
                            }
                        ?>
                        <div class="mb-3">
                            <label for="nom1"> Prenom </label>
                            <input class="form-control" type="text" id="prenom1" placeholder="Votre prenom" name="prenom" value="<?php if(isset($prenom)){ echo $prenom; }?>" required> 
                        </div>  

                        <?php
                            if (isset($er_mail)){
                            ?>
                                <div><?= $er_mail ?></div>
                            <?php   
                            }
                        ?>

                        <div class="mb-3">
                            <label for="mail1"> Email </label>
                            <input class="form-control" type="email" id="mail1" placeholder="Adresse mail" name="mail" value="<?php if(isset($mail)){ echo $mail; }?>" required>
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
                            <input class="form-control" type="password" id="mdp1" placeholder="Mot de passe" name="mdp" value="<?php if(isset($mdp)){ echo $mdp; }?>" required>
                        </div>

                         <div class="mb-3">
                            <label for="mdp2"> Confirmation mot de passe </label>
                            <input class="form-control" type="password" id="mdp2" placeholder="Confirmer le mot de passe" name="confmdp" required>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary" name="inscription">Envoyer</button>
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