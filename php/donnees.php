<?php
session_start();
if (isset($_SESSION['statut'])){ 
    if ($_SESSION['statut'] == 1){ // on vérifie si l'utilisateur est déjà connecté ou pas
      echo "<script>setTimeout(\"location.href = '../index.php';\",3000);</script>";
      echo "Vous êtes déjà connecté.";
      exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') { 
    error_reporting(0); // enlève les warning       
    function get_data() {
        $name = $_GET['nom'];
        $file_name='donnees'. '.json';
        if(file_exists("../data/$file_name")) { // vérfie si le fichier donnees.json existe, si il n'existe pas il faut le créer, sinon on écrit dedans
            $current_data=file_get_contents("../data/$file_name");
            $array_data=json_decode($current_data, true);
            for ($i=0 ; $i<=count($array_data) ; $i++) {
                if ( $_GET['pseudo'] == $array_data[$i]['Pseudo'] && $_GET['mdp'] == $array_data[$i]['Mdp'] ) { // vérifie si l'utilisateur qui essaye de s'inscrire est déjà inscrit dans la base de données
                    echo "<script>setTimeout(\"location.href = '../index.php';\",3000);</script>"; // affiche les messages ci-dessous pendant 3 secondes avant de rediriger l'utilisateur, (ici vers index.php)
                    echo 'Vous êtes déjà inscrit !'."<br>";
                    echo 'Vous êtes maintenant connecté.'."<br>";
                    echo 'Redirection en cours...';
                    $_SESSION['statut'] = 1; // l'utilisateur a le statut connecté
                    exit();
                }
            }
            $extra=array( // l'utilisateur n'est pas inscrit dans la base de données, on rajoute donc ses informations dans notre base de données
                'Nom' => $_GET['nom'],
                'Prénom' => $_GET['prénom'],
                'Genre' => $_GET['genre'],
                'Email' => $_GET['email'],
                'Phone' => $_GET['phone'],
                'Date' => $_GET['date'],
                'Adresse' => $_GET['adresse'],
                'Metier' => $_GET['metier'],
                'Pseudo' => $_GET['pseudo'],
                'Mdp' => $_GET['mdp'],
            );
            $array_data[]=$extra;
            return json_encode($array_data, JSON_UNESCAPED_UNICODE);
        }
        else { // le fichier donnees.json n'existe pas
            $datae=array();
            $datae[]=array(
                'Nom' => $_GET['nom'],
                'Prénom' => $_GET['prénom'],
                'Genre' => $_GET['genre'],
                'Email' => $_GET['email'],
                'Phone' => $_GET['phone'],
                'Date' => $_GET['date'],
                'Adresse' => $_GET['adresse'],
                'Metier' => $_GET['metier'],
                'Pseudo' => $_GET['pseudo'],
                'Mdp' => $_GET['mdp'],
            );
            return json_encode($datae, JSON_UNESCAPED_UNICODE);   
        }
    }
  
    $file_name= 'donnees'. '.json'; // on créé le fichier
    $currentLocation = '../php/donnees.json';
    $newLocation = '../data/donnees.json';
    $moved = rename($currentLocation, $newLocation); // on le place dans le dossier data
      
    if(file_put_contents("../data/$file_name", get_data())) { // on vérifie si le fichier contient les informations rentrées par l'utilisateur
        echo "<script>setTimeout(\"location.href = '../index.php';\",3000);</script>";
        echo 'Inscription réussite<br>';
        echo 'Redirection en cours...';
        $_SESSION['statut'] = 1; // l'utilisateur a le statut connecté
    }
    else {
        echo "<script>setTimeout(\"location.href = '../php/inscription.php';\",3000);</script>";
        echo 'Désolé, une erreur est survenue lors de votre inscription, veuillez réessayer';
        echo 'Redirection en cours...';
        $_SESSION['statut'] = 0; // l'utilisateur n'a pas le statut connecté
    }
}

?>