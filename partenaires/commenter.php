<?php
include '../includes/connect_bdd.php';
include "../includes/header.php";

//*recupérer les infos du partenaire
if (!empty($_POST)){
    
    if (isset($_POST["avis"])
    && !empty($_POST["avis"]))
    {
        $user= $_SESSION["utilisateur"]["id"];
        $part= ($_GET["id_part"]);
        $avis= strip_tags($_POST["avis"]);
        //*Requête d'insertion dans la table commentaires
       $sql= "INSERT INTO `commentaires`(`user`,`part`,`date`,`avis`) VALUES (:user, :part, CURDATE(),:avis)";
//*Requete preparée
$query = $db->prepare($sql);
$query->bindValue(":user", $user);

$query->bindValue(":part", $part);
$query->bindValue(":avis", $avis, PDO::PARAM_STR);


$query->execute();
header ("Location: partenaire.php?id_part=$part");
    }
}
$title="Avis";

?>
<body>

    <form action="commenter.php?id_part=<?=$_GET["id_part"];?>" method="POST">
    <label for="avis">Votre commentaire</label>
    <input type="text-area" name="avis">
    <button type=submit>Poster mon commentaire</button>
    </form>
</body>