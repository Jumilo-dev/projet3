<?php
session_start();
include_once "functions.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($title)){echo $title;} else {echo 'GBAF';} ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/937bb03074.js" crossorigin="anonymous"></script>
    


</head>

<body>
            
        <?php if(isset($_SESSION["utilisateur"])):?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-5 col-lg-4 mx-auto">
                    <a href="../../GBAF/principal.php" data-bs-placement="right" title="Nos partenaires">
                    <img src="../../GBAF/image/LOGO_GBAF_ROUGE2.png"  alt="Logo GBAF rouge " class="img-fluid">
                    </a>
                    </div>  

                    <div class=" h1 col-sm-12 col-md-7 col-lg-5  align-self-start mx-auto g-0">
                    <a  class="text-secondary" href= "../../GBAF/profil.php">
                    <i class="fas fa-user-edit" data-bs-placement="right" title="Mon profil"></i></a>
                
                    <?= $_SESSION["utilisateur"]["prenom"]?> <?= $_SESSION["utilisateur"]["nom"]?>
                    <a  class="text-secondary" href ="../../GBAF/deconnexion.php" >
                
                    <i class="fas fa-unlock-alt" data-bs-toggle="tooltip" data-bs-placement="right" title="Se déconnecter"></i>
                    </a>  
                    </div>
                </div>
            </div>
  
        
        <?php else: ?>
            <div class="container">
                <div class="row p-4">
           
                <a   class = "col-4" href="../../GBAF/index.php" data-bs-placement="right" title="Accueil">
                <img src="../../GBAF/image/LOGO_GBAF_ROUGE.png"  alt="Logo GBAF rouge" class="h-25">
                </a>  
        
                <p class=" h1 col-4 offset-4">Bonjour,</p>
                </div>
            </div>
            
        <?php endif;?>
        
        
    
    

