<?php

include 'includes/header.php';

include 'includes/connect_bdd.php';

if(isset($_POST['username'])&& !empty($_POST['username'])){
    $username =strip_tags($_POST["username"]);

    $infos= $db->prepare('SELECT * FROM users WHERE username =?');
    $infos->execute(array($username));

    if($infos->rowCount()>0){
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
        echo "Nom d'utilisateur inconnu";
        header ("Location: reinit_pass.php");
    }


}

/*if(isset($_POST['reponse'])&& !empty($_POST['reponse'])){
    $reponse =strip_tags($_POST["reponse"]);
    

    if($reponse !== $_SESSION["info_user"]["reponse"]){
    die ("Réponse invalide");
    header ("Location: info_user.php");
    }else{
    header ("Location: new_pass.php");
    }
}
*/?>
<body>
    

<div>
    <p><?= $info_user; ?>,pour modifier votre mot de passe répondez à la question suivante:</p>
    </div>
    </br>
    <div><p><?= $question; ?></p>
    </div>

    <form action="new_pass.php"  method="post">

    <div >
         
        <input type="hidden" name="id_user" value="<?=$id_user;?>"  required>
    </div>      
<div >
        <label  for="reponse">Votre réponse:</label> 
        <input type="text" name="reponse" value=""  required>
    </div>
    <button type="submit">Valider</button>
</form>
</body>