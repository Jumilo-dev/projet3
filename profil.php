<?php
include 'includes/connect_bdd.php';
include 'includes/header.php';



?>
<?php

?>
<body>
<p>Modifier mon profil</p>
<form action="traitement.php" method="post">

        
<div >
        <label  for="name">Nom </label> 
        <input type="text" name="name" value="<?php echo $_SESSION ["utilisateur"]["nom"];?>"  required>
    </div>

    <div >
        <label  for="firstname">Prénom </label> 
        <input type="text" name="firstname" value="<?php echo $_SESSION ["utilisateur"]["prenom"]?>"  required>
    </div>

    <div >
        <label  for="password">Mot de passe </label> 
        <input type="password" name="password" >
    </div>
    <button class="mx-auto btn btn-danger" type="submit">Modifier mon profil</button>

</form>




<p>Modifier mon mot de passe</p>
<form action="traitement2.php" method="post">

        
<div >
        <label  for="username">Nom d'utilisateur</label> 
        <input type="text" name="username" value=""  required>
    </div>

    <div >
        <label  for="password">Mot de passe </label> 
        <input type="password" name="password" >
    </div>

    <div >
        <label  for="password">Nouveau Mot de passe </label> 
        <input type="password" name="newpass" required >
    </div>
    <button class="mx-auto btn btn-danger" type="submit">Modifier mon mot de passe</button>

</form>
</body>

<?php include 'includes/footer.php';?>