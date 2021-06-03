<?php

include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/connect_bdd.php';
<<<<<<< HEAD
if (!isset($_SESSION["utilisteur"])){

if (!empty($_POST)){
    if (isset($_POST["username"],$_POST["password"])
    && !empty($_POST["username"]) && !empty($_POST["password"]))
    {
        $username= strip_tags($_POST["username"]);
        $sql = "SELECT * FROM `users` WHERE `username`= :username";
        
        $query = $db->prepare($sql);
        $query->bindValue(":username" , $username,PDO::PARAM_STR);
        $query->execute();
        $utilisateur = $query->fetch();

        if(!$utilisateur){
            die("L'utilisateur ou le mot de passe n'existe pas");
        }
        /*if ($_POST["password"]!== $utilisateur["password"]){
            die ("L'utilisateur ou le mot de passe est incorrect");
        }*/

        //* à utiliser lorsque le mot de passe est hasher 
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
=======

>>>>>>> partenaires
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php if (isset($title)){echo $title;} else {echo 'GBAF';} ?></title>
    
</head>
<body>
<?php include 'login.php';?>
</body>
<<<<<<< HEAD
<?php 
include 'includes/footer.php';
?>

=======
</html>
>>>>>>> partenaires


