<?php
$title="Avis";
include "../includes/header.php";
include '../includes/connect_bdd.php';
//*recupérer les infos du partenaire

$requete= $db->prepare("SELECT * FROM partenaires WHERE id_part=?");
$requete->execute(array(intval($_GET["id_part"])));
while ($data=$requete->fetch()){
    $titre=$data['titre'];
    $logo=$data['image'];
}
//*on vérifie que le formulaire est soumis et complet
if (!empty($_POST)){
    if (isset($_POST["avis"])
    && !empty($_POST["avis"]))
    {
        $user= $_SESSION["utilisateur"]["id"];
        $part= ($_GET["id_part"]);
        $avis= verify_html($_POST["avis"]);
        //*Requête d'insertion dans la table commentaires du commentaire
        $sql= "INSERT INTO `commentaires`(`id_user`,`id_part`,`date_create`,`avis`) VALUES (:id_user, :id_part, CURDATE(),:avis)";
        $query = $db->prepare($sql);
        $query->bindValue(":id_user", $user);
        $query->bindValue(":id_part", $part);
        $query->bindValue(":avis", $avis, PDO::PARAM_STR);
        $query->execute();

        //*comptage nombre commentaire pour ce partenaire
        $compte_avis=$db->prepare("SELECT * FROM commentaires WHERE id_part=?");
        $compte_avis->execute(array($part));
        $avis = $compte_avis->rowCount();

        //*insertion de cette valeur dans la table partenaire
        $count=$db->prepare("UPDATE partenaires SET`comment_count`=? WHERE id_part=? LIMIT 1");
        $count->execute(array($avis,$part));

        //*Renvoi vers page du partenaire
        header ("Location: partenaire.php?id_part=$part&success=1");
    }
}


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
                <h1><?=$titre?>,</h1>
                <p>vous remercie de partager votre expérience.</p>
            </div>
        </div>    
        <form action="commenter.php?id_part=<?=$_GET["id_part"];?>" method="POST">
            <div class="row justify-content-center p-3">
                <div class="col-sm-4 col-md-6">
                    <label for="avis" class="form-label">Votre commentaire :</label>
                    <textarea class="form-control" rows="5" name="avis" id="avis"></textarea>
                </div>
            </div>
            <div class="row justify-content-center p-3">
                <div class="col-sm-4 col-md-6 text-center">
                    <button class="btn btn-danger m-4" type="submit" >Poster mon commentaire</button>
                </div>
            </div>    
        </form>
    </section>
</div>
<?php include '../includes/footer.php';?>