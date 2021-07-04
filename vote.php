<?php
session_start();
include 'includes/connect_bdd.php';
//*On vérifie que la méthode d'envoi des données est bien POST
if($_SERVER['REQUEST_METHOD'] !='POST'){
    http_reponse_code(403);
    die();
}
//*On récupère l'id du partenaire et la valeur du vote
$value=($_GET["value_vote"]);
$part=($_GET["id_part"]);
$user=$_SESSION["utilisateur"]["id"];
//*on vérifie qu'il n'y a pas déjà un vote utilisateur/partenaire
$verif= $db->prepare("SELECT * FROM vote WHERE id_user=? AND id_part=?");
$verif->execute(array($user,$part));
$reponse=$verif->fetch();
    //si pas déjà voté on enregistre le vote
    if(!$reponse){
    $new_vote=$db->prepare("INSERT INTO `vote`(`id_part`,`id_user`,`value_vote`) VALUES (?,?,?)");
    $new_vote->execute(array($part,$user,$value));
    //on fait le comptage des votes du partenaire
    $compte_likes=$db->prepare("SELECT * FROM vote WHERE `value_vote`=1 AND id_part=?");
    $compte_likes->execute(array($part));
    $likes = $compte_likes->rowCount();
    // et on maj la bdd
    $count=$db->prepare("UPDATE partenaires SET`like_count`=? WHERE id_part=? LIMIT 1");
    $count->execute(array($likes,$part));
    
    //on refait la même chose pour les dislikes
    $compte_dislikes=$db->prepare("SELECT * FROM vote WHERE `value_vote`=-1 AND id_part=?");
    $compte_dislikes->execute(array($part));
    $dislikes = $compte_dislikes->rowCount();
    var_dump($dislikes);
    $count=$db->prepare("UPDATE partenaires SET`dislike_count`=? WHERE id_part=? LIMIT 1");
    $count->execute(array($dislikes,$part));
    
    header ("Location: partenaire.php?id_part=$part");
    }else{
    echo "Impossible de voter 2 fois sur un même partenaire";
    header ("Location: partenaire.php?id_part=$part");
    }
?>
