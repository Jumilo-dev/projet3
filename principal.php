<?php

include 'includes/header.php';

include 'includes/connect_bdd.php';

$sql= $db->query("SELECT * FROM partenaires");
$title="Présenation";


?>
<div class="container">
<section class="row text-center">
    <h1 class ="col-12">Groupement Banque Assurance Français</h1>
    <p class ="col-12">Le GBAF est une fédération représentant les 6 grands groupes français:</p>
    <ul class ="col-12">
        <li>BNP Paribas</li>
        <li>BPCE</li>
        <li>Crédit Agricole</li>
        <li>Crédit Mutuel - CIC</li>
        <li>Société Générale</li>
        <li>La Banque Postale</li>
    </ul>
    <p class ="col-12">Même s’il existe une forte concurrence entre ces entités, 
    elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes
     sur le territoire national. Le GBAF est le représentant de la profession bancaire et des assureurs
      sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité
       bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics</p>
    <img src="image/partenaires.jpg" alt="Représentation du travail d'équipe">
</section >
<hr>
<section class="row text-center">
    <h2 class ="col-12">Les partenaires du GBAF</h2>
    <p class ="col-12">Les produits et services bancaires sont nombreux et très variés.
    Afin de renseigner au mieux les clients, les salariés des 340 agences des banques
     et assurances en France (agents, chargés de clientèle, conseillers financiers, etc.)
      recherchent sur Internet des informations portant sur des produits bancaires et des financeurs,
      entre autres. Aujourd’hui, il n’existe pas de base de données pour chercher ces informations de manière
      fiable et rapide ou pour donner son avis sur les partenaires et acteurs du secteur bancaire,
        tels que les associations ou les financeurs solidaires. 
    Pour remédier à cela, le GBAF souhaite proposer aux salariés des grands groupes français
     un point d’entrée unique, répertoriant un grand nombre d’informations sur les partenaires et acteurs
      du groupe ainsi que sur les produits et services bancaires et financiers. 
      Chaque salarié pourra ainsi poster un commentaire et donner son avis.</p>
</section >
<section class = "border border-danger border-3 mt-4 ">
    <?php
    while ($data = $sql->fetch()){
    ?>
    <div class = " border border-3 m-4 ">
        <div class ="row">
            <div class=" col-sm-12 col-md-4 col-lg-4 text-center align-self-center">
            <img class="" style="width: 200px" src="<?=$data["image"]?>" >
            </div>
            <div class="col-sm-12 col-md-8 col-lg-6 mt-4">
            <h3 ><?=$data["titre"]?></h3>  
            <p><?=$data["extrait"]?> </p>
            </div>    
        </div>
            <div class="col-4 offset-8 position-relative mt-5">
            <button class="position-absolute bottom-0 end-0"><a href="<?=$data["lien"]?>?id_part=<?=$data["id_part"]?>">En savoir plus</a></button>
            
        </div>
    </div>
    <?php } 
    ?>       
</section >


</div>
</body>
<?php include 'includes/footer.php';?>