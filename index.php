<?php
include 'includes/header.php';
//*include 'includes/navbar.php';
include 'includes/connect_bdd.php';
?>


<div class="container">
<!--on affiche les messages d'alerte si besoin -->
<?php if (isset($_GET["success"]) && verify_html($_GET["success"])>0):?>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 alert alert-success text-center p-1 ">
            <?php if ($_GET["success"]==1):?>
            Utiliser votre nouveau mot de passe pour vous connecter !
            <?php elseif ($_GET["success"]==2):?>
            Votre compte à été créer avec succès !
            <?php endif?>
        </div>    
    </div>
<?php elseif (isset($_GET["error"]) && verify_html($_GET["error"])==1):?>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 alert alert-danger text-center p-1 ">
            Mot de passe incorrect
        </div>
    </div>
<?php endif?>

<?php include 'login.php';?>
</div>

<!-- page formulaire et traitement-->
<?php 
include 'includes/footer.php';
?>




