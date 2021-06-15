<?php
session_start();
include 'includes/connect_bdd.php';

if (!empty($_POST)){
    
    if (isset($_POST["username"],$_POST["password"])
    && !empty($_POST["username"]) && !empty($_POST["password"]))
    {
        
        $sql = "SELECT * FROM `users` WHERE `username`= :username";
        $query = $db->prepare($sql);
        $query->bindValue(":username" , $_POST["username"],PDO::PARAM_STR);
        $query->execute();
        $utilisateur = $query->fetch();

        if(!$utilisateur){
            die("L'utilisateur ou le mot de passe n'existe pas");
        }
       
        if(!password_verify($_POST["password"],$utilisateur["password"])){
            die("L'utilisateur ou le mot de passe est incorrect");
        }
        $newpass= password_hash($_POST["newpass"],PASSWORD_DEFAULT);
        $username= strip_tags($_POST["username"]);

        $update_mdp= $db->prepare("UPDATE users SET `password`=? WHERE username=? LIMIT 1");
        $update_mdp->execute(array($newpass,$username));
        $count = $update_mdp->rowCount();
                print('Mise à jour de ' .$count. ' entrée(s)');
    }else{ 
    die ("Le formulaire est incomplet");
    }

}else{
header ("Location: profil.php");  
}