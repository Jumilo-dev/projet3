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
        //*Requête d'insertion dans la table commentaires du commentaire
        $sql= "INSERT INTO `commentaires`(`user`,`part`,`date`,`avis`) VALUES (:user, :part, CURDATE(),:avis)";
        $query = $db->prepare($sql);
        $query->bindValue(":user", $user);
        $query->bindValue(":part", $part);
        $query->bindValue(":avis", $avis, PDO::PARAM_STR);
        $query->execute();

        //*comptage nombre commentaire pour ce partenaire
        $compte_avis=$db->prepare("SELECT * FROM commentaires WHERE part=?");
        $compte_avis->execute(array($part));
        $avis = $compte_avis->rowCount();

        //*insertion de cette valeur dans la table partenaire
        $count=$db->prepare("UPDATE partenaires SET`comment_count`=? WHERE id_part=? LIMIT 1");
        $count->execute(array($avis,$part));

        //*Renvoi vers page du partenaire
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
<?php include '../includes/footer.php';?>