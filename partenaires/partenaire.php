<?php
include '../includes/connect_bdd.php';
include "../includes/header.php";




$requete= $db->prepare("SELECT * FROM partenaires WHERE id_part=?");
$requete->execute(array(intval($_GET["id_part"])));
while ($data=$requete->fetch()){

$id_part=$data['id_part'];
$titre=$data['titre'];
$extrait=$data['extrait'];
$title=$titre;
}
?>
<p><?=$titre?></p>
</br>
<p><?=$extrait?></p>

<p>Contenu</p>

<button>Like</button>
<button>Dislike</button>
<a href="commenter.php?id_part=<?=$id_part?>">Donner mon avis sur ce partenaire</a>
<p>Vos avis</p>
