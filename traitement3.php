<?php 
include 'includes/connect_bdd.php';
if (isset($_POST["newpass"],$_POST["id"]) 
        && !empty($_POST["newpass"]) && !empty($_POST["id"])){

        $newpass= password_hash($_POST["newpass"],PASSWORD_DEFAULT);
        $id=($_POST["id"]);
        var_dump($id);

        $update_mdp= $db->prepare("UPDATE users SET `password`=? WHERE `id_user`= ? LIMIT 1");
        $update_mdp->execute(array($newpass,$id));
        $count = $update_mdp->rowCount();
        print('Mise à jour de ' .$count. ' entrée(s)');
        echo "Mot de passe modifier avec succès";
        }
        