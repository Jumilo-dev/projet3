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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (min-width: 401px)" href="style_medium.css">
    <link rel="stylesheet" media="screen and (max-width: 400px)" href="style_smart.css">
    <script src="https://kit.fontawesome.com/937bb03074.js" crossorigin="anonymous"></script>
    


</head>

<body>
<!-- En tête si utilisateur connecté-->       
<?php if(isset($_SESSION["utilisateur"])):?>
    <div class="header">
        <div class="header_logo">
            <a href="../../GBAF/principal.php" data-bs-placement="right" title="Nos partenaires">
            <img src="../../GBAF/image/logo_gbaf.png"  alt="Logo GBAF rouge">
            </a>
        </div>  
        <div class="header_text">
            <a href= "../../GBAF/profil.php">
            <i class="fas fa-user-edit" title="Profil"></i></a>
            <p class="connect"><?= ucfirst($_SESSION["utilisateur"]["prenom"]) ?> <?= ucfirst($_SESSION["utilisateur"]["nom"])?></p>
            <a href ="../../GBAF/deconnexion.php" >       
            <i class="fas fa-unlock-alt" title="Déconnexion"></i>
            </a>  
        </div>
    </div>
    
<!-- En tête si utilisateur non connecté-->
<?php else: ?>
    <div class="header">
            <div class="header_logo">
                <a href="../../GBAF/index.php" data-bs-placement="right" title="Accueil">
                <img src="../../GBAF/image/logo_gbaf.png"  alt="Logo GBAF rouge">
                </a>
            </div>
            <div class="header_text">
                <p>Bonjour,</p>
            </div>
    </div>        
        

<?php endif;?>
        
        
    
    

