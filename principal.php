<?php
$title= "Présentation";
include 'includes/header.php';
include 'includes/connect_bdd.php';
//*on bloque l'accès de la page si pas connecté
if (!isset($_SESSION["utilisateur"])){
    header ("Location: index.php");
}
//*on récupère les infos des partenaires
$sql= $db->query("SELECT * FROM partenaires");
?>


<hr>
    <section class="present">
        <h1>Groupement Banque Assurance Français</h1>
        <p>Le GBAF est une fédération représentant les 6 grands groupes français:</p>
        <ul>
            <li>BNP Paribas</li>
            <li>BPCE</li>
            <li>Crédit Agricole</li>
            <li>Crédit Mutuel - CIC</li>
            <li>Société Générale</li>
            <li>La Banque Postale</li>
        </ul>
        <p>Même s’il existe une forte concurrence entre ces entités, 
        elles vont toutes travailler de la même façon pour gérer près de 80 millions de comptes
        sur le territoire national. Le GBAF est le représentant de la profession bancaire et des assureurs
        sur tous les axes de la réglementation financière française. Sa mission est de promouvoir l'activité
        bancaire à l’échelle nationale. C’est aussi un interlocuteur privilégié des pouvoirs publics</p>
        <img src="image/partenaires.jpg" alt="Représentation du travail d'équipe">
    </section >
<hr>
    <section class="present">
        <h2>Les partenaires du GBAF</h2>
        <p>Les produits et services bancaires sont nombreux et très variés.
        Afin de renseigner au mieux les clients, les salariés des 340 agences des banques
        et assurances en France (agents, chargés de clientèle, conseillers financiers, etc.)
        recherchent sur Internet des informations portant sur des produits bancaires et des financeurs,
        entre autres.</br>
        Aujourd’hui, il n’existait pas de base de données pour chercher ces informations de manière
        fiable et rapide ou pour donner son avis sur les partenaires et acteurs du secteur bancaire,
        tels que les associations ou les financeurs solidaires.</br> 
        Pour remédier à cela, le GBAF propose aux salariés des grands groupes français
        un point d’entrée unique, répertoriant un grand nombre d’informations sur les partenaires et acteurs
        du groupe ainsi que sur les produits et services bancaires et financiers. 
        Chaque salarié peux ainsi poster un commentaire et donner son avis.</p>
    </section >
    <section class="list_part">
        <?php
        while ($data = $sql->fetch()){
        ?>
        <div class="logo_part">
            <img src="<?=$data["image"]?>" alt="Logo partenaire" >
            <h3 ><?=$data["titre"]?></h3>  
            <p><?=$data["extrait"]?> </p>    
            <a href="<?=$data["lien"]?>?id_part=<?=$data["id_part"]?>" >
            <button type="button"> En savoir plus</button>
            </a>
        </div>
            
        <?php } 
        ?>       
    </section>
</div>

<?php include 'includes/footer.php';?>