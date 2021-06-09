<?php

include 'includes/header.php';
//*include 'includes/navbar.php';
include 'includes/connect_bdd.php';
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    <title><?php if (isset($title)){echo $title;} else {echo 'GBAF';} ?></title>
    <link rel="stylesheet" href= "css/bootsrap.min.css" >
    
</head>
<body>
<div class="container">
<?php include 'login.php';?>
</div>
</body>

<?php 
include 'includes/footer.php';
?>




