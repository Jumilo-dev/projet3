<?php 
include 'includes/connect_bdd.php';
include "includes/header.php"; 
$title ="Mot de passe oublié";


?>
<body>
    

<p>Modifier mon mot de passe</p>
<form  action= "infos_user.php" method="POST">

        
<div >
        <label  for="username">Nom d'utilisateur</label> 
        <input type="text" name="username" value=""  required>
    </div>
    <button type="submit">Valider</button>
</form>
</body>

    
    