<?php 
include 'includes/connect_bdd.php';
include "includes/header.php"; 
$title ="Mot de passe oublié";
$error=null;
$success=null;

if(isset($_POST['username'])&& !empty($_POST['username'])){
    $username =strip_tags($_POST["username"]);

    $infos= $db->prepare('SELECT * FROM users WHERE username =?');
    $infos->execute(array($username));

    if($infos->rowCount()>0){
        $success=1;
        $userinfo=$infos->fetch();
        $id_quest=$userinfo['question'];
        $inforeponse=$userinfo['reponse'];
        $info_user=$userinfo['username'];
        $id_user=$userinfo['id_user'];
        
        
        $infoquest=$db->prepare('SELECT question FROM questions WHERE id_question =? ');
        $infoquest->execute(array($id_quest));
        $question=$infoquest->fetch();
        $question = $question['question'];

    }else{
        $error=1;
    }
}
?>
<body>

    
<?php if ($success==0):?>   
        <?php if($error==1):?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-4 alert alert-danger text-center p-1 ">
                    <p>Nom d'utilisateur inconnu</p>
                    </div>
                </div>
            </div>
        <?php endif?>
        <div class="container"> 
            <div class="row justify-content-center ">
                <form class="col-sm-6 col-md-4 " method="POST">
                    <fieldset>
                    <legend><h1 class=" h4 text-center ">Réinitialiser mon mot de passe</legend>
                    <input type="text" name="username" class= "form-control mt-5" placeholder= "Nom d'utilisateur" required>
                    <button type="submit" class="btn btn-danger m-5">Valider</button>
                    </fieldset>
                </form>
            </div>
        </div>
    
<?php elseif($success==1):?>
    <div class="container">
        <div class="row justify-content-center ">
            <form class="col-sm-6 col-md-4 " action="new_pass.php" method="POST">
                <fieldset>
                <legend>
                <h2 class= "h4 text-center ">Merci <?= $info_user; ?>,</br><?= $question; ?></legend>
                <input type="hidden" name="id_user" value="<?=$id_user;?>" class= "form-control mt-5" required> 
                <input type="text" name="reponse" class= "form-control mt-5" placeholder= "Réponse" required>
                <button type="submit" class="btn btn-danger m-5 ">Valider</button>
                </fieldset>
            </form>   
        </div>
    </div>
    
<?php endif?>
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





    
    