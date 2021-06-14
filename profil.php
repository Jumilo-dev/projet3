<?php
include 'includes/header.php';
include 'includes/connect_bdd.php';
?>


<?php
 if(isset($_SESSION["utilisateur"])){
    if (!empty($_POST)){
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
                $id_user=$_SESSION["utilisateur"]["id"];
                $name= strip_tags($_POST["name"]);
                $firstname= strip_tags($_POST["firstname"]);
                
               
                $sql = "UPDATE `users` SET `nom`=`:name`,`prenom`=`:firstname`  WHERE `id_user`=`$id_user` LIMIT 1";
                $query = $db->prepare($sql);
                $query->bindValue(":name", $name, PDO::PARAM_STR);
                $query->bindValue(":firstname", $firstname, PDO::PARAM_STR);
                $query->execute();

                $_SESSION["utilisateur"]["nom"]=$name;
                $_SESSION["utilisateur"]["prenom"]=$firstname;
                header ("Location: profil.php");
                
                
                
            }
        }else{ echo "Formulaire incomplet";
        }
    }


            


}else{
    header ("Location: index.php");
}
/*if (isset($_GET["id_user"]))
{
  $getid = ($_GET["id_user"]);
  
$sql = "SELECT * FROM `users` WHERE `id_user`= ? ";
$query = $db->prepare($sql);
$query->execute(array($getid));
$profil = $query->fetch();

    if (!empty($_POST)){

        if(!password_verify($_POST["password"],$profil["password"])){
        die ("Mot de passe incorrect");
        }
            echo "Mot de passe correct";
        
    }
}

?>

    <?php
/*
if (!isset($_SESSION["utilisateur"])){

if (!empty($_POST)){
    
    if (isset($_POST["name"],$_POST["firstname"]$_POST["password"])
    && !empty($_POST["name"]) && !empty($_POST["firstname"]) && !empty($_POST["password"]))
    {
        
        $sql = "SELECT * FROM `users` WHERE `id_user`= ($profil["id_user"])";
        $query = $db->prepare($sql);
        $query->bindValue(":username" , $_POST["username"],PDO::PARAM_STR);
        $query->execute();
        $utilisateur = $query->fetch();
        {
        
            $sql = "UPDATE `users` SET `nom`=`:name`,`prenom`=`:firstname`  WHERE  `id_user`= $profil["id_user"] LIMIT 1";
            $query = $db->prepare($sql);
            $query->bindValue(":nom", $name, PDO::PARAM_STR);
            $query->bindValue(":prenom", $firstname, PDO::PARAM_STR);
            $query->execute();
        

        if(!$utilisateur){
            die("");
        }
 */       
       /* if ($_POST["password"]!== $utilisateur["password"]){
            die ($utilisateur["password"]);
        }*/

        //*à utiliser lorsque le mot de passe est hasher 
 /*       if(!password_verify($_POST["password"],$utilisateur["password"])){
            die("L'utilisateur ou le mot de passe est incorrect");
        }
       //*session_start();
       /*$_SESSION["utilisateur"]=[
           "id_user"=>$utilisateur["id_user"],
           "nom"=>$utilisateur["nom"],
           "prenom"=>$utilisateur["prenom"],
           "username"=>$utilisateur["username"]*/
?>
<body>
<p>Modifier mon profil</p>
<form action="profil.php" method="post">
<div >
        <label  for="username">Nom d'utilisateur </label> 
        <input type="text" name="username" value="<?php echo $_SESSION ["utilisateur"]["username"];?>"  required>
    </div>
        
<div >
        <label  for="name">Nom </label> 
        <input type="text" name="name" value="<?php echo $_SESSION ["utilisateur"]["nom"];?>"  required>
    </div>

    <div >
        <label  for="firstname">Prénom </label> 
        <input type="text" name="firstname" value="<?php echo $_SESSION ["utilisateur"]["prenom"]?>"  required>
    </div>

    <div >
        <label  for="password">Mot de passe </label> 
        <input type="password" name="password" >
    </div>
    <button class="mx-auto btn btn-danger" type="submit">Modifier mon profil</button>

</form>
</body>

<?php include 'includes/footer.php';?>