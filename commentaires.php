<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Commentaires</title>
   <style>
       h1{
           text-align: center;
       }
   </style>
</head>
<body>
    <h1>Mon super Blog !</h1>
    <p>
        <a href="index.php">Retour à la list des billets</a>
    </p>

    <?php
    //connexion à la base de données

    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8','root','');
    }
    catch(Exception $e)
    {
        die('Erreur:'.$e->getMessage());

    }
        //on recupere le billet concené par une requete préparée

        $req = $bdd->prepare('SELECT id, titre, contenu, 
        DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS date_creation_fr 
        FROM billets 
        WHERE id=? ');

        $req->execute(
            array(
                $_GET['billet']
            )
        );

        //on met notre req dans le tiroire $donnees
        $donnees=$req->fetch();
    ?>

    <div class="neww">
        <h3>
            <?php echo htmlspecialchars($donnees['titre']); ?>
            <em>le
                <?php echo $donnees['date_creation_fr']; ?>
            </em>
        </h3>
        <p>
            <?php echo nl2br(htmlspecialchars($donnees['contenu'])); ?>
        </p>
    </div>

    <h2>Commentaires</h2>

    <?php 
    $req->closeCursor();

    //ici nous allons recuperer les commentaires

    $req=$bdd->prepare('SELECT auteur, commentaire,
    DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') 
    AS date_commentaire_fr FROM commentaires 
    WHERE id_billet = id_billet
    ORDER BY date_commentaire'
    );

    while($donnees=$req->fetch())
    {
        ?>
        <p>
            <strong>
                <?php echo htmlspecialchars($donnees['auteur']); ?>
            </strong>
            le<?php echo $donnees['date_commentaire_fr']; ?>
        </p>
        <p>
            <?php echo nl2br(htmlspecialchars($donnees['commmentaire'])); ?>
        </p>


        <?php
    }

    $req->closeCursor();
    ?>
    
</body>
</html>