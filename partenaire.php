<?php
$title="Partenaire";
include "includes/header.php";
include 'includes/connect_bdd.php';
//*on bloque l'accès de la page si pas connecté
if (!isset($_SESSION["utilisateur"])){
    header ("Location: ../index.php");
}
//*Récupérer data du partenaire grâçe à l'id récupérer en GET
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

}
?>
<section class="description">
    <img src="<?=$logo?>" alt="Logo du partenaire">
    <h2><?=$titre?></h2>
    </br>
    <p><?=$contenu?></p>
</section>
<section class= "list_comment">    
    <!-- affichage du message lors de la publication d'un commentaire -->
        <?php if (isset($_GET["success"]) && verify_html($_GET["success"])==1):?>
            
                
                <p class="alert alert-success "> Commentaire publié! Merci.
                
           
        <?php endif?>
    <article class="vote">
            <!-- affichage du nombre de commentaires -->
            <p class="count_comment"><?= $count_comment?> Commentaire(s)</p>
            </div>
            
            <?php 
            //*On vérifie si l'utilisateur a déjà poster un commentaire pour ce partenaire
            $user= $_SESSION["utilisateur"]["id"];
            $part=($_GET["id_part"]);
            $verif= $db->prepare("SELECT * FROM commentaires WHERE id_user=? AND id_part=?");
            $verif->execute(array($user,$part));
            $reponse=$verif->fetch();
            if(!$reponse){
            ?>
                <!-- si pas commenté bouton actif -->
                <a href="commenter.php?id_part=<?=$id_part?>">
                    <button class= "btnComment ">Nouveau commentaire</button>
                </a>
            <?php
            }else{
            ?>
                <!-- si déjà commenté bouton inactif -->
                <a  href="commenter.php?id_part=<?=$id_part?>" >
                    <button disabled class="btnComment ">Déjà commenter</button>
                </a>
            <?php
            }?>
            </div>
        
            <div >
            <?php
            //*On vérifie si l'utilisateur a déjà liker ou disliker le partenaire
            $verif= $db->prepare("SELECT * FROM vote WHERE id_user=? AND id_part=?");
            $verif->execute(array($user,$part));
            $reponse=$verif->fetch();
            if(!$reponse){
            ?>
                <!-- si pas liké/disliké bouton actif -->
                <form action="vote.php?id_part=<?=$id_part?>&value_vote=1" method ="POST">
                    <button class="btnLike" type="submit"><?=" $like"?><i class="fas fa-thumbs-up" ></i></button>
                </form>
                <form action="vote.php?id_part=<?=$id_part?>&value_vote=-1" method ="POST">
                    <button class="btnDislike"type="submit" ><i class="fas fa-thumbs-down" ></i><?=" $dislike"?></button>
                </form>
            <?php
            }else{
            ?>
                <!-- si déjà liké/disliké bouton inactif -->
                <form action="vote.php?id_part=<?=$id_part?>&value_vote=1" method ="POST">
                    <button  class="btnLike" type="submit" disabled><?="$like "?><i class="fas fa-thumbs-up" ></i></button>
                </form>
                <form action="vote.php?id_part=<?=$id_part?>&value_vote=-1" method ="POST">
                    <button class="btnDislike" type="submit" disabled><i class="fas fa-thumbs-down" ></i><?=" $dislike"?></button>
                </form>
            <?php }?>               
            </div>
    </article>
    <!-- on affiche tous les commentaires liés au partenaire -->   
    <?php
    $requete= $db->prepare("SELECT * FROM commentaires WHERE id_part=? ORDER BY date_create DESC");
    $requete->execute(array($part));      
    ?>
        
    <?php while ($avis = $requete->fetch()){?>
        <div class = "avis">
            
            <!-- on affiche les informations de l'utilisateur qui a posté le commentaire --> 
            <?php
                $user=$avis["id_user"];
                $auteur= $db->prepare("SELECT * FROM users WHERE id_user=?");
                $auteur->execute(array($user));
                $identite=$auteur->fetch();
            ?>
            
            <p>Commentaire de : <?=$identite["prenom"]?></p>
            <p >Le : <?=$avis["date_create"]?> </p>
            <p ><?=$avis["avis"]?> </p>   
            
        </div>    
    <?php } ?>    
</section>    
</div>

<?php include 'includes/footer.php';?>   


