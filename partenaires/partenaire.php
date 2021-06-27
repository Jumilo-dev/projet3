<?php
include '../includes/connect_bdd.php';
include "../includes/header.php";




$requete= $db->prepare("SELECT * FROM partenaires WHERE id_part=?");
$requete->execute(array(intval($_GET["id_part"])));
while ($data=$requete->fetch()){

$id_part=$data['id_part'];
$titre=$data['titre'];
$contenu=nl2br($data['contenu']);
$like=$data['like_count'];
$dislike=$data['dislike_count'];
$logo=$data['image'];
$count_comment=$data['comment_count'];
$title=$titre;
}
?>
<img src="../<?=$logo?>" alt="Logo du partenaire">

<p><?=$titre?></p>
</br>
<p><?=$contenu?></p>





<section class = "border border-danger border-3 mt-4">
    <div class = "row g-0">
        <div class="col-2">
            <p><?= $count_comment?> Commentaire(s)</p>
        </div>
        <div class="col-4 offset-3">
        <?php
            $user= $_SESSION["utilisateur"]["id"];
            $part=($_GET["id_part"]);
            
            $verif= $db->prepare("SELECT * FROM commentaires WHERE user=? AND part=?");
            $verif->execute(array($user,$part));
            $reponse=$verif->fetch();
            if(!$reponse){
            ?>
            
            <a class= "btn btn-info" href="commenter.php?id_part=<?=$id_part?>" role="button">Commenter</a>
            
            <?php
            }else{
            ?>
            <a class= "btn btn-info disabled" href="commenter.php?id_part=<?=$id_part?>" role="button" aria-disabled="true">Commenter</a>
            <?php
            }?>
        </div>
        
        <div class="col-1 offset-1 d-flex">
            <?php
            $verif= $db->prepare("SELECT * FROM vote WHERE user=? AND part=?");
            $verif->execute(array($user,$part));
            $reponse=$verif->fetch();
            if(!$reponse){
            ?>
            <form action="vote.php?id_part=<?=$id_part?> &value=1" method ="POST">
            <button class= "btn btn-info" type="submit">Like <?=$like?></button>
            </form>
        
        
            <form action="vote.php?id_part=<?=$id_part?> &value=-1"method ="POST">
            <button class= "btn btn-info" type="submit"aria-disabled="true">Dislike <?=$dislike?></button>
            </form>
            <?php
            }else{
            ?>
            <form action="vote.php?id_part=<?=$id_part?> &value=1" method ="POST">
            <button class= "btn btn-info disabled"type="submit" aria-disabled="true">Like <?=$like?></button>
            </form>
        
        
            <form action="vote.php?id_part=<?=$id_part?> &value=-1"method ="POST">
            <button class= "btn btn-info disabled"type="submit">Dislike <?=$dislike?></button>
            </form>
            <?php }?>
        </div>
        
        
    </div>
    
  

    
<?php
$requete= $db->prepare("SELECT * FROM commentaires WHERE part=?");
$requete->execute(array($part));      
?>
    
<?php while ($avis = $requete->fetch()){?>
    <div class = "row border border-3 m-4">
        <div class="col-8">
        <p ><?=$avis["avis"]?> </p>
        </div>
        <div class="col-4">
        <?php
        $user=$avis["user"];
        
        $auteur= $db->prepare("SELECT * FROM users WHERE id_user=?");
        $auteur->execute(array($user));
        $identite=$auteur->fetch();
        ?>
        <p>posté par: <?=$identite["prenom"]?> <?=$identite["nom"]?> </p>
        <p >Le : <?=$avis["date"]?> </p>    
        </div>
    </div>    
    <?php } ?>
    
</section> 


    <?php include '../includes/footer.php';?>   


