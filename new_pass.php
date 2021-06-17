<?php
include 'includes/connect_bdd.php';
include "includes/header.php"; 
$title ="Mot de passe oublié";
 

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
        
        var_dump($id);

        if(!$info_user){
            header ("Location: index.php");
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

<body>
    <p>Création nouveau mot de passe</p>
    <form action ="traitement3.php" method="POST" >
    <input type="hidden" name="id"  value="<?=$id?>" required>
        <label for="newpass">Choisissez votre nouveau mot de passe </label> 
        <input type="text" name="newpass"  required>
        <button type="submit">Valider</button>
 
    </form>
</body>
 