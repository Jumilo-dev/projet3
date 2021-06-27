<?php
session_start();
include 'includes/connect_bdd.php';

if (!empty($_POST)){
    
    if (isset($_POST["username"],$_POST["password"],$_POST["newpass"])
    && !empty($_POST["username"]) && !empty($_POST["password"])  && !empty($_POST["newpass"]))
    {
    $newpass= password_hash($_POST["newpass"],PASSWORD_DEFAULT);
    $username= strip_tags($_POST["username"]);
    //*on vérifie la correspondance mdp/user
    $info_user = $db->prepare("SELECT * FROM `users` WHERE `username`= ?");
    $info_user->execute(array($username));
    $utilisateur = $info_user->fetch();

        if(!$utilisateur){
            header ("Location: profil.php?error=2");
        }

        elseif(!password_verify($_POST["password"],$utilisateur["password"])){
            header ("Location: profil.php?error=2");
        }
        elseif(password_verify($_POST["password"],$utilisateur["password"])){

        $update_mdp= $db->prepare("UPDATE users SET `password`=? WHERE username=? LIMIT 1");
        $update_mdp->execute(array($newpass,$username));
        $count = $update_mdp->rowCount();

        header ("Location: profil.php?success=2");}
                
    }else{ 
    die ("Le formulaire est incomplet");
    }

}else{
header ("Location: profil.php");  
}