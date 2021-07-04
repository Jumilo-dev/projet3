<?php
include 'includes/header.php';
include 'includes/connect_bdd.php';
?>


<div class="container">
<!--on affiche les messages d'alerte si besoin -->
<?php if (isset($_GET["success"]) && verify_html($_GET["success"])>0):?>
            <?php if ($_GET["success"]==1):?>
            <p class= "alert alert-success">Utiliser votre nouveau mot de passe pour vous connecter !</p>
            <?php elseif ($_GET["success"]==2):?>
            <p class= "alert alert-success">Votre compte à été créer avec succès !</p>
            <?php endif?>
        
<?php elseif (isset($_GET["error"]) && verify_html($_GET["error"])==1):?>
    
    <p class= "alert alert-danger">Mot de passe incorrect</p>
        
<?php endif?>

<?php include 'login.php';?>
</div>

<!-- page formulaire et traitement-->
<?php 
include 'includes/footer.php';
?>




