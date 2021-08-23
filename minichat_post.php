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



$req = $bdd ->prepare('INSERT INTO chat (pseudo, message) VALUES(?,?)');

$req ->execute(array(
    $_POST['pseudo'],
    $_POST['message']

));

/**renvoyer le visiteur à la page chat */

header('Location: minichat.php');


?>
