<?php
include '../configuration/configurationPDO.php';

// Réception données formulaire par method post
$pseudo     = htmlspecialchars(strip_tags($_POST['pseudo']));  // Pseudo
$message    = htmlspecialchars(strip_tags($_POST['message'])); // Messsage

// Preparation requete + execution
$requete = $bdd->prepare('INSERT INTO messages(
                                               pseudo,
                                               message,
                                               date_time_msg
                                               ) 
                                        VALUES(
                                               :pseudo, 
                                               :message,
                                               NOW()
                                               )');

$requete->bindParam(':pseudo',        $pseudo,    PDO::PARAM_STR);
$requete->bindParam(':message',       $message,   PDO::PARAM_STR);

$requete->execute();

if ($requete) {
    /*
     * Le cookie est créé dans pour le dossier pages,
     * le path '/' rend le cookie accessible dès la racine du site
     * et nonb pas uniquement à partir du dossier pages
     */
    setcookie('pseudo',$pseudo, time() + 365*24*3600, '/', null, false, true);
    header('Location: ../index.php'); // Retour automatique à la liste
} else {
    echo '<p>L\enregistrement a échoué<br><a href="../index.php">Retour à la liste des messages</a></p>';
}