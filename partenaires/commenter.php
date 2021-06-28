<?php
include '../includes/connect_bdd.php';
include "../includes/header.php";

//*recupérer les infos du partenaire

$requete= $db->prepare("SELECT * FROM partenaires WHERE id_part=?");
$requete->execute(array(intval($_GET["id_part"])));
while ($data=$requete->fetch()){


$titre=$data['titre'];
$logo=$data['image'];


}
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
        header ("Location: partenaire.php?id_part=$part&success=1");
    }
}
$title="Avis";

?>
<div class="container">

    <div class="row justify-content-center p-3">
        <div class="col-sm-4 col-md-6">
        <img src="../<?=$logo?>" alt="Logo du partenaire" class="img-fluid">
        </div>
    </div>
    <section class = "border border-danger border-3 mt-4">
        <div class="row text-center p-3">
            <div class="col-sm-4 col-md-12">
            <h1><?=$titre?>,</h1>vous remercie pour ce partage d'expérience.
            <p></p>
    
            
            
        </div>
        <form action="commenter.php?id_part=<?=$_GET["id_part"];?>" method="POST">
        <div class="row justify-content-center p-3">
            <div class="col-sm-4 col-md-6">
            <label for="avis" class="form-label">Votre commentaire</label>
            <textarea class="form-control" type="text-area" rows="5" name="avis"></textarea>
            </div>
        </div>
        <div class="row justify-content-center p-3">
            <div class="col-sm-4 col-md-6">
            <button class="btn btn-danger m-4" type="submit" >Poster mon commentaire</button>
            </div>
        </div>    
        </form>
    </section>

<?php include '../includes/footer.php';?>