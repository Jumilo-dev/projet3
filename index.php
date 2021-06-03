<?php

include 'includes/header.php';
include 'includes/navbar.php';
include 'includes/connect_bdd.php';
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php if (isset($title)){echo $title;} else {echo 'GBAF';} ?></title>
    
</head>
<body>
<?php include 'login.php';?>
</body>

<?php 
include 'includes/footer.php';
?>




