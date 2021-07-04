<?php 
$title ="Mot de passe oublié";
include "includes/header.php";
include 'includes/connect_bdd.php';
$error=null;
$success=null;
//*La page affiche un premier formulaire pour demander l username
//*On vérifie la bonne soumission du formulaire
if(isset($_POST['username'])&& !empty($_POST['username'])){
    $username =verify_html($_POST["username"]);

    $infos= $db->prepare('SELECT * FROM users WHERE username =?');
    $infos->execute(array($username));
    //*si l'username est trouvé dans la bdd on récupère les infos utiles
    if($infos->rowCount()>0){
        $success=1;
        $userinfo=$infos->fetch();
        $id_quest=$userinfo['question'];
        $inforeponse=$userinfo['reponse'];
        $info_user=$userinfo['username'];
        $id_user=$userinfo['id_user'];
        
        //* On recherche dans la bdd la question secrète
        $infoquest=$db->prepare('SELECT question FROM questions WHERE id_question =? ');
        $infoquest->execute(array($id_quest));
        $question=$infoquest->fetch();
        $question = $question['question'];

    }else{
        //*sinon on envoi une erreur
        $error=1;
    }
    //
}
?>

<hr>
<!-- Etat de la page si le formulaire n'est pas rempli-->    
<?php if ($success==0):?> 
        <!-- barre d'alerte si erreur sur le formulaire 1-->   
        <?php if($error==1):?>
            
                    <p class="alert alert-danger">Nom d'utilisateur inconnu</p>
                    
        <?php endif?>
        <!-- formulaire 1 pour verification username--> 
        <article class="reinit">
            <form method="POST">
                <h1 >Réinitialiser mon mot de passe</h1>
                <input type="text" name="username" placeholder= "Nom d'utilisateur" required>
                <button type="submit">Valider</button>
            </form>    
        </article>
   

<!-- affichage du second formulaire si l'username est dans la bdd -->    
<?php elseif($success==1):?>
    <article class="reinit">
        <form  action="new_pass.php" method="POST">
            <h2 >Merci <?= $info_user; ?>,</br><?= $question; ?>
            <input type="hidden" name="id_user" value="<?=$id_user;?>"  required> 
            <input type="text" name="reponse"  placeholder= "Réponse" required>    
            <button type="submit" >Valider</button>
        </form>       
    </article>    
<?php endif?>

<!-- Alerte réponse second formulaire incorrect renvoi au formulaire 1-->
<?php if (isset($_GET["error"]) && verify_html($_GET["error"])==1):?>
    
        <p class="alert alert-danger"> Nom d'utilisateur ou réponse incorrecte !<p>
        
<?php endif?> 

<?php 
include 'includes/footer.php';
?>





    
    