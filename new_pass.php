<?php
include 'includes/connect_bdd.php';
include "includes/header.php"; 

 
//*vérification soumission du formulaire
 if (!empty($_POST)){
    //*Verification des 2 champs
    if (isset($_POST["id_user"],$_POST["reponse"])
    && !empty($_POST["id_user"]) && !empty($_POST["reponse"]))
    {
        //*Verification concordance entre l'utilisateur et sa réponse
        $id_user=verify_html($_POST["id_user"]);
        $inforep =verify_html($_POST["reponse"]);
        $user= $db->prepare ("SELECT * FROM `users` WHERE `id_user`= ? AND`reponse`=?");
        $user->execute(array($id_user,$inforep));
        $info_user=$user->fetch();
        $id=$info_user['id_user'];
        
        
        //* si pas de concordance on renvoi à la demande d'username avec une erreur
        if(!$info_user){
            header ("Location: reinit_pass.php?error=1");
        }
    }
}else{
    header ("Location: reinit_pass.php");
}

?>
<!--formulaire nouveau mot de passe-->
<article class="reinit">
    <form method="POST" >
            <h1> Choisissez votre nouveau mot de passe</h1>
            <input type="hidden" name="id"  value="<?=$id?>">
            <input type="password" name="newpass"   required>       
            <button type="submit">Valider</button>     
    </form>   
</article>

<?php
if (!empty($_POST)){
    //*si les champs du second formulaire sont complets on remplace le mdp de la bdd
    if (isset($_POST["newpass"],$_POST["id"]) 
    && !empty($_POST["newpass"]) && !empty($_POST["id"])){

        $newpass= password_hash($_POST["newpass"],PASSWORD_DEFAULT);
        $id=verify_html($_POST["id"]);
        $update_mdp= $db->prepare("UPDATE users SET `password`=? WHERE `id_user`= ? LIMIT 1");
        $update_mdp->execute(array($newpass,$id));
        $count = $update_mdp->rowCount();
        header ("Location: index.php?success=1");
    }
}else{
    header ("Location: reinit_pass.php");
}
?>

<?php 
include 'includes/footer.php';
?>
 
    

 