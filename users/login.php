<?php

if (!isset($_SESSION["utilisteur"])){

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

        à utiliser lorsque le mot de passe est hasher 
        if(!password_verify($_POST["password"],$utilisateur["password"])){
            die("L'utilisateur ou le mot de passe est incorrect");
        }
       //*session_start();
       $_SESSION["utilisateur"]=[
           "id"=>$utilisateur["id_user"],
           "nom"=>$utilisateur["nom"],
           "prenom"=>$utilisateur["prenom"]

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

<body>
<h1>Se connecter</h1>
<!--formulaire de connexion a afficher sur la page d'accueil -->
<form action="index.php" method="post">
<div>
<label for="username">Nom d'utilisateur</label>
<input type="text" name="username" required>
</div>
<div>
<label for="password">mot de passe</label>
<input type="password" name="password" required>
</div>
<div>
<a href ="reinit_pass.php">Mot de passe oublié</a>
</div>
<div>
<button type="submit">Se Connecter</button>
</form>
</div>
<div>
<a href ="inscription.php">Nouvel utilisateur</a>
</div>


</body>
<?php 