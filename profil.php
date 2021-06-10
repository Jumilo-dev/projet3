<?php
include 'includes/header.php';
include 'includes/connect_bdd.php';
?>



<p>Profil</p>

<p> Nom :<?php echo $_SESSION["utilisateur"]["nom"];?></p>
<p>Prénom: <?php echo $_SESSION["utilisateur"]["prenom"];?></p>

<p>Changer de mot de passe</p>

<p>Nom d'utilisateur: <?php echo $_SESSION["utilisateur"]["username"];?></p>

<body class="text-center">
    <main class="form-signin">
<!--formulaire de connexion a afficher sur la page d'accueil -->
    <form action="" method="post">
    
        <h1 class="h3 mb-3 pt-4 fw-normal">Changer mon nom d'utilisateur</h1>

    <div class="form-floating mb-3">
        <input type="password" name="password" id= "password" class="form-control" required>
        <label for="password" class="form-label">Mot de passe</label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" name="new_username" id= "password" class="form-control" required>
        <label for="new_username" class="form-label">Nouveau nom d'utilisateur</label>
    </div>

    

    <button class="mx-auto btn btn-danger" type="submit">Changer</button>



<?php include 'includes/footer.php';?>