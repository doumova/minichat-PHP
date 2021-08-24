<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>BLog & Commentaires</title>

    <style>
        h1, h3
{
    text-align:center;
}
h3
{
    background-color:black;
    color:white;
    font-size:0.9em;
    margin-bottom:0px;
}
.news p
{
    background-color:#CCCCCC;
    margin-top:0px;
}
.news
{
    width:70%;
    margin:auto;
}

a
{
    text-decoration: none;
    color: blue;
}
    </style>
</head>
<body>
    <h1>Mon Blog </h1>
    <p>Les derniers billets du blog:</p>


    <?php 
    try
    {
            /**ici la requete pour accéder à la base de données */
        $bdd= new PDO('mysql:host=localhost;dbname=minichat;charset=utf8','root','');
    }

    catch(Exception $e)
    {
        die('Erreur'.$e ->getMessage());
    }
    /**on recupere les 5 derniers billets */

    $req = $bdd->query('SELECT id,titre, contenu, DATE_FORMAT(date_creation,\'%d/%m/%Y à %Hh%imin%ss\') 
    AS date_creation_fr 
    FROM billets 
    ORDER BY date_creation 
    DESC LIMIT 0, 5');

    while($donnees = $req->fetch())
    {
    ?>
        <div class="news">
            <h3>
                <?php echo htmlspecialchars($donnees['titre']);?>
                <em>le 
                    <?php echo htmlspecialchars($donnees['date_creation_fr']);?>
                </em>
            </h3>
            <p>
                <?php
                //on affiche le contenu du billet
                echo nl2br(htmlspecialchars($donnees['contenu']));
                ?>
                <br/>
                <em>
                    <a href="commentaires.php?billet=<?php echo $donnees['id'];?>">commentaires</a>
                </em>
            </p>
        </div>

    <?php
    }    
    $req->closeCursor();
    ?>

</body>
</html>