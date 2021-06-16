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
        
        var_dump($info_user);

        if(!$info_user){
            header ("Location: index.php");
        }
        
        /*Traitement enregistrement nouveau mot de pass 
        if (isset($_POST[""],$_POST["reponse"])
        && !empty($_POST["id_user"]) && !empty($_POST["reponse"]))
        $newpass= password_hash($_POST["newpass"],PASSWORD_DEFAULT);
        $username= strip_tags($_POST["username"]);

        $update_mdp= $db->prepare("UPDATE users SET `password`=? WHERE username=? LIMIT 1");
        $update_mdp->execute(array($newpass,$username));
        $count = $update_mdp->rowCount();
                print('Mise à jour de ' .$count. ' entrée(s)');
        echo "Modifier votre mot de passe";
        
    }*/
    
}
?>

<body>
    <p>Création nouveau mot de passe</p>
    <form  method="POST" >
    <div class="form-group">
        <label class=" control-label" for="newpass">Mot de passe </label> 
        <input type="text" name="newpass" class= "form-control" required>
    </div>
</body>
 