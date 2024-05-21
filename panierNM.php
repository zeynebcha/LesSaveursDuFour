<?php
session_start(); 
error_reporting(0);
include 'header.php';  

if ($_SERVER['HTTP_REFERER'] != "http://boulangerie/panier.php") { 
    header('Location: panier.php');
}

if ($_SESSION['statut'] == 1 && count($_SESSION['PanierRef']) != 0) {
    echo '<table border="1">';
    echo '<thead> <tr> <td>Nom</td> <td>Photo</td> <td>Ref</td> <td>Prix</td> <td> Quantité </td> <td>Total Article</td> </tr> </thead>';
    
    $total = 0;
    for($i=0; $i< count($_SESSION['PanierNom']); $i++){
        echo '<tr><td>'.$_SESSION['PanierNom'][$i].'</td>';
        echo '<td><img class="photoPanier" src="./img/'.$_SESSION['PanierImg'][$i].'"></td>';
        echo '<td>'.$_SESSION['PanierRef'][$i].'</td>';
        echo '<td>'.$_SESSION['PanierPrix'][$i].'€</td>';
        echo '<td>'.$_SESSION['PanierQte'][$i].'</td>';
        echo '<td>'.($_SESSION['PanierQte'][$i]*$_SESSION['PanierPrix'][$i]). '€</td></tr>';
        
        $total += ($_SESSION['PanierQte'][$i]*$_SESSION['PanierPrix'][$i]);
    } 

    echo '<tr><td> Total </td><td>'. $total .'€</td> </tr></table>';
    $_SESSION['total'] = $total;

    // Ajout de la requête Ajax pour mettre à jour le stock
    echo '<script>
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "mettre_a_jour_stock.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log("Stock mis à jour avec succès !");
                } else {
                    console.error("Erreur lors de la mise à jour du stock :", xhr.statusText);
                }
            };
            xhr.onerror = function() {
                console.error("Erreur lors de la mise à jour du stock : Requête non appelée");
            };
            xhr.send("PanierRef=" + JSON.stringify('.json_encode($_SESSION['PanierRef']).') + "&PanierQte=" + JSON.stringify('.json_encode($_SESSION['PanierQte']).'));
          </script>';

    echo '<form action="generer_facture.php" method="POST"><input type="submit" name="valider" id="valider" value="Envoyez-moi la facture"></form>';
} else {
    echo "<script>setTimeout(\"location.href = '../connexion.php';\",3000);</script>";
    echo '<p> Veuillez vous connecter pour valider votre panier. </p>';
    echo "Redirection en cours...";
}
        
include 'footer.php'; 
?>
