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
        <?php if ($_GET["success"]==1):?>
            <p class= "alert alert-success">Votre profil a bien été modifié.</p>
        <?php elseif ($_GET["success"]==2):?>
            <p class= "alert alert-success">Mot de passe modifié.</p>
        <?php endif?>
        
<?php elseif (isset($_GET["error"]) && verify_html($_GET["error"])>0):?>
        <?php if ($_GET["error"]==1):?>
            <p class= "alert alert-danger">Mot de passe incorrect</p>
        <?php elseif ($_GET["error"]==2):?>
            <p class= "alert alert-danger">Nom d'utilisateur ou mot de passe incorrect.</p>
        <?php endif?>
<?php endif?>
       

<h1 id="titre"> Mon compte utilisateur</h1>
<section class="profil">
    <article class="modif">
        <form action="traitement.php" method="post" class = "col-sm-12 col-md-5 border border-danger border-3 m-4  ">
            <fieldset>
                <legend>Modifier mon profil</legend>
                <label for="name">Nom </label> 
                <input type="text" name="name" value="<?php echo $_SESSION ["utilisateur"]["nom"];?>" id="name"  required>
                <label for="firstname">Prénom </label> 
                <input type="text" name="firstname" value="<?php echo $_SESSION ["utilisateur"]["prenom"]?>" id="firstname" required>       
                <label for="password">Mot de passe </label> 
                <input type="password" name="password"  id="password">
                <button  type="submit">Modifier mon profil</button>  
            </fieldset>
        </form>
    </article>
    <article class="modif">   
        <form action="traitement2.php" method="post">
            <fieldset>
                <legend>Modifier mon mot de passe</legend>
                <label  class="control-label" for="username">Nom d'utilisateur</label> 
                <input type="text" name="username" class="form-control" id="username" required>
                <label  class="control-label" for="pass">Mot de passe </label> 
                <input type="password" name="password" class="form-control" id="pass" required >
                <label  class="control-label" for="newpass">Nouveau Mot de passe </label> 
                <input type="password" name="newpass" class="form-control" id="newpass" required >
                <button class="btn btn-danger" type="submit">Modifier mon mot de passe</button>
            </fieldset>
        </form>
    </article>      
</section>
<?php include 'includes/footer.php';?>