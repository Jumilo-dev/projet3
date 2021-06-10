<?php

if (!isset($_SESSION["utilisateur"])){

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
       /* if ($_POST["password"]!== $utilisateur["password"]){
            die ($utilisateur["password"]);
        }*/

        //*à utiliser lorsque le mot de passe est hasher 
        if(!password_verify($_POST["password"],$utilisateur["password"])){
            die("L'utilisateur ou le mot de passe est incorrect");
        }
       //*session_start();
       $_SESSION["utilisateur"]=[
           "id_user"=>$utilisateur["id_user"],
           "nom"=>$utilisateur["nom"],
           "prenom"=>$utilisateur["prenom"],
           "username"=>$utilisateur["username"]


       ];
      
       header("Location: principal.php");
    
    }else{
    die ("Le formulaire est incomplet");
    }
}
}else{
  header ("Location: principal.php");  
}
$title ="Accueil";
?>

<body class="text-center">
    <main class="form-signin">
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

    

    <button class="mx-auto btn btn-danger" type="submit">Se Connecter</button>
    

    <a  class="mx-auto text-muted" href ="reinit_pass.php">Mot de passe oublié</a>
    <a class="mt-5 mb-3 text-muted" href ="inscription.php">Nouvel utilisateur</a>
    </form>
    
    </main>
</body>
<?php 