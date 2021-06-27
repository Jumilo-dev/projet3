<?php
include 'includes/connect_bdd.php';
include "includes/header.php"; 
$title ="Mot de passe oublié";
$error=null;
 

 if (!empty($_POST)){
    
    if (isset($_POST["id_user"],$_POST["reponse"])
    && !empty($_POST["id_user"]) && !empty($_POST["reponse"]))
    {
        $id_user=$_POST["id_user"];
        $inforep =$_POST["reponse"];
        

        $user= $db->prepare ("SELECT * FROM `users` WHERE `id_user`= ? AND`reponse`=?");
        $user->execute(array($id_user,$inforep));
        $info_user=$user->fetch();
        $id=$info_user['id_user'];
        
        

        if(!$info_user){
            header ("Location: reinit_pass.php?error=1.php");
        }
        
         
        /*if (isset($_POST["newpass"],$_POST["id"]) 
        && !empty($_POST["newpass"]) && !empty($_POST["id"])){

        $newpass= password_hash($_POST["newpass"],PASSWORD_DEFAULT);
        $id=($_POST["id"]);
        

        $update_mdp= $db->prepare("UPDATE users SET `password`=? WHERE `id_user`= ? LIMIT 1");
        $update_mdp->execute(array($newpass,$id));
        $count = $update_mdp->rowCount();
        print('Mise à jour de ' .$count. ' entrée(s)');
        echo "Mot de passe modifier avec succès";
        
        }*/
    }
}
?>


<div class="container">
    <div class="row justify-content-center ">
        <form class="col-sm-8 col-md-6 col-lg-8 " action ="traitement3.php" method="POST" >
            <fieldset>
            <legend><h1 class="h4 text-center  ">Choisissez votre nouveau mot de passe</legend>
            <input type="hidden" name="id"  value="<?=$id?>" required>
            <input type="password" name="newpass" class= "form-control mt-5"  required>
            <button type="submit"class="btn btn-danger m-5 p-2">Valider</button>
            </fieldset>
        </form>   
    </div>
</div>

<?php 
include 'includes/footer.php';
?>
 
    

 