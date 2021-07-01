<?php
$title ="Profil";
include 'includes/header.php';
include 'includes/connect_bdd.php';
if(!isset($_SESSION["utilisateur"])){
    header ("Location: index.php");
}

?>
<!-- on affiche les messages d'alerte si formulaire traités-->
<?php if (isset($_GET["success"]) && verify_html($_GET["success"])>0):?>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 alert alert-success text-center p-1 ">
            <?php if ($_GET["success"]==1):?>
            Votre profil a bien été modifié.
            <?php elseif ($_GET["success"]==2):?>
            Mot de passe modifié.
            <?php endif?>
        </div>    
    </div>
<?php elseif (isset($_GET["error"]) && verify_html($_GET["error"])>0):?>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 alert alert-danger text-center p-1 ">
            <?php if ($_GET["error"]==1):?>
            Mot de passe incorrect
            <?php elseif ($_GET["error"]==2):?>
            Nom d'utilisateur ou mot de passe incorrect.
            <?php endif?>
        </div>
    </div>
<?php endif?>
       

<div class="container">
    <div class ="row row-cols-2 justify-content-center ">
        <form action="traitement.php" method="post" class = "col-sm-12 col-md-5 border border-danger border-3 m-4  ">
            <fieldset>
                <legend><h2 class= " text-center">Modifier mon profil</h2></legend>
                <div class="form-group ">
                    <label  class="control-label" for="name">Nom </label> 
                    <input type="text" name="name" class="form-control" value="<?php echo $_SESSION ["utilisateur"]["nom"];?>" id="name"  required>
                </div>
                <div class="form-group">
                    <label  class="control-label" for="firstname">Prénom </label> 
                    <input type="text" name="firstname" class="form-control" value="<?php echo $_SESSION ["utilisateur"]["prenom"]?>" id="firstname" required>
                </div>
                <div class="form-group">
                    <label  class="control-label" for="password">Mot de passe </label> 
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="text-center p-3">
                <button class="btn btn-danger" type="submit">Modifier mon profil</button>
                </div>    
            </fieldset>
        </form>
        
        <form action="traitement2.php" method="post" class = "col-sm-12 col-md-5 border border-danger border-3 m-4 ">
            <fieldset>
                <legend><h2 class= " text-center">Modifier mon mot de passe</h2></legend>
                <div class="form-group">
                    <label  class="control-label" for="username">Nom d'utilisateur</label> 
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="form-group">
                    <label  class="control-label" for="pass">Mot de passe </label> 
                    <input type="password" name="password" class="form-control" id="pass" required >
                </div>
                <div class="form-group">
                    <label  class="control-label" for="newpass">Nouveau Mot de passe </label> 
                    <input type="password" name="newpass" class="form-control" id="newpass" required >
                </div>
                <div class="text-center p-3">
                <button class="btn btn-danger" type="submit">Modifier mon mot de passe</button>
                </div >
            </fieldset>
        </form>
    </div >
</div >       



<?php include 'includes/footer.php';?>