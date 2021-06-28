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
<div class="container">
    <div class="row justify-content-center p-3">
        <div class="col-sm-4 col-md-6">
<img src="../<?=$logo?>" alt="Logo du partenaire" class="img-fluid">
        </div>
    </div>
<h2><?=$titre?></h2>
</br>
<p><?=$contenu?></p>





<section class = "border border-danger border-3 mt-4">
<?php if (isset($_GET["success"]) && verify_html($_GET["success"])==1):?>
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-6 alert alert-success text-center p-1 ">
        Commentaire publié! Merci.
        </div>
    </div>
<?php endif?>

    <div class = "row m-2">
        <div class="col-sm-10 col-md-5 ">
            <p class="h2"><?= $count_comment?> Commentaire(s)</p>
        </div>
        <div class="col-sm-12 col-md-3 offset-md-2">
        <?php
            $user= $_SESSION["utilisateur"]["id"];
            $part=($_GET["id_part"]);
            
            $verif= $db->prepare("SELECT * FROM commentaires WHERE user=? AND part=?");
            $verif->execute(array($user,$part));
            $reponse=$verif->fetch();
            if(!$reponse){
            ?>
            
            <a class= "btn btn-outline-dark btn-lg" href="commenter.php?id_part=<?=$id_part?>" role="button">Nouveau commentaire</a>
            
            <?php
            }else{
            ?>
            <a class= "btn btn-outline-dark btn-lg disabled" href="commenter.php?id_part=<?=$id_part?>" role="button" aria-disabled="true">Nouveau commentaire</a>
            <?php
            }?>
        </div>
        
        <div class="col-sm-1 col-md-2 d-flex badge bg-light text-wrap g-0 ">
            <?php
            $verif= $db->prepare("SELECT * FROM vote WHERE user=? AND part=?");
            $verif->execute(array($user,$part));
            $reponse=$verif->fetch();
            if(!$reponse){
            ?>
            <form action="vote.php?id_part=<?=$id_part?> &value=1" method ="POST">
            <button class= "btn  m-0" type="submit"><?=$like?><i class="fas fa-thumbs-up" style="color:green"></i></button>
            </form>
        
        
            <form action="vote.php?id_part=<?=$id_part?> &value=-1"method ="POST">
            <button class= "btn m-0" type="submit"aria-disabled="true"><i class="fas fa-thumbs-down" style="color:red"></i><?=$dislike?></button>
            </form>
            <?php
            }else{
            ?>
            <form action="vote.php?id_part=<?=$id_part?> &value=1" method ="POST">
            <button class= "btn disabled  m-0"type="submit" aria-disabled="true"><?=$like?><i class="fas fa-thumbs-up" style= "color:green"></i></button>
            </form>
        
        
            <form action="vote.php?id_part=<?=$id_part?> &value=-1"method ="POST">
            <button class= "btn disabled  m-0"type="submit"><i class="fas fa-thumbs-down" style="color:red"></i><?=$dislike?></button>
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
        <div class="col-12">
        <?php
        $user=$avis["user"];
        
        $auteur= $db->prepare("SELECT * FROM users WHERE id_user=?");
        $auteur->execute(array($user));
        $identite=$auteur->fetch();
        ?>
        <p>Commentaire de : <?=$identite["prenom"]?></p>
        <p >Le : <?=$avis["date"]?> </p>
        <p ><?=$avis["avis"]?> </p>
            
        </div>
    </div>    
    <?php } ?>
    
</section> 


    <?php include '../includes/footer.php';?>   


