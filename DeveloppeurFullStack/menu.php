<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Accueil</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php
                        if(!isset($_SESSION['id'])){
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="g_glossaire/glossaire.php">Glossaire</a>
                                </li>
                            <?php
                        }else{
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="profil.php">Mon profil</a>
                                </li>
                            <?php
                        } 
                    ?>
                </ul>

                <ul class="navbar-nav mr-md-auto">


                    <?php
                        if(!isset($_SESSION['id'])){
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="inscription.php">Inscription</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="connexion.php">Connexion</a>
                                </li>
                            <?php
                        }else{
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="deconnexion.php">déconnexion</a>
                                </li>
                            <?php
                        } 
                    ?>
                </ul>
            </div>
        </div>
</nav>