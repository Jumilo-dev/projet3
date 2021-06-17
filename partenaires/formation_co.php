<?php
include '../includes/connect_bdd.php';
include "../includes/header.php";



var_dump($_GET["id_part"]);
$requete= $db->prepare("SELECT * FROM partenaires WHERE id_part=?");
$requete->execute(array(intval($_GET["id_part"])));
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