<?php
include '../includes/connect_bdd.php';
include "../includes/header.php";




$requete= $db->prepare("SELECT * FROM partenaires WHERE id_part=?");
$requete->execute(array(intval($_GET["id_part"])));
while ($data=$requete->fetch()){

$id_part=$data['id_part'];
$titre=$data['titre'];
$extrait=$data['extrait'];
$like=$data['like_count'];
$dislike=$data['dislike_count'];
$title=$titre;
}
?>
<p><?=$titre?></p>
</br>
<p><?=$extrait?></p>

<p>Contenu</p>
<form action="vote.php?id_part=<?=$id_part?> &value=1" method ="POST">
<button type="submit">Like <?=$like?></button>
</form>
<form action="vote.php?id_part=<?=$id_part?> &value=-1"method ="POST">
<button type="submit">Dislike <?=$dislike?></button>
</form>
<?php
            $user= $_SESSION["utilisateur"]["id"];
            $part=($_GET["id_part"]);
            
            $verif= $db->prepare("SELECT * FROM commentaires WHERE user=? AND part=?");
            $verif->execute(array($user,$part));
            $reponse=$verif->fetch();
            if(!$reponse){
            ?>
<a href="commenter.php?id_part=<?=$id_part?>">Donner mon avis sur ce partenaire</a>
            <?php
            }else{
            ?>
            <p>Vous avez déjà commenter ce partenaire</p>
            <?php
            }?>
<p>Vos avis</p>

<?php


$requete= $db->prepare("SELECT * FROM commentaires WHERE part=?");
$requete->execute(array($part));

    while ($avis = $requete->fetch()){
      
    ?>
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
    <?php } 
    ?>    

