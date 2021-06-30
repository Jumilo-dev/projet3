<?php
session_start();
include 'includes/connect_bdd.php';
include_once "includes/functions.php";

if(isset($_SESSION["utilisateur"])){
    if (!empty($_POST)){
        if (isset($_POST["username"],$_POST["password"],$_POST["newpass"])
        && !empty($_POST["username"]) && !empty($_POST["password"])  && !empty($_POST["newpass"]))
        {
        $newpass= password_hash($_POST["newpass"],PASSWORD_DEFAULT);
        $username= verify_html($_POST["username"]);
        //*on vérifie la présence de l'username dans la bdd
        $info_user = $db->prepare("SELECT * FROM `users` WHERE `username`= ?");
        $info_user->execute(array($username));
        $utilisateur = $info_user->fetch();
            //*si non reconnu
            if(!$utilisateur){
                header ("Location: profil.php?error=2");
                //*on vérifie le mdp si non reconnu
            }
            if(password_verify($_POST["password"],$utilisateur["password"])){
                $update_mdp= $db->prepare("UPDATE users SET `password`=? WHERE username=? LIMIT 1");
                $update_mdp->execute(array($newpass,$username));
                $count = $update_mdp->rowCount();
                header ("Location: profil.php?success=2");
            }else{
                header ("Location: profil.php?error=2");
            }    
            /*}{(!password_verify($_POST["password"],$utilisateur["password"])){
                //*si reconnu on met à jour la bdd avec le nouveau
            }elseif*/      
        }else{ 
        die ("Le formulaire est incomplet");
        }
    }     
}else{
    header ("Location: index.php");
}