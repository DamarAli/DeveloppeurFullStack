<?php
    session_start(); // Permet de savoir s'il y a une session. 

    include('../bd/connexionDB.php'); // Fichier PHP contenant la connexion à votre BDD



    $req = $DB-> query("select glossaire_a.titre as A, glossaire_b.titre as B, glossaire_c.titre as C, glossaire_d.titre as D,glossaire_e.titre as E, glossaire_f.titre as F  from glossaire_a left join glossaire_b on glossaire_a.id = glossaire_b.id left join glossaire_c on glossaire_b.id = glossaire_c.id left join glossaire_d on glossaire_c.id = glossaire_d.id left join glossaire_e on glossaire_d.id = glossaire_e.id left join glossaire_f on glossaire_e.id = glossaire_f.id ; ;");
    $req = $req->fetchAll ();

   

    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
        <title>Glossaire</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet"/>
        <link href="../css/style.css" rel="stylesheet"/>



    </head>

    <body>

        

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="../index.php">Accueil</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <?php
                                if(!isset($_SESSION['id'])){
                                    ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../g_glossaire">Glossaire</a>
                                        </li>
                                    <?php
                                }else{
                                    ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../profil.php">Mon profil</a>
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
                                            <a class="nav-link" href="../inscription.php">Inscription</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../connexion.php">Connexion</a>
                                        </li>
                                    <?php
                                }else{
                                    ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../deconnexion.php">déconnexion</a>
                                        </li>
                                    <?php
                                } 
                            ?>
                        </ul>
                    </div>
                </div>
        </nav>

	   <h1 style="text-align:center">Glossaire</h1>

        <div class="container">
            <div style="margin:0 25% 0 25%">

                <p class="text-center">
                   Le vocabulaire du web peut parfois paraître flou, voir complètement inconnu pour certains. Le glossaire intervient en permettant de découvrir tous les termes et applications du web, des liens vers des articles illustrant la définition du mot dans le contexte.
                </p>
            <br/>
            </div>
        </div>
	        
        <div class="container" id="glossaire">
 	        <div class="row">   

    	        <div class="col-0 col-sm-0 col-md-2 col-lg-3"></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-6">

	            
    	            <div class="table-responsive">
                        <table classe="table table-striped">
                            <tr>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>

                            </tr>
                            
                            <?php
                           
                                foreach($req as $r){
                            ?>   
                            <tr>
                                <td><?= $r['A'] ?> </td>
                                <td><?= $r['B'] ?> </td>
                                <td><?= $r['C'] ?> </td>
                          
                              
                            </tr>
                        <?php
                        }
                        ?>

                         
                        </table>
    	            </div>
            	</div>
    	    </div>
             <br/>
             <br/>
    	</div>

       
        <div class="container" id="glossaire">
            <div class="row">   

                <div class="col-0 col-sm-0 col-md-2 col-lg-3"></div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-6">

                
                    <div class="table-responsive" class="d-block">
                        <table classe="table table-striped">
                            <tr>
                                <th>D</th>
                                <th>B</th>
                                <th>C</th>

                            </tr>
                            
                            <?php
                           
                                foreach($req as $r){
                            ?>   
                            <tr>
                                <td><?= $r['D'] ?> </td>
                                <td><?= $r['E'] ?> </td>
                                <td><?= $r['F'] ?> </td>
                          
                              
                            </tr>
                        <?php
                        }
                        ?>

                         
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>    

	
    </body>
</html>