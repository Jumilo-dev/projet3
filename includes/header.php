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
    <!-- insertion du titre de la page avec par defaut GBAF-->
    <title>
        <?php if (isset($title)):?>
            <?= $title ?>
        <?php else : ?>
             GBAF
        <?php endif ?>
    </title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/937bb03074.js" crossorigin="anonymous"></script>
    


</head>

<body>
<!-- En tête si utilisateur connecté-->       
<?php if(isset($_SESSION["utilisateur"])):?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-5 col-lg-4 text-left">
                <a href="../../GBAF/principal.php" data-bs-placement="right" title="Nos partenaires">
                <img src="../../GBAF/image/logo_gbaf.png"  alt="Logo GBAF rouge " class="img-fluid">
                </a>
            </div>  
            <div class=" h1 col-sm-12 col-md-7 col-lg-5 offset-lg-3  align-self-start text-right">
                <a  class="text-secondary" href= "../../GBAF/profil.php">
                <i class="fas fa-user-edit" data-bs-placement="right" title="Mon profil"></i></a>
                <?= $_SESSION["utilisateur"]["prenom"]?> <?= $_SESSION["utilisateur"]["nom"]?>
                <a class="text-secondary" href ="../../GBAF/deconnexion.php" >       
                <i class="fas fa-unlock-alt" data-bs-toggle="tooltip" data-bs-placement="right" title="Se déconnecter"></i>
                </a>  
            </div>
        </div>
    </div>
<!-- En tête si utilisateur non-connecté-->
<?php else: ?>
    <div class="container">
        <div class="row justify-content-between ">
            <div class="col-sm-12 col-md-4 col-lg-4">    
                <a href="../../GBAF/index.php" data-bs-placement="right" title="Accueil">
                <img src="../../GBAF/image/logo_gbaf.png"  alt="Logo GBAF rouge" class="text-center- sm text-left-md">
                </a>
            </div>
            <div class="col-sm-12 col-md-2 col-lg-2 col-2">
                <p class=" h1 text-center-sm text-right-md">Bonjour,</p>
            </div>
        
            
        </div>
    </div>

<?php endif;?>
        
        
    
    

