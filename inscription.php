
<?php
$title ="Inscription";
include "includes/header.php"; 
include 'includes/connect_bdd.php';

//*Vérifier que le formulaire est envoyé, et que les champs sont completés
if(!empty($_POST)){

	if(isset($_POST["name"],$_POST["firstname"],$_POST["username"],$_POST["password"],$_POST["question"],$_POST["reponse"])
		&& !empty($_POST["name"]) && !empty ($_POST["firstname"])&& !empty ($_POST["username"])&& !empty ($_POST["password"])&& !empty ($_POST["question"])&& !empty ($_POST["reponse"])
	){ //*Le formulaire est complet. Recupérer et protéger les données, faire les contrôles
        $username= verify_html($_POST["username"]);
        //*verifier que l'username est unique
        $verif_user=$db->prepare("SELECT * FROM users WHERE username=?");
        $verif_user->execute(array($username));
        $resultat=$verif_user->fetch();
       
        //*si username unique on continue le traitement
        if(!$resultat){
            $name= verify_html($_POST["name"]);
            $firstname= verify_html($_POST["firstname"]);
            //*hasher le mot de passe 
            $password= password_hash($_POST["password"],PASSWORD_DEFAULT);
            $question= verify_html($_POST["question"]);
            $reponse= verify_html($_POST["reponse"]);
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
            //* si l'username est déja utilisé
            header ("Location: inscription.php?error=1");
        }
             
    }else{
        //*message d'erreur si le formulaire est incomplet 
        die("Le formulaire est incomplet");
    }  
}
?>
<!-- affichage alerte si username déjà utilisé -->
<?php if (isset($_GET["error"]) && verify_html($_GET["error"])==1):?>
   
    Merci de choisir un autre nom d'utilisateur
    

<?php endif ?>
<!--formulaire de création de compte -->
<form class="new_user" method="POST" >
    <h1 >Inscription</h1>        
    <label  for="name">Nom </label> 
    <input type="text" name="name" id="name" required>
    <label  for="firstname">Prénom </label> 
    <input type="text" name="firstname"  id="firstname" required>
    <label  for="username">Nom d'utilisateur </label> 
    <input type="text" name="username"  id="username" required>
    <label for="password">Mot de passe </label> 
    <input type="text" name="password"  id="password" required>
    <label  for="question">Question secrète </label>
    <select name="question"  id="question" placeholder="Sélectionner votre question">
        <option value="">Sélectionner votre question</option>
        <?php
            //* Insérer les questions de la bdd et renvoyer leur id
        $question=$db->query('SELECT * FROM questions');
        while ($choice = $question->fetch())
        {
        ?>
        <option value="<?php echo $choice ['id_question'];?>"><?php echo $choice ['question'];?></option>
        <?php
        }
        ?>
    </select>
    <label  for="reponse">Votre réponse </label> 
    <input type="text" name="reponse"  id="reponse" required>
    <button type="submit">S'inscrire</button>
    
</form>








<?php include 'includes/footer.php';?>
