<?php
    session_start();

    include('bd/connexionDB.php');

    if (isset($_SESSION['id'])){
        header('Location: index.php');
        exit;
    }

    if(!empty($_POST)){
        extract($_POST);
        $valid = true;

        if (isset($_POST['oublie'])){

            $mail = htmlentities(strtolower(trim($mail))); // On récupére le mail pour la récupération du mot de passe 

            // Si le mail est vide alors on ne traite pas
            if(empty($mail)){
                $valid = false;
                $er_mail = "Il faut mettre un mail";
            }

            if($valid){
                $verification_mail = $DB->query("SELECT nom, prenom, mail, n_mdp 
                    FROM utilisateur WHERE mail = ?",
                    array($mail));

                $verification_mail = $verification_mail->fetch();

                if(isset($verification_mail['mail'])){

                    if($verification_mail['n_mdp'] == 0){
                        // génération d'un mdp grace à la fonction RAND de PHP
                        $new_pass = rand();

                        // génération d'un nombre aléatoire entre 7 et 10 caractares (Lettres et chiffres)
                        $new_pass_crypt = crypt($new_pass, "$6$rounds=5000$macleapersonnaliseretagardersecret$");

                       
                        */
                        $DB->insert("UPDATE utilisateur SET mdp = ?, n_mdp = 1 WHERE mail = ?", 
                            array($new_pass_crypt, $verification_mail['mail']));

                        echo $new_pass;      

                    }   
                } 
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
        <title>Mot de passe oublié</title>
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
                    <h1>Mot de passe oublié</h1>
                    <form method="post">

                        <?php
                            if (isset($er_mail)){
                        ?>
                            <div><?= $er_mail ?></div>
                        <?php   
                            }
                        ?>

                        <div class="mb-3">
                            <label for="email1"> Email </label>
                            <input class="form-control" type="email" id="email1" placeholder="Adresse mail" name="mail" value="<?php if(isset($mail)){ echo $mail; }?>" required>
                        </div>

                        <div>
                            <button  type="submit" class="btn btn-primary" name="oublie">Envoyer</button>
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