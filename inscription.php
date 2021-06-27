
<?php
include 'includes/connect_bdd.php';
include "includes/header.php"; 
$title ="Inscription";
$erreur=null;
$success=null;
$username=null;
//*Vérifier que le formulaire est envoyé, et que les champs sont completés
if(!empty($_POST)){

	if(isset($_POST["name"],$_POST["firstname"],$_POST["username"],$_POST["password"],$_POST["question"],$_POST["reponse"])
		&& !empty($_POST["name"]) && !empty ($_POST["firstname"])&& !empty ($_POST["username"])&& !empty ($_POST["password"])&& !empty ($_POST["question"])&& !empty ($_POST["reponse"])
	){ //*Le formulaire est complet. Recupérer et protéger les données, faire les contrôles
        $username= strip_tags($_POST["username"]);
        //*verifier que l'username est unique
        $verif_user=$db->prepare("SELECT * FROM users WHERE username=?");
        $verif_user->execute(array($username));
        $resultat=$verif_user->fetch();
       
    
        if(!$resultat){
            $name= verify_html($_POST["name"]);
            $firstname= strip_tags($_POST["firstname"]);
           
            //*hasher le mot de passe 
            $password= password_hash($_POST["password"],PASSWORD_DEFAULT);
            
            $question= strip_tags($_POST["question"]);
            $reponse= strip_tags($_POST["reponse"]);
        
            
                //*Requete
                $sql= "INSERT INTO `users`(`nom`,`prenom`,`username`,`password`,`question`,`reponse`) VALUES (:nom, :prenom, :username, '$password',:question, :reponse)";
                //*Requete preparée
                $query = $db->prepare($sql);
                $query->bindValue(":nom", $name, PDO::PARAM_STR);
    
                $query->bindValue(":prenom", $firstname, PDO::PARAM_STR);
                $query->bindValue(":username", $username, PDO::PARAM_STR);
                $query->bindValue(":question", $question, PDO::PARAM_STR);
                $query->bindValue(":reponse", $reponse, PDO::PARAM_STR);
    
                $query->execute();
                
                header ("Location: index.php?success=2");
            }else{
                
            header ("Location: inscription.php?error=1");
            
            
        
        }

       
    
//*message d'erreur si le formulaire est incomplet (à compléter plus tard pour indiquer quel champ est incomplet)
    }else
    {die("Le formulaire est incomplet");}
}



?>



<body>
<?php if (isset($_GET["error"]) && verify_html($_GET["error"])==1):?>
    <div class="alert alert-danger">
    Merci de choisir un autre nom d'utilisateur
    </div>
<?php elseif ($success):?>
    <div class="alert alert-success"></div>
    <?= $success ?>
    </div>
<?php endif ?>
<!--formulaire de création de compte -->

<div class="container">
 <div class="row justify-content-center">
<form  class= "col-sm-12 col-md-6 " method="POST" >
<fieldset>
    <legend><h1 class="text-center">Inscription</h1></legend>


    <div class="form-group">
        <label class=" control-label" for="name">Nom </label> 
        <input type="text" name="name" class= "form-control" required>
    </div>

    <div class="form-group">
        <label class=" control-label" for="firstname">Prénom </label> 
        <input type="text" name="firstname" class= "form-control" required>
    </div>
        

    <div class="form-group">
        <label class=" control-label" for="username">Nom d'utilisateur </label> 
        <input type="text" name="username" class= "form-control" required>
    </div>
        

    <div class="form-group">
        <label class=" control-label" for="password">Mot de passe </label> 
        <input type="password" name="password" class= "form-control" required>
    </div>
        
    <div class="form-group">
        <label class=" control-label" for="question">Question secrète </label>
        <select name="question" class="form-control selectpicker">
        <option value="">Sélectionner votre question</option>

            <?php
            $requête=$db->query('SELECT * FROM questions');


            while ($choice = $requête->fetch())
            {
             ?>
            <option value="<?php echo $choice ['id_question'];?>"><?php echo $choice ['question'];?></option>
            <?php
            }
            ?>
        </select>
    </div>
        

    <div class="form-group">
        <label class=" control-label" for="reponse">Votre réponse </label> 
        <input type="text" name="reponse" class= "form-control" required>
    </div>
    
    <div class="row justify-content-center">
        <button type="submit" class=" col-sm-12 col-md-6 btn btn-danger m-4" >S'inscrire</button>  
    </div>


</fieldset>
</form>

</div>
</body>
<?php include 'includes/footer.php';?>
