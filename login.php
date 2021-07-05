<?php
//*On vérifie qu'il n'y a pas de session ouverte
if (!isset($_SESSION["utilisateur"])){
    //*On vérifie que le formulaire est soumis
    if (!empty($_POST)){
        //*et qu'il est complet
        if (isset($_POST["username"],$_POST["password"])
        && !empty($_POST["username"]) && !empty($_POST["password"]))
        {
            //*On récupère les infos liés à l'username dans la bdd
            $sql = "SELECT * FROM `users` WHERE `username`= :username";
            $query = $db->prepare($sql);
            $query->bindValue(":username" , $_POST["username"],PDO::PARAM_STR);
            $query->execute();
            $utilisateur = $query->fetch();
            //*si l'utilisateur n'existe pas
            if(!$utilisateur){
                header ("Location: index.php?error=1");
            }
            //on verifie la correspondance mdp avec bdd
            if(!password_verify($_POST["password"],$utilisateur["password"])){
                header ("Location: index.php?error=1");
            }else{
            //on démarre la session
            $_SESSION["utilisateur"]=[
                "id"=>$utilisateur["id_user"],
                "nom"=>$utilisateur["nom"],
                "prenom"=>$utilisateur["prenom"],
                "username"=>$utilisateur["username"]
            ];
            header("Location: principal.php");
            }
        }else{
        die ("Le formulaire est incomplet");
        }
    }
}

?>
<!--formulaire de connexion a afficher sur la page d'accueil -->
<form action="index.php" method="post" class="connex" >
    <h1>Connexion</h1>
    <label for="username" >Nom d'utilisateur</label>
    <input type="text" name="username" id = "username"   required>
    <label for="password"> Mot de passe</label>
    <input type="password" name="password" id= "password" required>
    <button  type="submit">Se Connecter</button>    
    <hr>
    <a href ="reinit_pass.php">Mot de passe oublié</a>
    <a href ="inscription.php">Nouvel utilisateur</a>   
</form>    


<?php 