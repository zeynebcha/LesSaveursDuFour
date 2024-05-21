<?php
session_start();
error_reporting(0);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    $Json = file_get_contents("../data/donnees.json");
    $myarray = json_decode($Json, true) ?: [];

    if ($action == 'inscription') {
        // Code pour l'inscription
        $nom = $_POST['nom'];
        $prenom = $_POST['prénom'];
        $genre = $_POST['genre'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $date = $_POST['date'];
        $adresse = $_POST['adresse'];
        $metier = $_POST['metier'];
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];

        foreach ($myarray as $user) {
            if ($user['Pseudo'] == $pseudo) {
                echo "<script>setTimeout(\"location.href = '../inscription.php';\",3000);</script>";
                echo "Nom d'utilisateur déjà pris.<br>";
                echo 'Redirection en cours...';
                exit();
            }
        }

        $new_user = [
            'Nom' => $nom,
            'Prenom' => $prenom,
            'Genre' => $genre,
            'Email' => $email,
            'Phone' => $phone,
            'Date' => $date,
            'Adresse' => $adresse,
            'Metier' => $metier,
            'Pseudo' => $pseudo,
            'Mdp' => $mdp
        ];

        $myarray[] = $new_user;
        file_put_contents("../data/donnees.json", json_encode($myarray, JSON_PRETTY_PRINT));

        echo "<script>setTimeout(\"location.href = '../connexion.php';\",3000);</script>";
        echo "Inscription réussie !<br>";
        echo 'Redirection en cours...';
        exit();

    } elseif ($action == 'connexion') {
        // Code pour la connexion
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];

        if ($pseudo == "admin" && $mdp == "1234") { // identifiants admin
            $_SESSION['statut'] = 5; // statut admin
            echo "<script>setTimeout(\"location.href = '../index.php';\",3000);</script>";
            echo "Bienvenu chef !";
            exit();
        }

        foreach ($myarray as $user) {
            if ($pseudo == $user['Pseudo'] && $mdp == $user['Mdp']) { // vérifie si le nom d'utilisateur et le mot de passe entrés par l'utilisateur sont inscrits dans la base de données
                $_SESSION['adresse'] = $user['Adresse']; // on récupère les données de l'utilisateur qui seront utiles au moment de l'envoi du mail de validation
                $_SESSION['email'] = $user['Email'];
                $_SESSION['nom'] = $user['Nom'];
                $_SESSION['prenom'] = $user['Prenom'];
                echo "<script>setTimeout(\"location.href = '../index.php';\",3000);</script>"; // affiche les messages ci-dessous pendant 3 secondes avant de rediriger l'utilisateur (ici vers index.php)
                echo 'Connexion réussie !<br>';
                echo 'Redirection en cours...<br>';
                $_SESSION['statut'] = 1; // l'utilisateur est connecté
                exit();
            }
        }

        // Si on arrive ici, cela signifie que les informations entrées par l'utilisateur ne sont pas présentes dans le fichier
        echo "<script>setTimeout(\"location.href = '../connexion.php';\",3000);</script>";
        echo "Nom d'utilisateur ou mot de passe incorrect !<br>";
        echo 'Redirection en cours...<br>';
        $_SESSION['statut'] = 0; // l'utilisateur n'est pas connecté
        exit();
    } else {
        echo "<script>setTimeout(\"location.href = '../connexion.php';\",3000);</script>";
        echo 'Action non reconnue<br>';
        echo 'Redirection en cours...<br>';
        $_SESSION['statut'] = 0;
        exit();
    }
} else {
    echo "<script>setTimeout(\"location.href = '../connexion.php';\",3000);</script>";
    echo 'Méthode de requête incorrecte<br>';
    echo 'Redirection en cours...<br>';
    $_SESSION['statut'] = 0;
    exit();
}
?>
