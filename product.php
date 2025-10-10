<?php
    require "config/connexion.php";

    // tester la présence de l'id dans l'url
    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        //protéger la valeur de l'id
        $id = htmlspecialchars($_GET['id']);
    } //sinon
    else{
        //redirection vers 404
        header("LOCATION:404.php");
        exit();
    }

    // requête à la base de données pour vérifier si l'is exoste et même temps récupérer les infos
    $req = $bdd->prepare("SELECT * FROM products WHERE id = ?");
    // $req = $bdd->query("SELECT * FROM produit WHERE id =25");
    $req->execute([$id]);
    // si id=25 => SELECT * FROM product WHERE id = 25
    // récup les donnéeq
    $don = $req->fetch();


    // vérifier si j'ai bien des données
    if(!$don)
    {
        // redirection vers 404
        header("LOCATION:404.php");
        exit();
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
    <title>Document</title>
</head>
<body>
    <?php echo $don['name'] ?>
    <h1><?= $don ['name'] ?></h1>
    <img src="images/<?= $don ['cover'] ?>" alt="image de <?= $don['name'] ?>">
</body>
</html>