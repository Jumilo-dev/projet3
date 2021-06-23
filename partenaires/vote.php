<?php
session_start();
include '../includes/connect_bdd.php';
if($_SERVER['REQUEST_METHOD'] !='POST'){
    http_reponse_code(403);
    die();
}


$value=($_GET["value"]);
$part=($_GET["id_part"]);
$user=$_SESSION["utilisateur"]["id"];
var_dump($value,$part,$user);
    $verif= $db->prepare("SELECT * FROM vote WHERE user=? AND part=?");
    $verif->execute(array($user,$part));
    $reponse=$verif->fetch();
    if(!$reponse){
        $new_vote=$db->prepare("INSERT INTO `vote`(`part`,`user`,`value`) VALUES (?,?,?)");
        $new_vote->execute(array($part,$user,$value));
        
        $compte_likes=$db->prepare("SELECT * FROM vote WHERE `value`=1 AND part=?");
        $compte_likes->execute(array($part));
        $likes = $compte_likes->rowCount();
        var_dump($likes);
        $count=$db->prepare("UPDATE partenaires SET`like_count`=? WHERE id_part=? LIMIT 1");
        $count->execute(array($likes,$part));
        
       
        $compte_dislikes=$db->prepare("SELECT * FROM vote WHERE `value`=-1 AND part=?");
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
