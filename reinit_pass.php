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


<!-- Etat de la page si le formulaire n'est pas rempli-->    
<?php if ($success==0):?> 
        <!-- barre d'alerte si erreur sur le formulaire 1-->   
        <?php if($error==1):?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-4 alert alert-danger text-center p-1 ">
                    <p>Nom d'utilisateur inconnu</p>
                    </div>
                </div>
            </div>
        <?php endif?>
        <!-- formulaire 1 pour verification username--> 
        <div class="container"> 
            <div class="row justify-content-center ">
                <form class="col-sm-6 col-md-4 " method="POST">
                    <fieldset>
                    <legend><h1 class=" h4 text-center ">Réinitialiser mon mot de passe</h1></legend>
                    <input type="text" name="username" class= "form-control mt-5" placeholder= "Nom d'utilisateur" required>
                    <button type="submit" class="btn btn-danger m-5">Valider</button>
                    </fieldset>
                </form>
            </div>
        </div>

<!-- affichage du second formulaire si l'username est dans la bdd -->    
<?php elseif($success==1):?>
    <div class="container">
        <div class="row justify-content-center ">
            <form class="col-sm-6 col-md-4 " action="new_pass.php" method="POST">
                <fieldset>
                    <legend>
                    <h2 class= "h4 text-center ">Merci <?= $info_user; ?>,</br><?= $question; ?>
                    </legend>
                    <input type="hidden" name="id_user" value="<?=$id_user;?>" class= "form-control mt-5" required> 
                    <input type="text" name="reponse" class= "form-control mt-5" placeholder= "Réponse" required>
                </fieldset>
                <button type="submit" class="btn btn-danger m-5 ">Valider</button>
                
            </form>   
        </div>
    </div>    
<?php endif?>

<!-- Alerte réponse second formulaire incorrect renvoi au formulaire 1-->
<?php if (isset($_GET["error"]) && verify_html($_GET["error"])==1):?>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 alert alert-danger text-center p-1 ">
        Nom d'utilisateur ou réponse incorrecte !
        </div>
    </div>
<?php endif?> 

<?php 
include 'includes/footer.php';
?>





    
    