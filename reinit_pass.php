<?php 
include 'includes/connect_bdd.php';
include "includes/header.php"; 
$title ="Mot de passe oublié";


?>
<body>
    

<p>Modifier mon mot de passe</p>
<form  method="post">

        
<div >
        <label  for="username">Nom d'utilisateur</label> 
        <input type="text" name="username" value=""  required>
    </div>
    <button type="submit">Valider</button>
</form>

    <?php
    if(isset($_POST['username'])&& !empty($_POST['username'])){
        $username =strip_tags($_POST["username"]);

        $infos= $db->prepare('SELECT * FROM users WHERE username =?');
        $infos->execute(array($username));

        if($infos->rowCount()>0){
            $userinfo=$infos->fetch();
            $id_quest=$userinfo['question'];
            $inforeponse=$userinfo['reponse'];

            $infoquest=$db->prepare('SELECT question FROM questions WHERE id_question =? ');
            $infoquest->execute(array($id_quest));
            $question=$infoquest->fetch();
            $question = $question['question'];

        }else{
            echo "Nom d'utilisateur inconnu";
        }
    
    
    }?>
    <div>
    <p><?= $username; ?>,pour modifier votre mot de passe répondez à la question suivante:</p>
    </div>
    </br>
    <div><p><?= $question; ?></p>
    </div>

    <form  method="post">

        
<div >
        <label  for="reponse">Votre réponse:</label> 
        <input type="text" name="reponse" value=""  required>
    </div>
    <button type="submit">Valider</button>
</form>
<?php
    if(isset($_POST['reponse'])&& !empty($_POST['reponse'])){
        $reponse =strip_tags($_POST["reponse"]);

        if($reponse !== $inforeponse){
            die ("Réponse invalide");
        }
        header ("Location: index.php");

            
    }else{
        die("Nom d'utilisateur inconnu");
    }
    
    
    
    
    ?>
    

</body>