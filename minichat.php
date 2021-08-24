<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minichat</title>
</head>
<body>
    <h1>Mini Chat</h1>
    <form action="minichat_post.php" method="POST">
    <p>
    <label for="pseudo">
        Pseudo:<input type="text" placeholder="pseudo" name="pseudo" id="pseudo"/>
    </label>
    </p>
    <p>
    <label for="message">
        Message:<input type="text" placeholder="message" name="message" id="message"/>
    </label>
    </p>

    <input type="submit" value="Envoyer"/>

    </form>

    <?php
/**connexion à la base de donnée */

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root','');

}
catch (Exception $e)
{
    die('Erreur :' .$e->getMessage());
}


/**recuperation des message et pseudo */

$reponse = $bdd->query('SELECT pseudo,message, date_creation FROM chat ORDER BY ID DESC LIMIT 0,20');

/**Affichage des messages par protection avec htmlspecialchars */

while($donnees = $reponse->fetch())
{
    echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . 
    htmlspecialchars($donnees['message']) . htmlspecialchars($donnees['date_creation']).'</p>';    
}



?>
    
</body>
</html>