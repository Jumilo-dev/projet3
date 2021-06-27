<?php

include 'includes/header.php';
//*include 'includes/navbar.php';
include 'includes/connect_bdd.php';
?>


<div class="container">
<?php if (isset($_GET["success"]) && verify_html($_GET["success"])==1):?>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 alert alert-success text-center p-1 ">
        Utiliser votre nouveau mot de passe pour vous connecter !
        </div>
    </div>
<?php endif?>    
        <?php include 'login.php';?>
</div>


<?php 
include 'includes/footer.php';
?>




