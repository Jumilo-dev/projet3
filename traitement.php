<?php
session_start();
include 'includes/connect_bdd.php';


//*on vérifie que l'utilisateur est connecté et on récupère les infos de l'utilisateur dans la base de données
if(isset($_SESSION["utilisateur"])){
    $sql = "SELECT * FROM `users` WHERE `username`= :username";
    $query = $db->prepare($sql);
    $query->bindValue(":username" , $_SESSION["utilisateur"]["username"],PDO::PARAM_STR);
    $query->execute();
    $utilisateur = $query->fetch();
    //on vérifie s'un formulaire complet est soumis
    if (!empty($_POST)){
        if (isset($_POST["password"],$_POST["name"],$_POST["firstname"])
        && !empty($_POST["password"]) && !empty($_POST["name"]) && !empty($_POST["firstname"]))
        {
            //*On vérifie le mdp si incorrect page rechargée avec message d'erreur    
            if(!password_verify($_POST["password"],$utilisateur["password"])){
                header ("Location: profil.php?error=1");
            }else{
                 //* mdp correct alors modification bdd et session
                $id_user=$_SESSION["utilisateur"]["id"];
                $new_name= verify_html($_POST["name"]);
                $new_firstname= verify_html($_POST["firstname"]);
                $modifprofil = $db->prepare("UPDATE users SET nom=?,prenom=?  WHERE id_user= ? LIMIT 1");
                $modifprofil->execute(array($new_name, $new_firstname,$id_user));

                $_SESSION["utilisateur"]["nom"]=$new_name;
                $_SESSION["utilisateur"]["prenom"]=$new_firstname;
                //* recharge la page avec un message de succès
                header ("Location: profil.php?success=1");    
            }
        }
    }
}else{
    header ("Location: index.php");
}
?>
