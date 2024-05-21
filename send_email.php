<?php
session_start();
error_reporting(0);

$nom = isset($_POST["nom"]) ? $_POST["nom"] : '';
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$object = isset($_POST["object"]) ? $_POST["object"] : '';
$contenu = isset($_POST["contenu"]) ? $_POST["contenu"] : '';
$genre = isset($_POST["genre"]) ? $_POST["genre"] : '';
$date_naissance = isset($_POST["date_naissance"]) ? $_POST["date_naissance"] : '';
$valider = isset($_POST["valider"]) ? $_POST["valider"] : '';


if (isset($valider)) {
    if (empty($nom)) {
        $message = '<div class="erreur">Nom laissé vide.</div>';
    } elseif (empty($prenom)) {
        $message = '<div class="erreur">Prénom laissé vide.</div>';
    } elseif (empty($email)) {
        $message = '<div class="erreur">Email laissé vide.</div>';
    } elseif (empty($object)) {
        $message = '<div class="erreur">Objet laissé vide.</div>';
    } elseif (empty($contenu)) {
        $message = '<div class="erreur">Contenu laissé vide.</div>';
    } else {
        $email_subject = "Nouveau message de : $nom $prenom";
        $email_body = "Récapitulatif de votre formulaire de contact\n\n".
                      "Nom: $nom\n".
                      "Prénom: $prenom\n".
                      "Email: $email\n".
                      "Genre: $genre\n".
                      "Date de naissance: $date_naissance\n".
                      "Objet: $object\n\n".
                      "Message:\n$contenu";
                      

        $to = $email;  // Envoyer l'email à l'utilisateur lui-même
        $headers = "From: noreply@votresite.com\r\n";
        $headers .= "Reply-To: noreply@votresite.com\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // Envoi de l'email
        if (mail($to, $email_subject, $email_body, $headers)) {
            $message = '<div class="succes">Formulaire soumis avec succès. Un email de confirmation a été envoyé à ' . htmlspecialchars($email) . '.</div>';
        } else {
            $message = "<div class='erreur'>Erreur lors de l'envoi de l'email. Veuillez réessayer plus tard.</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Page de traitement</title>
        <link rel="stylesheet" href="./css/index.css">
        <meta http-equiv="refresh" content="100000000; URL=index.php">
    </head>


    <body >
        <div id="Page">
            <h3 id="titre"> Votre message a bien été envoyé. </h3>
            <p> L'equipe de la Boulangerie reviendra vers vous dans un délais maximum d'une semaine. </p> 
            <p>Recapitulatif du mail envoyé</p>
    
            <?php
                echo 'Nom : '.$_POST["nom"].'<br>';
                echo 'Prenom : '.$_POST["prenom"].'<br>';
                echo 'Email : ' .$_POST["email"].'<br>';
                
                echo 'Object : ' .$_POST["object"].'<br>';
                echo 'Contenu : ' .$_POST["contenu"].'<br>';
            ?>

        <a href="index.php">Retour vers la page d'accueil</a>
        </div>
       

    </body>
</html>