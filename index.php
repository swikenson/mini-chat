<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Le mini-chat / Accueil</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style_01.css"  rel="stylesheet" type="text/css" media="all">
    </head>
    <body>
        <div class="container">
            <h1 class="row">Mini-chat</h1>
            
            <!-- Formulaire de saisie -->
            <div class="row">
                <form class="form-horizontal col-md-12" method="post" action="pages/minichat_post.php">
                    
                    <!-- Champ de saisie texte une ligne -->
                    <div class="form-group form-group-lg">
                        <label for="pseudo" class="col-sm-2 control-label">Pseudo : </label>
                        <div class="col-sm-10 focus"> 
                            <input class="form-control" <?php
                                /*
                                 * si un pseudo existe dans le cookie,
                                 * alors renseigne automatiquement la valeur du champ pseudo
                                 * implicitement, si le cookie n'est pas détecté,
                                 * la valeur du champ n'est pas renseignée
                                 */
                                if (isset($_COOKIE['pseudo'])) {
                                    $cookie_pseudo = htmlspecialchars(strip_tags($_COOKIE['pseudo']));
                                    echo 'value="' . $cookie_pseudo . '"';
                                }
                                ?> type="text" name="pseudo" id="pseudo" placeholder="Ton pseudo" autofocus required />
                        </div>
                    </div>
                    
                    <div class="form-group form-group-lg">
                        <label for="message" class="col-sm-2 control-label">Message : </label>
                        <div class="col-sm-10 focus"> 
                            <input class="form-control" type="text" name="message" id="message" placeholder="Ton message" autofocus required />
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-default btn-lg pull-right clearfix">Envoyer</button>
                    <div class="clearfix"></div>
                </form>
            </div>
            
            <!-- Rafraîchir les messages de la page -->
            <div id="toFresh" class="row clearfix">
                <a href="index.php" class="btn btn-default">Rafraîchir la liste des messages</a>
            </div>
            
            <!-- Afficher les messages par page -->
            <section class="row">
                <?php
                include 'configuration/configurationPDO.php'; // Connexion à la base
                
                $limit_messages_per_page = 10; // Déclaration variable message par page
                
                // Calculer le nombre de message dans la table messages
                $sql_count = "SELECT COUNT(id) AS counter FROM messages";
                $req_count = $bdd->prepare($sql_count);
                $req_count->execute();
                $messages = $req_count->fetch(PDO::FETCH_ASSOC);
                $counter = $messages['counter']; // Nombre de messages

                /*
                 *  Déterminer le nombre de pages à afficher par rapport au nombre de messages
                 * Utilisation de la fonction ceil pour arrondir à l'entier suppérieur
                 */
                $number_of_pages = ceil($counter / $limit_messages_per_page);

                /*
                 * Déterminer la page active - Détermine également si il existe une page dans $_GET
                 * 'page' est utilisé dans le lien href de la pagination
                 */
                if (isset($_GET['page'])) {
                      $current_page = (int) $_GET['page']; // Assurer que $_GET soit bien un INT
                } else {
                    $current_page = 1; // Lors de l'affichage de la page index - 'page' "n'existe pas"
                }
                
                /*
                 * Pendant le dev - test d'affichage des différentes variables
                 * Permet de vérifier les valeurs
                 */   
//                // $_GET['page']
//                echo '$current_page';
//                echo '<pre>'; 
//                print_r($current_page);
//                echo '</pre>';
//
//                // Test DEV
//                echo 'Nombre de messages';
//                echo '<pre>'; 
//                //print_r($_GET['page']);
//                print_r($counter);
//                echo '</pre>';
//
//                echo 'Nombre de pages';
//                echo '<pre>'; 
//                print_r($number_of_pages);
//                echo '</pre>';
//                // Fin test dev
                
                
                /*
                 * Lister les messages par page
                 * La variable $limit_start permet de générer dynamiquement la LIMIT dans la requête
                 * Obligatoire pour afficher les bons messages selon la page active
                 * La page démarre à 1 - Il faut donc soustraire le nombre de messages (solution 1) ou soustraire une page 1
                 */ 
                //$limit_start = (int) (($current_page * $limit_messages_per_page) - $limit_messages_per_page); // Solution 1
                $limit_start = (int) (($current_page -1) * $limit_messages_per_page); // Solution 2
                
                // Requête préparée pour récupérer tous les messages
                $req = $bdd->query("SELECT id, pseudo, message, date_time_msg
                                    FROM messages
                                    ORDER by id DESC
                                    LIMIT $limit_start,$limit_messages_per_page
                                   ");
                
                
                // Afficher les messages
                while ($datas = $req->fetch()) {
                    // Formater la date en FR - à partir de PHP 5.4
                    $new_date_format = (new DateTime($datas['date_time_msg']))->format('d/m/Y à H:i:s');
                ?>
             
                <div class="panel panel-default">
                    <div class="panel-heading"><p><strong><?php echo htmlspecialchars(strip_tags($datas['pseudo'])); ?></strong> à écrit <em>le <?php echo $new_date_format ; ?></em></p></div>
                    <div class="panel-body">
                        <p>-> <?php echo /*$datas['id'] . ' ' . */ htmlspecialchars(strip_tags($datas['message'])); ?></p>
                    </div>
                </div>
                                
                <?php    
                }
                
                $req->closeCursor();        // Ferme le curseur, permettant à la requête d'être de nouveau exécutée
                $req_count->closecursor();  // Ferme le curseur, permettant à la requête d'être de nouveau exécutée
                $bdd = null;                // Fermeture de la connexion à la base
                ?>
            </section>
            
            <!-- La pagination des messages -->
            <nav class="row text-center">
                <ul class="pagination">
                    <!-- La flèche précédente -->
                    <?php
                    if ($current_page != 1) //Affiche la flèche de gauche si page active différente de page = 1
                    {
                    ?>
                    <li>
                        <a href="index.php?page=<?php echo $current_page -1 ; ?>" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                    
                    <!-- Les numéros de pages -->
                    <?php
                    for ($i = 1; $i <= $number_of_pages; $i++) {
                        echo '<li';
                        if ($current_page == $i) {
                            echo ' class="active"';
                        }
                        echo '><a href="index.php?page=' . $i . '">' . $i . '</a></li>';   
                    }
                    ?>
                    
                    <!-- La flèche suivante -->
                    <?php
                    if ($current_page != $number_of_pages) //Affiche la flèche de droite si page active différente de page = dernière page
                    {
                    ?>
                    <li>
                        <a href="index.php?page=<?php echo $current_page + 1; ?>" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </body>
</html>
