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

<section class="text-center">
    <div class="form-signin">
        <!--formulaire de connexion a afficher sur la page d'accueil -->
        <form action="index.php" method="post">
        <h1 class="h1 mb-3 pt-4 fw-normal">Connexion</h1>
            <div class="form-floating mb-3">
                <input type="text" name="username" id = "username" class= "form-control " required>
                <label for="username" >Nom d'utilisateur</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" id= "password" class="form-control" required>
                <label for="password" class="form-label">mot de passe</label>
            </div>
            <div class="row row-cols-3 justify-content-center">
                <div class="col-4">
                    <button class="p-2 btn btn-danger" type="submit">Se Connecter</button>
                </div> 
            </div>
        </form>
        <div class="row row-cols-3 justify-content-center">
            <div class="col-3">
                <a  class="text-muted" href ="reinit_pass.php">Mot de passe oublié</a>
            </div>
            <div class="col-3">
                <a class="text-muted" href ="inscription.php">Nouvel utilisateur</a>
            </div>
        </div>
    </div>
</section>
<?php 