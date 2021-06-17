<?php
include '../includes/connect_bdd.php';
include "../includes/header.php";


$title="Protectpeople";

$requete= $db->prepare("SELECT * FROM partenaires WHERE Titre=?");
$requete->execute(array($title));
while ($data=$requete->fetch()){

$id_part=$data['id_part'];
$titre=$data['Titre'];
$extrait=$data['extrait'];
}
?>
<p><?=$titre?></p>
</br>
<p><?=$extrait?></p>

<p>Contenu</p>