<?php
session_start();
include_once "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($title)){echo $title;} else {echo 'GBAF';} ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
            
        <?php if(isset($_SESSION["utilisateur"])):?>
            <div class="container">
                <div class="row  align-items-center text-center">
           
                <a   class = "col-sm-12 col-md-6 col-lg-4 align-self-center" href="../../GBAF/principal.php">
                <img src="../../GBAF/image/LOGO_GBAF_ROUGE2.png"  alt="Logo GBAF rouge " class="">
                </a>  

                <div class=" h1 col-sm-12 col-md-6 col-lg-4 offset-lg-4 align-self-start">
                <img src="../../GBAF/image/person-circle.svg" alt="utilisateur">
                <a href= "../../GBAF/profil.php"> <?= $_SESSION["utilisateur"]["prenom"]?> <?= $_SESSION["utilisateur"]["nom"]?></a>
                <a href ="../../GBAF/deconnexion.php">
                <img src="../../GBAF/image/lock-fill.svg"  alt="cadenas deconnexion">
                </a>  

            </div>
  
        
        <?php else: ?>
            <div class="container">
                <div class="row p-4">
           
                <a   class = "col-4" href="../../GBAF/index.php">
                <img src="../../GBAF/image/LOGO_GBAF_ROUGE.png"  alt="Logo GBAF rouge"class="h-25">
                </a>  
        
                <p class=" h1 col-4 offset-4">Bonjour,</p>
        
            
        <?php endif;?>
        
        
    
    

