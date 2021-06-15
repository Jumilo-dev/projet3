<?php
session_start();
include 'includes/connect_bdd.php';

//*on vérifie que l'utilisateur est connecté
if(isset($_SESSION["utilisateur"])){
    if (!empty($_POST)){
        //*on vérifie le mot de passe
        if (isset($_POST["password"])
        && !empty($_POST["password"]))
        {
        $sql = "SELECT * FROM `users` WHERE `username`= :username";
        $query = $db->prepare($sql);
        $query->bindValue(":username" , $_SESSION["utilisateur"]["username"],PDO::PARAM_STR);
        $query->execute();
        $utilisateur = $query->fetch();
    
            if(!password_verify($_POST["password"],$utilisateur["password"])){
            die ("Incorrect");
            }else{
                 //* mot de passe correct alors modification bdd et session
                $id_user=$_SESSION["utilisateur"]["id"];
                $new_name= strip_tags($_POST["name"]);
                $new_firstname= strip_tags($_POST["firstname"]);
                
                
                
                $modifprofil = $db->prepare("UPDATE users SET nom=?,prenom=?  WHERE id_user= ? LIMIT 1");
                $modifprofil->execute(array($new_name, $new_firstname,$id_user));

                $_SESSION["utilisateur"]["nom"]=$new_name;
                $_SESSION["utilisateur"]["prenom"]=$new_firstname;
                
                
            }
        }else{ echo "Formulaire incomplet";
        }
    }
}?>
