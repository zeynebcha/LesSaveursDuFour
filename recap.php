<!DOCTYPE html>
<html>
    <head>
        <title>Page de traitement</title>
        <link rel="stylesheet" href="./css/index.css">
        <meta http-equiv="refresh" content="15; URL=index.php">
    </head>


    <body >
        <div id="Page">
            <h3 id="titre"> Votre message a bien été envoyé. </h3>
            <p> L'equipe Boulangerie reviendra vers vous dans un délais maximum d'une semaine. </p> 
            <p>Recapitulatif du mail envoyé</p>
    
            <?php
                echo 'Nom : '.$_POST["name"].'<br>';
                echo 'Prenom : '.$_POST["prenom"].'<br>';
                echo 'Email : ' .$_POST["email"].'<br>';
                
                echo 'Object : ' .$_POST["object"].'<br>';
                echo 'Contenu : ' .$_POST["contenu"].'<br>';
            ?>

        <a href="index.php">Retour vers la page d'accueil</a>
        </div>
       

    </body>
</html>