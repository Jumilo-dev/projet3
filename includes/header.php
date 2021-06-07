<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($title)){echo $title;} else {echo 'GBAF';} ?></title>
    
</head>
<body>
    
        
        
            <a  href="../../GBAF/index.php">
            <img src="../../GBAF/image/LOGO_GBAF_ROUGE.png"  alt="Logo GBAF rouge">
            </a>  
        
            
            
        <?php if(isset($_SESSION["utilisateur"])):?>
          
        
            <a href= "../../GBAF/profil.php"> <?= $_SESSION["utilisateur"]["prenom"]?> <?= $_SESSION["utilisateur"]["nom"]?></a>
            <a href="../../GBAF/deconnexion.php">Se déconnecter</a>
                
        
        <?php else: ?>
        
        
            <p>Bonjour,</p>
        
            
        <?php endif;?>
        
    
    

</body>
</html>